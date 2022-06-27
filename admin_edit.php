<?php
$title='Page Admin';
require_once 'head.php';
if ($_SESSION['role']!=='Admin'){
    header('Location:index.php');
}

require_once 'include/update_user.php';
require_once 'include/save.php';
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
    $_SESSION['status']='';
    if (isset($_SESSION['status'])){
        echo $_SESSION['status'];
        unset($_SESSION['status']);
    }
    ?></div>

<div class="container text-center mt-5">
    <h2 class="text-secondary">Modifier le login</h2>
    <form method="post" class="container">
        <div class="form-group">
            <input id="loginAdmin" name="pseudo"  value="<?= $_SESSION['pseudo'] ?>" type="text" class="form-control mb-3" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <input id="oldPwd" name="oldPwd"   placeholder="Mot de passe actuel" type="password" class="form-control mb-3">
        </div>
        <div class="form-group">
            <input id="pwd" name="pwd"   placeholder="Nouveau mot de passe" type="password" class="form-control mb-3">
        </div>
        <div class="form-group">
            <input id="pwdConf"  placeholder="Confirmer le nouveau mot de passe" type="password" class="form-control mb-3">
        </div>
        <button id="editAdmin" name="editAdmin" type="submit" class="btn btn-primary mb-3">Valider</button>
    </form>
</div>
<div class="container text-center d-flex justify-content-center">





    <table class="table">
        <thead>
        <tr>
            <th scope="col">Historique</th>
            <th scope="col">Sauvegarder</th>
            <th scope="col">Restaurer</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <button class="btn btn-success"><a class="text-white text-decoration-none" href="action_user.php?id=<?= $_GET['id'] ?>">Voir l'historique des actions</a></button>
            </td>
            <td>
                <form action="" method="post" class="mx-2">
                    <button type="submit" name="save" class="btn btn-secondary">Sauvegarder la base de donnée</button>
                </form>
            </td>
            <td>
                <button class="btn btn-dark"><a class="text-decoration-none text-white" href="restaurer.php">Restaurer</a></button>
            </td>
        </tr>
        </tbody>
    </table>

</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
