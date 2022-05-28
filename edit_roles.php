<?php
$title='Modifier utilisateur';
include_once 'head.php';
include_once 'include/update_user.php';
$req = $db->prepare('select * from user where id=:id');
$req->bindParam(':id',$_GET['id']);
$req->execute();
$result = $req->fetch();

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
    <hr class="my-4">
    <form method="post">
        <div class="form-group my-3 container ">
            <input value="<?= $result['name'] ?>" id="nom" name="nom" placeholder="Nom d'utilisateur"  style="max-width: 50vw" type="text" class="m-auto form-control" aria-describedby="emailHelp">
        </div>
        <div class="form-group my-3 container ">
            <input value="<?= $result['pseudo'] ?>" id="pseudoUser" name="pseudoUser" placeholder="pseudo"  style="max-width: 50vw" value="" type="text" class="m-auto form-control"  aria-describedby="emailHelp">
        </div>
        <div  class="form-group my-3 container ">
            <select  id="role" name="role" style="max-width: 50vw" class="form-control m-auto">
                <option>Choisir le rôle</option>
                <option>Editeur</option>
                <option>Controlleur</option>
            </select>
        </div>
        <div class="form-group">
            <input id="pwdUser" name="pwdUser" style="max-width: 50vw"   placeholder="Nouveau mot de passe " type="password" class="m-auto form-control mb-3">
        </div>
        <div class="form-group">
            <input id="confpwdUser" name="confpwdUser" style="max-width: 50vw"   placeholder="Confimer le nouveau mot de passe" type="password" class="m-auto form-control mb-3">
        </div>
        <button id="subUser" name="editUser" type="submit" class="btn btn-primary mb-4">Valider</button>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger mb-4 me-2" data-toggle="modal" data-target="#exampleModal">
           Suprimer l'utilisateur
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    </div>
                    <div class="modal-body">
                     Vous êtes sur le point de suprimer l'utilisateur
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <form action="" method="post"> <button name="deleteUser" type="submit" class="btn btn-danger">Suprimer</button></form>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/manageUsers.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
