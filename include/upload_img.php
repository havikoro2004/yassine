<?php
require_once 'database/database.php';
$db = getPdo();
if(isset($_POST["upload"])) {
    if ($_FILES['photo']['size'] !== 0){

        $format= ['image/jpg','image/jpeg','image/gif','image/png'];
        $imgFormat =strtolower($_FILES['photo']['type']);
        if (in_array($_FILES['photo']['type'],$format)){
            if ($_FILES['photo']['size'] > 3000){
                $extention = substr($_FILES['photo']['name'], strpos($_FILES['photo']['name'], ".") + 1);
                move_uploaded_file($_FILES['photo']['tmp_name'], 'images/img_users/'.$_GET['id'].'.'.$extention);
                $picName = $_GET['id'].'.'.$extention;
                $req=$db->prepare('update client set photo=:photo where id=:id');
                $req->bindParam(':photo',$picName);
                $req->bindParam(':id',$_GET['id']);
                $req->execute();
                $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert">Photo est bien à jour</div>';

            } else {
                $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">La taille de la photo est très grande</div>';
            }
        } else {
            $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Ce format n\'est pas accepté</div>';
        }
    } else {
        $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Le champs ne doit pas être vide</div>';
    }


}
?>