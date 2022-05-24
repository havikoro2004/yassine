<?php
include_once ('head.php');
include_once 'include/new.php';
?>
    <header class="d-flex justify-content-center align-items-center">
        <h1 class="display-5 bg-dark text-white col text-center p-3">Créer client</h1>
    </header>
<div class="container text-center" id="root">
    <?php if($alert){echo $alert;} ?>
</div>
    <form id="form" action="" method="post" class="container mt-5">
        <div class="form-group">
            <label for=""><strong>Numero de badge <span class="text-danger">*</span></strong></label>
            <input id="badge" class="form-control mb-3" type="text" maxlength="13">
        </div>
        <div class="form-group">
            <label for=""><strong>Nom <span class="text-danger">*</span></strong></label>
            <input id="firstName" class="form-control mb-3" type="text" maxlength="30">
        </div>
        <div class="form-group">
            <label for=""><strong>Prénom <span class="text-danger">*</span></strong></label>
            <input id="lastName" class="form-control mb-3" type="text" maxlength="30">
        </div>
        <div class="form-group">
            <label for=""><strong>Date de naissance <span class="text-danger">*</span></strong></label>
            <div class="d-flex">

            </div>
            <div class="d-flex mb-3" style="width:50vw">
                <select id="day" class="form-control me-2" ></select>

                <select id="month" class="form-control me-2"></select>

                <select id="year" class="form-control me-2"></select>
            </div>
        </div>
        <div class="d-inline">
                <label class="me-4" for=""><strong>Genre <span class="text-danger">*</span></strong></label>
                <input type="radio" name="exampleRadios" id="homme" value="Homme" checked>
                <label for="exampleRadios1">Homme</label>
                <input type="radio" name="exampleRadios" id="femme" value="Femme">
                <label for="exampleRadios2">Femme</label>
        </div>
        <div class="form-group my-3">
            <label for=""><strong>C.I.N</strong></label>
            <input id="cin" class="form-control mb-3" type="text" maxlength="8">
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Tel</strong></label>
            <input id="tel" class="form-control mb-3" type="tel" maxlength="10">
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Adresse</strong></label>
            <textarea id="adresse" class="form-control"></textarea>
        </div>
        <button id="valider" type="button" class="btn btn-primary mb-5">Valider</button>
    </form>

<script src="js/jquery.js"></script>
<script src="js/birthDayForm.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>