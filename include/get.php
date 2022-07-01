<?php
require_once 'database/database.php';

$db = getPdo();
/* Requette pr trouver les infos du client by id GET URL  */
$reqUrl = $db->prepare('select * from client where id=:id');
$reqUrl->bindParam(':id',$_GET['id']);
$reqUrl->execute();
if ($resultat= $reqUrl->fetch()){
    $firstName = $resultat['firstName'];
    $lastName = $resultat['lastName'];

    if ($resultat['birth']){
        $birth = date_format(date_create($resultat['birth']));
    } else {
        $birth='Non fourni';
    }
    $date = $resultat['date'];
    $date = date_create($resultat['date']);
    $cin = $resultat['cin'];
    $badge = $resultat['badge'];
    $tel = $resultat['tel'];
    $adresse = $resultat['adresse'];
    if ($resultat['genre']){
        $genre = $resultat['genre'];
    } else {
        $genre = 'Non fourni';
    }
    $photo = $resultat['photo'];
    $by = $resultat['create_by'];

    if (!$tel){
        $tel = 'Non fourni';
    }
    if (!$adresse){
        $adresse='Non fourni';
    }
    if (!$cin){
        $cin='Non fourni';
    }
    if (!$photo){
        if ($genre ==='Homme'){
            $photo = 'defaultUserM.jpg';
        } else {$photo ='defaultUserF.jpg';}
    }

} else {

    header('Location:client_list.php');
}

$tableAbonnement = $db->prepare('select * from abonnement where id_client=:id && status="actif" order by date_abonnement desc ');
$tableAbonnement->bindParam(':id',$_GET['id']);
$tableAbonnement->execute();
$resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);

$status=null;

if (isset($_POST['fetchFilter'])){
    $tableAbonnement = $db->prepare('select * from abonnement where id_client=:id && status=:status order by date_abonnement desc ');
    $tableAbonnement->bindParam(':id',$_GET['id']);
    $tableAbonnement->bindParam(':status',$_POST['fetchFilter']);
    $tableAbonnement->execute();
    $resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);
    if ($_POST['fetchFilter']==='tous'){
        $tableAbonnement = $db->prepare('select * from abonnement where id_client=:id order by date_abonnement desc ');
        $tableAbonnement->bindParam(':id',$_GET['id']);
        $tableAbonnement->execute();
        $resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);
    }
    if (!$resultAbon){
        $_SESSION['status']='<div id="alert" class="alert alert-dark mt-3 container text-center" role="alert">Aucun resultat trouvé</div>';
    }
}

foreach ($resultAbon as $abn){
    $dateDebut = new DateTime($abn['date_debut']);
    $dateFin = new DateTime($abn['date_fin']);
    $dateDebut = $dateDebut->getTimestamp();
    $dateFin = $dateFin->getTimestamp();
    $joursRestant = ($dateFin - $dateDebut);
    if ($abn['status']==="actif" && !$joursRestant > 0){
        $req = $db->prepare('update abonnement set status="inactif" where id=:id');
        $req->bindParam('id',$abn['id']);
        $req->execute();
    }
}

if (isset($_POST['deleteUser'])){

    $req = $db->prepare('select * from client where id=:id');
    $req->bindParam(':id',$_GET['id']);
    $req->execute();
    $list = $req->fetch();
    $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
    $action ='a surpimé le profil de '.$list['firstName'].' '.$list['lastName'];
    $history->bindParam(':id',$_SESSION['id']);
    $history->bindParam(':action',$action);
    $history->execute();

    $reqDelet = $db->prepare('delete from client where id=:id');
    $reqDelet->bindParam(':id',$_GET['id']);
    $reqDelet->execute();

    $_SESSION['status']='<div id="alert" class="alert alert-dark mt-3 container text-center" role="alert"><h4>Le profil a bien été suprimé</h4></div>';
    echo '<meta http-equiv="refresh" content="1">';
    if ($photo !='defaultUserM.jpg' && $photo !='defaultUserM.jpg'){
        unlink('images/img_users/'.$photo.'');
    }
}

