<?php
$title='Restauration';
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

<?php

if ($sauvegarde){ ?>
    <h2 class="text-secondary">Restaurer le site</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Sauvegarde</th>
            <th scope="col">Date</th>
            <th scope="col">Utiliser cette Sauvegarde</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($sauvegarde as $save){

            ?>

            <tr>
                <td>
                    <?= $save['folderName'] ?>
                </td>
                <td>
                    <?= $save['date'] ?>
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal<?= $save['folderName'] ?>">
                        Utiliser cette sauvegarde
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $save['folderName'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                   Vous êtes sur le point de restaurer votre base de donnée
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <form action="" method="post">
                                            <button name="<?= $save['folderName'] ?>" type="submit" class="btn btn-success">Valider</button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

        <?php }

        ?>

        </tr>
        </tbody>
    </table>

<?php } else {

    echo '<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Aucune sauvegarde trouvée</div>';
}

?>
</body>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
