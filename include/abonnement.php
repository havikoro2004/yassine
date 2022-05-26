<?php
$db = new PDO ('mysql:host=localhost;dbname=club','root','');
$alert = null;
$id = $_GET['id'];
if (isset($_POST['validerAbn'])){
    $reqVerif=$db->prepare('select * from abonnement where id_client=:id_client && type_sport=:type');
    $reqVerif->bindParam(':id_client',$_GET['id']);
    $reqVerif->bindParam(':type',$_POST['type_sport']);
    $reqVerif->execute();
    if (!$reqVerif->fetch()){
        $req = $db->prepare('insert into abonnement (id_client,type_sport,date_debut,date_fin,date_abonnement) values (:id_client,:type_sport,:date_debut,:date_fin,NOW())');
        $req->bindParam(':id_client',$id);
        $req->bindParam(':type_sport',$_POST['type_sport']);
        $req->bindParam(':date_debut',$_POST['date_debut']);
        $req->bindParam(':date_fin',$_POST['date_fin']);
        $req->execute();
        $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert"><h4>Abonnement a bien été ajouté</h4></div>';
        echo"<meta http-equiv='refresh' content='2'>";
    } else {
        $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Il semble que l\'utilisateur a deja un abonnement de <strong>'.$_POST['type_sport'].'</strong></div>';
    }
}
