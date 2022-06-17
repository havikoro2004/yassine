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

    $birth = date_create($resultat['birth']);
    $date = $resultat['date'];
    $date = date_create($resultat['date']);
    $cin = $resultat['cin'];
    $badge = $resultat['badge'];
    $tel = $resultat['tel'];
    $adresse = $resultat['adresse'];
    $genre = $resultat['genre'];
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

$tableAbonnement = $db->prepare('select * from abonnement where id_client=:id order by date_abonnement desc ');
$tableAbonnement->bindParam(':id',$_GET['id']);
$tableAbonnement->execute();
$resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);
$status=null;

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
if (isset($_POST['fetchFilter'])){
    if ($_POST['fetchFilter']==='actif'){
        $tableAbonnement = $db->prepare('select * from abonnement where id_client=:id && status=true order by date_abonnement desc ');
        $tableAbonnement->bindParam(':id',$_GET['id']);
        $tableAbonnement->execute();
        $resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);
        $statusActifs= 'selected =""';
        if (!$resultAbon){
            $_SESSION['status']='<div id="alert" class="alert alert-dark mt-3 container text-center" role="alert">Aucune activité active n\'est trouvée</div>';
        }
    }
}
if (isset($_POST['fetchFilter'])){
    if ($_POST['fetchFilter']=='expired'){
        $tableAbonnement = $db->prepare('select * from abonnement where id_client=:id && status=false order by date_abonnement desc ');
        $tableAbonnement->bindParam(':id',$_GET['id']);
        $tableAbonnement->execute();
        $resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);
        if (!$resultAbon){
            $_SESSION['status']='<div id="alert" class="alert alert-dark mt-3 container text-center" role="alert">Aucune activité expirée n\'est trouvée</div>';
        }
    }
}

if (isset($_POST['deleteUser'])){
    $reqDelet = $db->prepare('delete from client where id=:id');
    $reqDelet->bindParam(':id',$_GET['id']);
    $reqDelet->execute();

    $_SESSION['status']='<div id="alert" class="alert alert-dark mt-3 container text-center" role="alert"><h4>Le profil a bien été suprimé</h4></div>';
    echo '<meta http-equiv="refresh" content="1">';
    if ($photo !=='defaultUserM.jpg' && $photo !=='defaultUserM.jpg'){
        unlink('images/img_users/'.$photo.'');
    }
}

