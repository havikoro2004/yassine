<?php
include_once ('head.php');
include_once 'include/new.php';
include_once 'include/Controlle.php';
$users= new Controlle();
$client = $users->getById($_GET['id']);

?>
<header class="d-flex justify-content-center align-items-center">
    <h1 class="display-5 bg-dark text-white col text-center p-3">MODIFIER LE</h1>
</header>
<div class="container text-center" id="root">
    <?php if($alert){echo $alert;} ?>
</div>
<form id="form" action="" method="post" class="container mt-5">
    <div class="form-group">
        <label for=""><strong>Numero de badge <span class="text-danger">*</span></strong></label>
        <input value="<?= $client['badge'] ?>" id="badge" class="form-control mb-3" type="text" maxlength="13">
    </div>
    <div class="form-group">
        <label for=""><strong>Nom <span class="text-danger">*</span></strong></label>
        <input value="<?= $client['firstName'] ?>" id="firstName" class="form-control mb-3" type="text" maxlength="30">
    </div>
    <div class="form-group">
        <label for=""><strong>Prénom <span class="text-danger">*</span></strong></label>
        <input value="<?= $client['lastName'] ?>" id="lastName" class="form-control mb-3" type="text" maxlength="30">
    </div>
    <div class="form-group">
        <label for=""><strong>Date de naissance <span class="text-danger">*</span></strong></label>
        <input value="<?= $client['birth'] ?>" id="birth" class="form-control mb-3" type="date">
    </div>
    <div class="d-inline">
        <label class="me-4" for=""><strong>Genre <span class="text-danger">*</span></strong></label>
        <input type="radio" name="exampleRadios" id="homme" value="Homme" checked>
        <label for="exampleRadios1">Homme</label>
        <input type="radio" name="exampleRadios" id="femme" value="Femme">
        <label  for="exampleRadios2">Femme</label>
    </div>
    <div class="form-group my-3">
        <label for=""><strong>C.I.N</strong></label>
        <input value="<?= $client['cin'] ?>" id="cin" class="form-control mb-3" type="text" maxlength="8">
    </div>
    <div class="form-group mb-3">
        <label for=""><strong>Tel</strong></label>
        <input value="<?= $client['tel'] ?>"  id="tel" class="form-control mb-3" type="tel" maxlength="10">
    </div>
    <div class="form-group mb-3">
        <label for=""><strong>Adresse</strong></label>
        <textarea value="<?= $client['adresse'] ?>" id="adresse" class="form-control"></textarea>
    </div>
    <button name="update"  type="submit" class="btn btn-primary mb-5">Valider</button>
</form>
<?php

if (isset($_POST['update'])){


}

?>
<script src="js/jQuery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>