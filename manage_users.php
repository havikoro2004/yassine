<?php
$title='Gérer les utilisateurs';
include_once 'head.php';
if ($_SESSION['role']!==1){
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
<div id="rootAdmin"></div>
<?php

if (isset($_SESSION['status'])){
    echo $_SESSION['status'];
    unset($_SESSION['status']);
}
?>
<div class="container text-center mt-5">
    <h2 class="text-secondary text-center">Liste des utilisateur</h2>
    <hr class="my-4">
    <table class="table ">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Date d'inscription</th>
            <th scope="col">Rôle</th>
            <th scope="col"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $role){
            $date = date_create($role['date_inscription'])
            ?>
            <tr>
                <th><?= $role['name'] ?></th>
                <th><?= $role['pseudo'] ?></th>
                <th><?= date_format($date,('d-m-Y')) ?></th>
                <th><?= $role['role_name'] ?></th>
                <th>
                    <a href="edit_roles.php?id=<?=$role['id'] ?>">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?= $role['pseudo'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </button>
                    </a>

                </th>
            </tr>
        <?php }
        ?>

        </tbody>
    </table>

    <h2 class="text-secondary">Créer un user</h2>
    <form method="post">
        <div class="form-group my-3 container ">
            <input id="nom" name="nom" placeholder="Nom d'utilisateur"  style="max-width: 50vw" value="" type="text" class="m-auto form-control" aria-describedby="emailHelp">
        </div>
        <div class="form-group my-3 container ">
            <input id="pseudoUser" name="pseudoUser" placeholder="pseudo"  style="max-width: 50vw" value="" type="text" class="m-auto form-control"  aria-describedby="emailHelp">
        </div>
        <div  class="form-group my-3 container ">
            <select id="role" name="role" style="max-width: 50vw" class="form-control m-auto">
                <option>Choisir le rôle</option>
                <option>Editeur</option>
                <option>Controlleur</option>
            </select>
        </div>
        <div class="form-group">
            <input id="pwdUser" name="pwdUser" style="max-width: 50vw"   placeholder="Mot de passe " type="password" class="m-auto form-control mb-3">
        </div>
        <div class="form-group">
            <input id="confpwdUser" name="confpwdUser" style="max-width: 50vw"   placeholder="Confimer le mot de passe" type="password" class="m-auto form-control mb-3">
        </div>
        <button id="subUser" name="subUser" type="submit" class="btn btn-primary mb-4">Valider</button>
    </form>

</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/manageUsers.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
