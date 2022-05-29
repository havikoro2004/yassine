<?php
session_start();
if ($_SESSION){
    header('Location: index.php');
}
if (isset($_POST['login'])){
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])){
        $db = new PDO ('mysql:host=localhost;dbname=club','root','');
        $req = $db->prepare('select * from user join roles on roles.id=user.id_type where user.pseudo=:pseudo && user.password=:password');
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);
        $req->bindParam(':pseudo',$pseudo);
        $req->bindParam(':password',$password);
        $req->execute();
        $result=$req->fetch();
        if ($result){
            $_SESSION['pseudo']=$result['pseudo'];
            $_SESSION['password']=$result['password'];
            $_SESSION['id']=$result['id'];
            $_SESSION['role']=$result['role_name'];
            header('Location: index.php');

        } else {
            $_SESSION['status'] = '<div style="max-width: 50vw"  id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Login ou mot de passe incorrect</div>';
        }
    } else {
        $_SESSION['status'] = '<div style="max-width: 50vw"  id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Les champs ne doivent pas être vides</div>';
    }
}


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
    <div class="container text-center mt-5">
        <img height="10%" width="10%" class="img-fluid mb-4" src="images/logo.png" alt="">
        <h1 class="h1Home">Login</h1>
        <form method="post">
            <?php

            if (isset($_SESSION['status'])){
                echo $_SESSION['status'];
                unset($_SESSION['status']);
            }
            ?>
            <div class="form-group mb-3 container ">
                <input name="pseudo" style="max-width: 50vw" placeholder="Login" type="text" class="m-auto form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
        <input name="password" style="max-width: 50vw"   placeholder="Mot de passe" type="password" class="m-auto form-control mb-3" id="exampleInputPassword1">
            </div>

            <button name="login" type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
</body>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
</html>