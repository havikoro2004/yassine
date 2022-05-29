<?php
$title='Page Admin';
include_once 'head.php';
if ($_SESSION['role']!=='Admin'){
    header('Location:index.php');
}
include_once 'include/update_user.php';
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
<div id="rootAdmin" ><?php

    if (isset($_SESSION['status'])){
        echo $_SESSION['status'];
        unset($_SESSION['status']);
    }
    ?></div>

<div class="container text-center mt-5">
    <h2 class="text-secondary">Modifier le login</h2>
    <form method="post">
        <div class="form-group my-3 container ">
            <input id="loginAdmin" name="pseudo" style="max-width: 50vw" value="<?= $_SESSION['pseudo'] ?>" type="text" class="m-auto form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <input id="oldPwd" name="oldPwd" style="max-width: 50vw"   placeholder="Mot de passe actuel" type="password" class="m-auto form-control mb-3">
        </div>
        <div class="form-group">
            <input id="pwd" name="pwd" style="max-width: 50vw"   placeholder="Nouveau mot de passe" type="password" class="m-auto form-control mb-3">
        </div>
        <div class="form-group">
            <input id="pwdConf" style="max-width: 50vw"   placeholder="Confirmer le nouveau mot de passe" type="password" class="m-auto form-control mb-3">
        </div>
        <button id="editAdmin" name="editAdmin" type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
