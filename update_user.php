<?php
$title='MODIFIER LES INFOS';
include_once ('head.php');
include_once 'include/update_user.php';
include_once 'include/Controlle.php';
if ($_SESSION['role']==='Controlleur'){
    header('Location:index.php');
}
$users= new Controlle();
$client = $users->getById($_GET['id']);

?>

<div class="container text-center" id="root">

</div>
<?php
if (isset($_SESSION['status'])){
    echo $_SESSION['status'];
    unset($_SESSION['status']);
}

?>
<form id="form" action="" method="post" class="container mt-5">
    <div class="form-group">
        <label for=""><strong>Numero de badge <span class="text-danger">*</span></strong></label>
        <input disabled value="<?= $client['badge'] ?>"id="badge" class="form-control mb-3" type="text" maxlength="13">
    </div>
    <div class="form-group">
        <label for=""><strong>Nom <span class="text-danger">*</span></strong></label>
        <input value="<?= $client['firstName'] ?>" name="firstName" class="form-control mb-3" type="text" maxlength="30">
    </div>
    <div class="form-group">
        <label for=""><strong>Prénom <span class="text-danger">*</span></strong></label>
        <input value="<?= $client['lastName'] ?>" name="lastName" class="form-control mb-3" type="text" maxlength="30">
    </div>
    <div class="form-group">
        <label for=""><strong>Date de naissance <span class="text-danger">*</span></strong></label>
        <div class="d-flex">

        </div>
        <div class="d-flex mb-3" style="width:50vw">
            <select disabled name="day" class="form-control me-2" >
                <option ><?= date("d",strtotime($client['birth'])) ?></option>
            </select>

            <select disabled name="month" class="form-control me-2">
                <option ><?= date("m",strtotime($client['birth'])) ?></option>
            </select>

            <select disabled name="year" class="form-control me-2">
                <option ><?= date("Y",strtotime($client['birth'])) ?></option>
            </select>
        </div>
    </div>
    <div class="d-inline">
        <label class="me-4" for=""><strong>Genre <span class="text-danger">*</span></strong></label>
        <input disabled type="radio" name="exampleRadios" id="homme" value="Homme" checked>
        <label for="exampleRadios1">Homme</label>
        <input  disabled type="radio" name="exampleRadios" id="femme" value="Femme">
        <label for="exampleRadios2">Femme</label>
    </div>
    <div class="form-group my-3">
        <label for=""><strong>C.I.N</strong></label>
        <input value="<?= $client['cin'] ?>" name="cin" class="form-control mb-3" type="text" maxlength="8">
    </div>
    <div class="form-group mb-3">
        <label for=""><strong>Tel</strong></label>
        <input value="<?= $client['tel'] ?>" name="tel" class="form-control mb-3" type="tel" maxlength="10">
    </div>
    <div class="form-group mb-3">
        <label for=""><strong>Adresse</strong></label>
        <textarea value="<?= $client['adresse'] ?>" name="adresse" class="form-control"></textarea>
    </div>
    <button name="edit" type="submit" class="btn btn-primary mb-5">Valider</button>
</form>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>