<?php
$title='Controller un client';
include_once ('head.php');
$alert = null;
$abonnements=null;
include_once ('include/Controlle.php');

if (isset($_POST['chercher'])){
   if (!empty($_POST['filter'])){
       $client = new Controlle();
       $user = $client->getClient($_POST['filter']);
       if ($user){
           $idClient = $user['id'];
           $abonnements = $client->getAbonnement($idClient);
           header('Location:profils.php?id='.$idClient.'');

       } else {
           $alert ='<div class="alert alert-danger mt-3 container text-center" role="alert">Aucun client trouvé avec ce numéro de badge</div>';
       }
   }else {
       $alert ='<div class="alert alert-danger mt-3 container text-center" role="alert">Veuillez inserer un mot clé de recherche </div>';
    }
}
clearstatcache(true);
?>
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page" href="#">Controle</a></li>
        </ol>
    </nav>
</div>
<?php if ($alert){echo $alert;} ?>

<div class="border container mt-2 rounded">
    <h2 class="my-5 text-center">Chercher un client</h2>
    <form action="" method="post" class="form-inline d-flex container mb-5">
        <button name="chercher" class="btn btn-outline-dark me-2" type="submit">Chercher</button>
        <input id="filter" name="filter" class="form-control mr-sm-2 me-2" type="search" placeholder="Chercher" aria-label="Search">
    </form>
</div>

<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>