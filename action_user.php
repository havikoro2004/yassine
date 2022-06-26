<?php
$title='Historique des actions utilisateur';
require_once 'head.php';
if ($_SESSION['role']!=='Admin'){
    header('Location:index.php');
}
require_once 'include/update_user.php';
require_once 'database/database.php';
$db=getPdo();

$req = $db->prepare('select * from suivi join user on suivi.id_user=user.id where suivi.id_user=:id ORDER BY date DESC LIMIT :start, :final');
$req->bindParam(':id',$_GET['id']);
$final = 100;
$page = $_GET['page'] ?? 1;
$req->bindParam(':final',$final,pdo::PARAM_INT);
$req->bindValue(':start' ,$final * ( (int)$page - 1)  , PDO::PARAM_INT );
$req->execute();
$result = $req->fetchAll(PDO::FETCH_ASSOC);

$countStatement = $db ->prepare('SELECT COUNT(*) as nbrresult FROM suivi where id_user=:id');
$countStatement->bindParam((':id'),$_GET['id']);
$countStatement->execute();
$totalresult = $countStatement->fetch(pdo::FETCH_ASSOC);
$nbrPage = ceil($totalresult['nbrresult'] / $final );





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
    <table class="table text-start">
        <thead>
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
                <td><?= date_format($date,('d-m-Y H:i')) ?></td>
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
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/manageUsers.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
