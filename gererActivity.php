<?php
include_once ('head.php');
include_once 'include/Controlle.php';

$abonnement = new Controlle();
$activity = $abonnement->getAbonnement($_GET['id']);


?>
<header class="d-flex justify-content-center align-items-center">
    <h1 class="display-5 bg-dark text-white col text-center p-3">Detail d'activité</h1>
</header>

<table class="table container text-center">
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
            } else {
                header( "Location:" );
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
        <button class="btn btn-success" type="button" id="prolong">Prolonger l'abonnement</button>
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
                            <button id="deleteModal" name="delete" type="submit" class="btn btn-danger">Suprimer</button>
                            <?php $abonnement->deleteAbonnement();?>
                        </form>

                    </div>
                </div>
            </div>
        </div>

<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>