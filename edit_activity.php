<?php
session_start();
$title='GERER LES ACTIVITES';
include_once ('head.php');
include_once 'include/activity.php';

$db = new PDO ('mysql:host=localhost;dbname=club','root','');
$req =$db->prepare('select * from abonnement where id=:id && id_client=:id_client');
$req->bindParam(':id',$_GET['abn']);
$req->bindParam(':id_client',$_GET['id']);
$req->execute();
$activity=$req->fetch();

if (is_int($activity['id_client']) && $activity['id_client'] = $_GET['id']){

} else {
    header('Location:profils.php?id='.$_GET['id'].'');
}
if (isset($_SESSION['status'])){
    echo $_SESSION['status'];
    unset($_SESSION['status']);
}
?>
<div id="headerActivity">

</div>
<table class="table container text-center mt-5">
    <thead>
    <tr>
        <th scope="col">Nom de l'activité</th>
        <th scope="col">Date de début</th>
        <th scope="col">Date d'expiration</th>
        <th scope="col">Statue</th>
    </tr>
    </thead>
    <tbody>
    <tr>
            <?php
            if ($activity){
                $status=null;
                if (!$activity['status']){
                    $status = '<button class="btn btn-danger btnStatus" disabled><span class="d-flex justify-content-center">Expiré</span></button>';
                } else {
                    $status = '<button class="btn btn-info btnStatus text-white" disabled><span class="d-flex justify-content-center">Actif</span></button>';
                }
                $dateFin = date_format(new DateTime($activity['date_fin']),('d-m-y'));
                echo'
                    <th>'.$activity['type_sport'].'</th>
                    <th>'.$activity['date_debut'].'</th>
                    <th>'.$activity['date_fin'].'</th>
                    <th>'.$status.'</th>
                ';
            }

            ?>
    </tr>
    </tbody>
</table>

    <div class="container text-center">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger me-2" data-toggle="modal" data-target="#exampleModal">
            Suprimer l'activité
        </button>
        <button class="btn btn-success" type="button" id="prolong">Renouveler</button>
    </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <?php

                                if (isset($_POST['deleteAbn'])){
                                    $req = $db->prepare('delete from abonnement where id=:id');
                                    $req->bindParam(':id',$_GET['abn']);
                                    $req->execute();
                                    $_SESSION['status']='<div id="alert" class="alert alert-info mt-3 container text-center" role="alert"><h4>Abonnement a bien été suprimé</h4></div>';
                                    echo '<meta http-equiv="refresh" content="0">';
                                }

                            ;?>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div id="renouv" class="container mt-4">

        </div>
<script src="js/renouvelement.js"></script>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>