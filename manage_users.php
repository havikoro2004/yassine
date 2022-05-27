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
    <h2 class="text-secondary">Modifier le login</h2>

</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
