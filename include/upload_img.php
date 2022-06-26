<?php
require_once 'database/database.php';
$db = getPdo();
if(isset($_POST["upload"])) {
    if ($_FILES['photo']['size'] !== 0){

        $format= ['image/jpg','image/jpeg','image/gif','image/png'];
        $imgFormat =strtolower($_FILES['photo']['type']);
        if (in_array($_FILES['photo']['type'],$format)){
            if ($_FILES['photo']['size'] > 3000){
                $req = $db->prepare('select * from client where id=:id');
                $req->bindParam(':id',$_GET['id']);
                $req->execute();
                $list = $req->fetch();
                $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
                $action ='a mis à jour la photo profil de '.$list['firstName'].' '.$list['lastName'];
                $history->bindParam(':id',$_SESSION['id']);
                $history->bindParam(':action',$action);
                $history->execute();

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