<?php
$title='ACTIVITES';
include_once ('head.php');
include_once 'include/activity.php';


clearstatcache(true);
$activity=null;

?>
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page" href="#">Activités</a></li>
        </ol>
    </nav>
</div>
<div id="root3">
    <?php
    if (isset($_SESSION['status'])){
        echo $_SESSION['status'];
        unset($_SESSION['status']);
    }
    if ($alert){echo $alert;}
    ?>

</div>

<div class="border container mt-2 rounded">
    <h2 class="my-5 text-center">Liste des activités</h2>
    <div class="mb-5">

                <?php
                if ($activitys){ ?>
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">Nom de l'activité</th>
                            <th scope="col">Prix en DH</th>
                            <?php
                             if ($_SESSION['role']==='Admin' || $_SESSION['role']==='Editeur'){ ?>
                                 <th scope="col">Suprimer </th>
                           <?php  }  ?>

                        </tr>
                        </thead>
                        <tbody>

                  <?php  foreach ($activitys as $activity){
                        if (isset($_POST['dActivity'.$activity['id']])){
                            $req = $db->prepare('select * from abonnement where type_sport=:type_sport');
                            $req->bindParam(':type_sport',$activity['name']);
                            $req->execute();
                            $result = $req->fetch();
                            if ($result){
                                echo "<meta http-equiv='refresh' content='0'>";
                                $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Vous ne pouvez pas suprimer cette activité appartient à un abonnement</div>';
                            } else {
                                $deleteReq = $db->prepare('delete from activity where id=:id && name=:name');
                                $deleteReq->bindParam('id',$activity['id']);
                                $deleteReq->bindParam('name',$activity['name']);
                                $deleteReq->execute();
                                $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Activité suprimée</div>';
                                echo "<meta http-equiv='refresh' content='0'>";

                            }
                        }
                        echo '  
                            <tr><td>'.$activity['name'].'</td>
                            <td>'.$activity['prix'].'</td>
                            ';

                        if ($_SESSION['role']==='Admin' || $_SESSION['role']==='Editeur'){
                            echo '               <td>
                              <form method="post">
                                  <button type="submit" name="dActivity'.$activity['id'].'" class="btn btn-danger">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                          <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                      </svg>
                                  </button>
                              </form>
                          </td>
                          </tr>';
                        }  ?>

                            <?php  }

                }

                ?>

            </tbody>
        </table>

    </div>
    <?php
    if ($_SESSION['role']==='Admin' || $_SESSION['role']==='Editeur'){ ?>
        <form action="" method="post" class="form-inline d-flex container mb-5">
        <button id="addBtn" name="addBtn" type="submit" class="btn btn-dark me-2">Ajouter</button>
        <input maxlength="30" id="add" id="filter" name="add" class="form-control mr-sm-2 me-2" type="search" placeholder="Ajouter une activité" aria-label="Search">
        <input id="prix" name="prix" placeholder="Prix" class="form-control" type="number" min="0">
    </form>
  <?php  }    ?>

</div>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>