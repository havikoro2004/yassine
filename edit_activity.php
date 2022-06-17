<?php
$title='GERER LES ACTIVITES';
include_once ('head.php');
include_once 'database/database.php';
if ($_SESSION['role']==='Controlleur'){
    header('Location:index.php');
}
include_once 'include/activity.php';

$db=getPdo();
$req =$db->prepare('select * from abonnement where id=:id && id_client=:id_client');
$req->bindParam(':id',$_GET['abn']);
$req->bindParam(':id_client',$_GET['id']);
$req->execute();
$activity=$req->fetch();


if (isset($_POST['deleteAbn'])) {
    $req = $db->prepare('delete from abonnement where id=:id');
    $req->bindParam(':id', $_GET['abn']);
    $req->execute();
    $_SESSION['status'] = '<div id="alert" class="alert alert-dark mt-3 container text-center" role="alert"><h4>l\'abonnement a bien été suprimé</h4></div>';
    header( "refresh:2;url=profils.php?id=".$_GET['id']."" );
}

?>
<div id="headerActivity">
<?php
if (isset($_SESSION['status'])){
    echo $_SESSION['status'];
    unset($_SESSION['status']);
}
?>
</div>
<table class="table container text-center mt-5">
    <thead>
    <tr>
        <th scope="col">Nom de l'activité</th>
        <th scope="col">Date de début</th>
        <th scope="col">Date d'expiration</th>
        <th scope="col">Statue</th>
        <th scope="col">Reste à payer</th>
        <th scope="col">Dernier payement</th>
        <th>Date de renouvellement</th>
        <th>Remarque</th>
    </tr>
    </thead>
    <tbody>
    <tr>
            <?php
            $renew=null;
            if ($activity){
                $debut = date_create($activity['date_debut']);
                $fin = date_create($activity['date_fin']);
                $lastpayement =date_create($activity['lastPayement']);
                if ($activity['date_renew']){
                    $renouv = date_create($activity['date_renew']);
                    $renew = date_format($renouv,('d-m-Y'));
                }
                $status=null;
                if ($activity['status']==="inactif"){
                    $status = '<button class="btn btn-danger btnStatus" disabled><span class="d-flex justify-content-center">Expiré</span></button>';
                } else if ($activity['status']==="pause"){
                    $status = '<button class="btn btn-secondary btnStatus" disabled><span class="d-flex justify-content-center">Pause</span></button>';
                } else {
                    $status = '<button class="btn btn-info btnStatus text-white" disabled><span class="d-flex justify-content-center">Actif</span></button>';
                }
                $dateFin = date_format(new DateTime($activity['date_fin']),('d-m-y'));
                $start = date_format($debut,('d-m-Y'));
                $final = date_format($fin,('d-m-Y'));
                if ($activity['status']==="pause"){
                    $final="??-??-????";
                }
                echo'
                    <th>'.$activity['type_sport'].'</th>
                    <th>'.$start.'</th>
                    <th>'.$final.'</th>
                    <th>'.$status.'</th>
                    <th>'.$activity['reste'].'</th>
                    <th>'.date_format($lastpayement,('d-m-Y')).'</th>
                    <th>'.$renew.'</th>
                    <th>'.$activity['remarque'].'</th>
                ';
            }

            ?>
    </tr>
    </tbody>
</table>

    <div class="container text-center">
    <?php

    if ($activity['status']==="actif"){ ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
            Pause
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mettre en pause l'abonnement</h5>
                    </div>
                    <div class="modal-body">
                        Etes-vous sur de vouloir mettre en pause ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <form action="" method="post" ><button name="pause" type="submit" class="btn btn-primary">Valider</button></form>
                    </div>
                </div>
            </div>
        </div>
   <?php } else if ($activity['status']==="pause"){ ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Réactiver
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Réactiver l'abonnement</h5>
                    </div>
                    <div class="modal-body">
                        Etes-vous sur de vouloir réactiver ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <form action="" method="post" ><button name="react" type="submit" class="btn btn-primary">Valider</button></form>
                    </div>
                </div>
            </div>
        </div>
     <?php }

    ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#suprimer">
            Suprimer
        </button>
        <button class="btn btn-success" type="button" id="prolong">Renouveler</button>
    </div>

        <!-- Modal -->
        <div class="modal fade" id="suprimer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Suprimer l'activité</h5>
                    </div>
                    <div class="modal-body">
                        Vous êtes sur de vouloir suprimer ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <form  method="post">
                            <button id="deleteModal" name="deleteAbn" type="submit" class="btn btn-danger">Suprimer</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div id="renouv" class="container mt-4">

        </div>
<form class="container" action="" method="post">
    <input class="form-control mb-2" type="number" placeholder="Ajouté un payement" min="0" name="montant">
    <button name="regler" type="submit" class="btn btn-primary">Régler</button>
</form>
<script src="js/renouvelement.js"></script>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>