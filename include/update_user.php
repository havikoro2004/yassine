<?php

if (isset($_POST['edit'])){
    $req=$db->prepare('select * from client where birth=:birth && firstName=:firstName && lastName=:lastName');
    $req->bindParam(':birth',$_POST['birth']);
    $req->bindParam(':firstName',$_POST['firstName']);
    $req->bindParam('lastName',$_POST['lastName']);
    $req->execute();
    $result = $req->fetch();
    if ($result && $result['id']!=$_GET['id']){
        $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Un utilisateur a deja le même nom & prénom et date de naissai</div>';
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        $req = $db->prepare('update client set firstName=:firstName, lastName=:lastName , cin=:cin , tel=:tel , adresse=:adresse where id=:id');
        $req->bindParam(':id',$_GET['id']);
        $req->bindParam(':firstName',$_POST['firstName']);
        $req->bindParam(':lastName',$_POST['lastName']);
        $req->bindParam(':cin',$_POST['cin']);
        $req->bindParam(':tel',$_POST['tel']);
        $req->bindParam(':adresse',$_POST['adresse']);
        $req->execute();
        $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert"><h4>Les informations ont bien été modifiés</h4></div>';
        header( "refresh:2;url=profils.php?id=".$_GET['id']."" );
    }
}
