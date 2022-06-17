<?php
$title='LISTE DES CLIENTS';
include_once ('head.php');
include_once ('include/new.php');
clearstatcache(true);
?>
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page" href="#">Clients</a></li>
        </ol>
    </nav>
</div>
<?php

if ($res){
    echo'<h4 class="text-center my-3 alert-info alert container">Resultat de votre recherche</h4>';
    foreach ($res as $rsa){
        echo '<div class="container"><ul class="text-center list-group mt-2 "><li class="list-group-item"><a class=" text-success text-decoration-none"  href="profils.php?id='.$rsa['id'].'">'.ucfirst($rsa['lastName']).' '.ucfirst($rsa['firstName']).' '.$rsa['birth'].'</a></li></ul></div>';
    }
}
if ($alert){echo $alert;}

?>

<div class="border container rounded mt-4">

    <form action="" method="post" class="form-inline d-flex container mt-4">
        <input id="filter" name="filter" class="form-control mr-sm-2 me-2" type="search" placeholder="Chercher" aria-label="Search">
        <select name="select" class="form-control me-2" id="selectfilter">
            <option>Nom</option>
            <option>Prénom</option>
            <option>Date de naissance</option>
            <option>Badge</option>
        </select>
        <button name="chercher" class="btn btn-outline-dark" type="submit">Chercher</button>
    </form>
<?php if ($_SESSION['role']==='Admin' || $_SESSION['role']==='Editeur'){ ?>
    <div class="container text-center my-5">
        <a href="new.php" class="btn btn-dark">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg> Ajouter un client</a>
    </div>
<?php }
    ?>
</div>

<h2 class="text-center my-3">Dernière inscriptions</h2>
<hr class="my-4 container">

        <?php
        if ($resultAll){
            echo '<table class="table table-hover container text-center">
                    <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">Badge</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Date d\'inscription</th>
                        <th scope="col">Creé par </th>
                    </tr>
                    </thead>
                    <tbody>';
            foreach ($resultAll as $result){
                $date = date_create($result['date']);
                echo ' <tr class="pointer clickable-row" data-href="profils.php?id='.$result['id'].'">
                        <th scope="row">'.$result['badge'].'</th>
                        <th scope="row">'.$result['lastName'].'</th>
                        <th scope="row">'.$result['firstName'].'</th>
                        <th scope="row">'.date_format($date,('d-m-Y')).'</th>
                        <th scope="row">'.$result['create_by'].'</th>
                    <tr>';
            }
        } else {
            echo '<div class="alert alert-dark mt-3 container text-center" role="alert">Aucune inscription</div>';
        }
        ?>
    </tbody>
</table>
<div class="text-center container-lg">

    <ul id="ulPagination" class="pagination pagin">
        <?php
        if ($nbrPage > 1){
            for($i = 1 ; $i <= $nbrPage ; $i++ )
            {
                if (isset($_GET['page'])){

                    if ($i!=$_GET['page']){
                        echo '<li class="page-item" aria-current="page"><a class="page-link pagination"
                        href="?page='.$i.'">'.$i.'</a></li>';
                    } else {
                        echo '<li class="page-item active" aria-current="page"><a class="page-link pagination"
                        href="?page='.$i.'">'.$i.'</a></li>';
                    }
                } else {
                    echo '<li class="page-item" aria-current="page"><a class="page-link pagination"
                        href="?page='.$i.'">'.$i.'</a></li>';
                }


            }
        }
        ?>
    </ul>

</div>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
</html>