<?php
require_once 'database/database.php';
$db = getPdo();
$alert =null;
            if (isset($_POST['addBtn'])){
                $reqActivity = $db ->prepare('select * from activity where name=:name ');
                $reqActivity->bindParam(':name',$_POST['add']);
                $reqActivity->execute();
                if (!$reqActivity->fetch()){

                    $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
                    $nouvelleActivite = strtoupper($_POST['add']);
                    $action ='a ajouté une nouvelle activité '.$nouvelleActivite;
                    $history->bindParam(':id',$_SESSION['id']);
                    $history->bindParam(':action',$action);
                    $history->execute();

                    $reqAdd = $db->prepare('insert into activity (name ,prix,nbrActivity) values (:name ,:prix,:nbrActivity) ');
                    $addValue = strtoupper($_POST['add']);
                    $reqAdd->bindParam(':name',$addValue);
                    $reqAdd->bindParam(':prix',$_POST['prix']);
                    $reqAdd->bindParam(':nbrActivity',$_POST['nbrActivity']);
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

        $req = $db->prepare('select * from client where id=:id');
        $req->bindParam(':id',$_GET['id']);
        $req->execute();
        $list = $req->fetch();

        $abon = $db->prepare('select * from abonnement where id=:id');
        $abon->bindParam(':id',$_GET['abn']);
        $abon->execute();
        $abonne = $abon->fetch();

        $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
        $action ='a renouvelé l\'activité '.$abonne['type_sport'].' dlu client '.$list['firstName'].' '.$list['lastName'];
        $history->bindParam(':id',$_SESSION['id']);
        $history->bindParam(':action',$action);
        $history->execute();


        $req=$db->prepare('update abonnement set date_renew=NOW(),total=:total,payer=:payer,reste=:reste, date_fin=:date_fin,lastPayement=NOW() ,status="actif" where id=:id');
        $req->bindParam(':date_fin',$_POST['renouvDate']);
        $req->bindParam(':total',$_POST['totalPayer']);
        $req->bindParam(':payer',$_POST['payer']);
        $reste = (int)$result['reste']+ ( (int)$_POST['totalPayer'] - (int)$_POST['payer'] );
        $req->bindParam(':reste',$reste);
        $req->bindParam(':id',$_GET['abn']);
        $req->execute();
        $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert"><h4>Le renouvellement a bien été effectué</h4></div>';
    }

}

if (isset($_POST['regler'])){
    if (!empty($_POST['montant'])){
        $req=$db->prepare('select * from abonnement where id=:id');
        $req->bindParam(':id',$_GET['abn']);
        $req->execute();
        $result = $req->fetch();

        if ($result['reste'] > 0 && $_POST['montant'] <= $result['reste']){

            $req = $db->prepare('select * from client where id=:id');
            $req->bindParam(':id',$_GET['id']);
            $req->execute();
            $list = $req->fetch();

            $abon = $db->prepare('select * from abonnement where id=:id');
            $abon->bindParam(':id',$_GET['abn']);
            $abon->execute();
            $abonne = $abon->fetch();

            $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
            $action ='a ajouté un paiement de l\'activité '.$abonne['type_sport'].' dlu client '.$list['firstName'].' '.$list['lastName'];
            $history->bindParam(':id',$_SESSION['id']);
            $history->bindParam(':action',$action);
            $history->execute();


            $req=$db->prepare('update abonnement set payer=:payer,reste=:reste ,lastPayement=NOW() where id=:id');
            $req->bindParam(':id',$_GET['abn']);
            $payer = (int)$result['payer'] + (int)$_POST['montant'];
            $req->bindParam(':payer',$payer);
            $reste = (int)$result['reste'] - (int)$_POST['montant'];
            $req->bindParam(':reste',$reste);
            $req->execute();
            $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert">Payement enregistré avec success</div>';
        } else {
            $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Opération impossible</div>';
        }

    } else {
        $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Aucun montant n\'a été saisi</div>';
    }
}

if (isset($_POST['pause'])){
    $req = $db->prepare('select * from client where id=:id');
    $req->bindParam(':id',$_GET['id']);
    $req->execute();
    $list = $req->fetch();

    $abon = $db->prepare('select * from abonnement where id=:id');
    $abon->bindParam(':id',$_GET['abn']);
    $abon->execute();
    $abonne = $abon->fetch();

    $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
    $action ='a mis en pause l\'activité '.$abonne['type_sport'].' dlu client '.$list['firstName'].' '.$list['lastName'];
    $history->bindParam(':id',$_SESSION['id']);
    $history->bindParam(':action',$action);
    $history->execute();

    $req = $db->prepare('update abonnement set pause=NOW(),status="pause" where id=:id');
    $req->bindParam(':id',$_GET['abn']);
    $req->execute();
    $_SESSION['status']='<div id="alert" class="alert alert-dark mt-3 container text-center" role="alert">Abonnement est desormais en pause</div>';

}

if (isset($_POST['react'])){

    $req = $db->prepare('select * from client where id=:id');
    $req->bindParam(':id',$_GET['id']);
    $req->execute();
    $list = $req->fetch();

    $abon = $db->prepare('select * from abonnement where id=:id');
    $abon->bindParam(':id',$_GET['abn']);
    $abon->execute();
    $abonne = $abon->fetch();

    $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
    $action ='a reactivé l\'activité '.$abonne['type_sport'].' dlu client '.$list['firstName'].' '.$list['lastName'];
    $history->bindParam(':id',$_SESSION['id']);
    $history->bindParam(':action',$action);
    $history->execute();

    $req1 =$db->prepare('select * from abonnement where id=:id');
    $req1->bindParam(':id',$_GET['abn']);
    $req1->execute();
    $result = $req1->fetch();
    $fin = new DateTime($result['date_fin']);
    $pause = new DateTime($result['pause']);
    $reprise =new DateTime();
    $newFin = $fin->getTimestamp() + ($reprise->getTimestamp() - $pause->getTimestamp()) ;
    $newDate = date(('Y-m-d'),$newFin);

    $req = $db->prepare('update abonnement set date_fin=:date,status="actif" where id=:id');
    $req->bindParam(':date',$newDate);
    $req->bindParam(':id',$_GET['abn']);
    $req->execute();


    $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert">Abonnement est desormais actif</div>';

}

