<?php
$title='Historique des actions utilisateur';
require_once 'head.php';
if ($_SESSION['role']!=='Admin'){
    header('Location:index.php');
}
require_once 'database/database.php';
require_once 'include/history.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gestion de client</title>
</head>
<body>
<div id="rootAdmin"></div>
<?php

if (isset($_SESSION['status'])){
    echo $_SESSION['status'];
    unset($_SESSION['status']);
}
?>
<div class="container text-center mt-5">
    <?php
    if ($result){ ?>
        <table class="table text-start">
            <thead class="bg-dark text-white">
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Action</th>
                <th scope="col">Date</th>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($result as $resultat){
                $date = date_create($resultat['date']);
                ?>
                <tr>
                    <td><?= $resultat['name'] ?></td>
                    <td><?= $resultat['pseudo'] ?></td>
                    <td><?= $resultat['action'] ?></td>
                    <td>Le <?= date_format($date,('d-m-Y à H:i')) ?></td>
                </tr>
            <?php }
            ?>


            </tbody>
        </table>
        <div class="text-center container-lg">

            <ul id="ulPagination" class="pagination pagin">
                <?php
                if ($nbrPage>1){
                    for($i = 1 ; $i <= $nbrPage ; $i++ )
                    {
                        if (isset($_GET['page'])){

                            if ($i!=$_GET['page']){
                                echo '<li class="page-item" aria-current="page"><a class="page-link pagination"
                        href="?id='.$_GET['id'].'&page='.$i.'">'.$i.'</a></li>';
                            } else {
                                echo '<li class="page-item active" aria-current="page"><a class="page-link pagination"
                         href="?id='.$_GET['id'].'&page='.$i.'">'.$i.'</a></li>';
                            }
                        } else {
                            echo '<li class="page-item" aria-current="page"><a class="page-link pagination"
                        href="?id='.$_GET['id'].'&page='.$i.'">'.$i.'</a></li>';
                        }


                    }
                }
                ?>
            </ul>

        </div>
   <?php }

    ?>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/manageUsers.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
