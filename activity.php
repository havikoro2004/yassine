<?php
include_once ('head.php');
include_once 'include/activity.php';
clearstatcache(true);
?>
<header class="d-flex justify-content-center align-items-center">
    <h1 class="display-5 bg-dark text-white col text-center p-3">Gérer les activités</h1>
</header>
<div id="root3">
    <?php
    if ($alert){
        echo $alert;
    }
    ?>
</div>
<div class="border container mt-2 rounded">
    <h2 class="my-5 text-center">Liste des activités</h2>
    <div class="mb-5">

                <?php
                if ($activitys){
                    echo'        <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Nom de l\'activité</th>
                                    <th scope="col">Suprimer </th>
                                </tr>
                                </thead>
                                <tbody>';
                    foreach ($activitys as $activity){
                        echo '  
                            <tr><td>'.$activity['name'].'</td>
                            <td>
                            <form method="post">
                                <button type="submit" name="d_activity" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </button>
                            </form>
                            </td>  </tr>';


                              }
                }
                if (isset($_POST['d_activity'])){
                    $deleteReq = $db->prepare('delete from activity where id=:id && name=:name');
                    $deleteReq->bindParam('id',$activity['id']);
                    $deleteReq->bindParam('name',$activity['name']);
                    $deleteReq->execute();

                }
                ?>

            </tbody>
        </table>

    </div>
    <form action="" method="post" class="form-inline d-flex container mb-5">
        <button id="addBtn" name="addBtn" type="submit" class="btn btn-dark me-2">Ajouter</button>
        <input maxlength="30" id="add" id="filter" name="add" class="form-control mr-sm-2 me-2" type="search" placeholder="Ajouter une activité" aria-label="Search">
    </form>
</div>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>