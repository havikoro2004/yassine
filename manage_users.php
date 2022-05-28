<?php
$title='Gérer les utilisateurs';
include_once 'head.php';
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
            <th scope="col">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
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
    <hr class="my-4">
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
