<?php
$db = new PDO ('mysql:host=localhost;dbname=club','root','');
$alert =null;
            if (isset($_POST['addBtn'])){
                $reqActivity = $db ->prepare('select * from activity where name=:name ');
                $reqActivity->bindParam(':name',$_POST['add']);
                $reqActivity->execute();
                if (!$reqActivity->fetch()){
                    $reqAdd = $db->prepare('insert into activity (name) values (:name) ');
                    $addValue = strtoupper($_POST['add']);
                    $reqAdd->bindParam(':name',$addValue);
                    $reqAdd->execute();
                    $alert = '<div class="alert alert-success mt-3 container text-center" role="alert"><h4>L\'activité a bien été ajoutée</h4></div>';
                    header( "refresh:1;url=activity.php" );
                } else {
                    $alert = '<div class="alert alert-danger mt-3 container text-center" role="alert">Cette activité existe deja</div>';
                }

            }
            $reqActivity = $db ->prepare('select * from activity order by name ');
            $reqActivity->execute();
            $activitys = $reqActivity->fetchAll();
            if (!$activitys){
                $alert = '<div class="alert alert-dark mt-3 container text-center" role="alert">Aucune activité n\'est ajoutée</div>';
            }
if (isset($_POST['validRenouv'])){
    $req=$db->prepare('select * from abonnement where id=:id');
    $req->bindParam(':id',$_GET['abn']);
    $req->execute();
    $result = $req->fetch();
    $dateExpiration = date_timestamp_get(date_create($result['date_fin']));
    $postDate = date_timestamp_get(date_create($_POST['renouvDate']));
    if ($dateExpiration>=$postDate){
        $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Vous devez choisir une date supérieur à la date expiration actuelle</div>';
    } else {
        $req=$db->prepare('update abonnement set date_renew=NOW(), date_fin=:date_fin ,status=true where id=:id');
        $req->bindParam(':date_fin',$_POST['renouvDate']);
        $req->bindParam(':id',$_GET['abn']);
        $req->execute();
        $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert"><h4>Le renouvellement a bien été effectué</h4></div>';
    }

}