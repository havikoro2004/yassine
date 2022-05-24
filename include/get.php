<?php
$db = new PDO ('mysql:host=localhost;dbname=club','root','');
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

    if (!$tel){
        $tel = 'Non fourni';
    }
    if (!$adresse){
        $adresse='Non fourni';
    }
    if (!$photo){
        if ($genre ==='Homme'){
            $photo = 'defaultUserM.jpg';
        } else {$photo ='defaultUserF.jpg';}
    }

} else {

    header('Location:../index.php');
}

$tableAbonnement = $db->prepare('select * from abonnement where id_client=:id');
$tableAbonnement->bindParam(':id',$_GET['id']);
$tableAbonnement->execute();
$resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);
$status=null;
$check='<div class="container my-3 text-center">
            <div class="form-check form-check-inline">
                <input checked class="form-check-input" type="radio" name="inlineRadioOptions" id="tous" value="Tous " checked >
                <label class="form-check-label" for="inlineRadio1">Tous</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="actifs" value="Actifs"  >
                <label class="form-check-label" for="inlineRadio2">Actifs</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="expired" value="Expiré">
                <label class="form-check-label" for="inlineRadio3">Expiré</label>
            </div>
        </div>';
if (isset($_POST['inlineRadioOptions'])){
    if ($_POST['inlineRadioOptions']==="Actifs"){
        $tableAbonnement = $db->prepare('select * from abonnement where id_client=:id && status=true');
        $tableAbonnement->bindParam(':id',$_GET['id']);
        $tableAbonnement->execute();
        $resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);
        $status=null;
        $check='<div class="container my-3 text-center">
            <div class="form-check form-check-inline">
                <input checked class="form-check-input" type="radio" name="inlineRadioOptions" id="tous" value="Tous "  >
                <label class="form-check-label" for="inlineRadio1">Tous</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="actifs" value="Actifs" checked >
                <label class="form-check-label" for="inlineRadio2">Actifs</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="expired" value="Expiré">
                <label class="form-check-label" for="inlineRadio3">Expiré</label>
            </div>
        </div>';

    }
}
if (isset($_POST['inlineRadioOptions'])){
    if ($_POST['inlineRadioOptions']==="Expiré"){
        $tableAbonnement = $db->prepare('select * from abonnement where id_client=:id && status=false');
        $tableAbonnement->bindParam(':id',$_GET['id']);
        $tableAbonnement->execute();
        $resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);
        $status=null;
        $check='<div class="container my-3 text-center">
            <div class="form-check form-check-inline">
                <input checked class="form-check-input" type="radio" name="inlineRadioOptions" id="tous" value="Tous " >
                <label class="form-check-label" for="inlineRadio1">Tous</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="actifs" value="Actifs"  >
                <label class="form-check-label" for="inlineRadio2">Actifs</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="expired" value="Expiré" checked>
                <label class="form-check-label" for="inlineRadio3">Expiré</label>
            </div>
        </div>';

    }
}
if (isset($_POST['inlineRadioOptions'])){
    if ($_POST['inlineRadioOptions']==="Tous"){
        $tableAbonnement = $db->prepare('select * from abonnement where id_client=:id ');
        $tableAbonnement->bindParam(':id',$_GET['id']);
        $tableAbonnement->execute();
        $resultAbon= $tableAbonnement->fetchAll(PDO::FETCH_ASSOC);
        $status=null;
        $check='        <div class="container my-3 text-center">
            <div class="form-check form-check-inline">
                <input checked class="form-check-input" type="radio" name="inlineRadioOptions" id="tous" value="Tous"checked>
                <label class="form-check-label" for="inlineRadio1">Tous</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="actifs" value="Actifs"  >
                <label class="form-check-label" for="inlineRadio2">Actifs</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="expired" value="Expiré" >
                <label class="form-check-label" for="inlineRadio3">Expiré</label>
            </div>
        </div>';


    }
}
foreach ($resultAbon as $abn){
    $dateDebut = new DateTime($abn['date_debut']);
    $dateFin = new DateTime($abn['date_fin']);
    $dateDebut = $dateDebut->getTimestamp();
    $dateFin = $dateFin->getTimestamp();
    $joursRestant = ($dateFin - $dateDebut);
    if (!$joursRestant > 0){
        $req = $db->prepare('update abonnement set status=false where id=:id');
        $req->bindParam('id',$abn['id']);
        $req->execute();
    }
}
if (isset($_POST['deleteUser'])){
    $reqDelet = $db->prepare('delete from client where id=:id');
    $reqDelet->bindParam(':id',$_GET['id']);
    $reqDelet->execute();
    $alert = '<div class="alert alert-danger mt-3 container text-center" role="alert"><h2>Le profil du client a bien été suprimé</h2></div>';
    header( "refresh:2;url=client_list.php");
}
