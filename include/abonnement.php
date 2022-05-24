<?php
$db = new PDO ('mysql:host=localhost;dbname=club','root','');
$alert = null;
$id = $_GET['id'];
if (isset($_POST['validerAbn'])){
    $typeAbn = $_POST['typeAbn'];
    $typeSport = $_POST['typeSport'];
    $reqVerif = $db->prepare('select * from abonnement where id_client=:id && type_sport=:type_sport && status=true');
    $reqVerif->bindParam('id',$id);
    $reqVerif->bindParam('type_sport',$typeSport);
    $reqVerif->execute();
    if (!$reqVerif->fetch()){
        if ($typeAbn ==='1 Mois'){
            $reqAbn = $db->prepare('insert into abonnement (id_client,type_abonnement,type_sport,date_debut,date_fin) values (:id_client , :type_abonnement,:type_sport,NOW() ,DATE_ADD(NOW() , interval 1 month)  )  ');
            $reqAbn->bindParam(':id_client',$id);
            $reqAbn->bindParam(':type_abonnement',$typeAbn);
            $reqAbn->bindParam(':type_sport',$typeSport);
            $reqAbn ->execute();
            $alert = '<div class="alert alert-success mt-3 container text-center" role="alert"><h4>L\'abonnement a bien été enregistré</h4></div>';
            header( "refresh:1;url=profils.php?id=".$id );
        }
        if ($typeAbn ==='3 Mois'){
            $reqAbn = $db->prepare('insert into abonnement (id_client,type_abonnement,type_sport,date_debut,date_fin) values (:id_client , :type_abonnement,:type_sport,NOW() ,DATE_ADD(NOW() , interval + 3 month)  )  ');
            $reqAbn->bindParam(':id_client',$id);
            $reqAbn->bindParam(':type_abonnement',$typeAbn);
            $reqAbn->bindParam(':type_sport',$typeSport);
            $reqAbn ->execute();
            $alert = '<div class="alert alert-success mt-3 container text-center" role="alert"><h4>L\'abonnement a bien été enregistré</h4></div>';
            header( "refresh:1;url=profils.php?id=".$id );
        }
        if ($typeAbn ==='6 Mois'){
            $reqAbn = $db->prepare('insert into abonnement (id_client,type_abonnement,type_sport,date_debut,date_fin) values (:id_client , :type_abonnement,:type_sport,NOW() ,DATE_ADD(NOW() , interval + 6 month)  )  ');
            $reqAbn->bindParam(':id_client',$id);
            $reqAbn->bindParam(':type_abonnement',$typeAbn);
            $reqAbn->bindParam(':type_sport',$typeSport);
            $reqAbn ->execute();
            $alert = '<div class="alert alert-success mt-3 container text-center" role="alert"><h4>L\'abonnement a bien été enregistré</h4></div>';
            header( "refresh:1;url=profils.php?id=".$id );
        }
        if ($typeAbn ==='12 Mois'){
            $reqAbn = $db->prepare('insert into abonnement (id_client,type_abonnement,type_sport,date_debut,date_fin) values (:id_client , :type_abonnement,:type_sport,NOW() ,DATE_ADD(NOW() , interval + 12 month)  )  ');
            $reqAbn->bindParam(':id_client',$id);
            $reqAbn->bindParam(':type_abonnement',$typeAbn);
            $reqAbn->bindParam(':type_sport',$typeSport);
            $reqAbn ->execute();
            $alert = '<div class="alert alert-success mt-3 container text-center" role="alert"><h4>L\'abonnement a bien été enregistré</h4></div>';
            header( "refresh:1;url=profils.php?id=".$id );
        }
    } else {
        $alert = '<div class="alert alert-danger mt-3 container text-center" role="alert">Le client a deja un abonnement <strong>'.$typeSport.'</strong></div>';
    }
}
