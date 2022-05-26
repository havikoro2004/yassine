<?php
session_start();
$title='PROFIL CLIENT';
include_once ('head.php');
include_once 'include/get.php';
include_once 'include/activity.php';
include_once 'include/abonnement.php';
clearstatcache(true);

?>


<div id="root"></div>
<?php
if (isset($_SESSION['status'])){
    echo $_SESSION['status'];
    unset($_SESSION['status']);
}
if ($alert){echo $alert ;} ?>
<div class="cont_profil container">
    <div class="profilUser mt-5 d-flex flex-column align-items-center mb-3 justify-content-around">
        <img class="mb-2" width="85%" height="85%" src="images/<?= $photo ; ?>" alt="">
        <h3 class="text-center"><?= strtoupper($firstName) .' '. strtoupper($lastName) ; ?></h3>
    </div>
    <div class="mt-4 infosUser">
        <ul class="list-group">
            <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg> Genre : <?= $genre ?></li>
            <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date-fill" viewBox="0 0 16 16">
                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2z"/>
                    <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z"/>
                </svg> Date de naissance : <?= date_format($birth,('d-m-Y'))?></li>
            <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                    <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z"/>
                    <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z"/>
                    <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z"/>
                    <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z"/>
                    <path d="M12 9h2V8h-2v1Z"/>
                </svg> Numéro de Badge : <?= $badge ?></li>
            <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>
                </svg> Tel : <?= $tel ?></li>

            <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-plus" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                    <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM8 8a.5.5 0 0 1 .5.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5A.5.5 0 0 1 8 8z"/>
                </svg> Date d'inscription : <?= date_format($date,('d-m-Y')) ?></li>
        </ul>
        <div class="d-flex ">
            <form method="post">
                <button class="btn btn-primary my-3 me-2"><a class="text-white text-decoration-none" href="update_user.php?id=<?= $_GET['id'] ?>">Modifier les infos</a></button>
            </form>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger my-3 me-2" data-toggle="modal" data-target="#exampleModal">
                Suprimer le profil
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body text-center">
                            Etes-Vous sure de vouloir suprimer le client ?
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <form method="post">
                                <button type="submit" name="deleteUser" class="btn btn-danger">Suprimer le profil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                <button type="button" id="abn" class="btn btn-dark my-3 me-2">Ajouter un Abonnement</button>
                <button id="closeIcone" class="my-3 btn btn-outline-danger" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
                </button>

        </div>
    </div>
</div>

<?php
$teste[]=null;
if (count($resultAbon)> 0){

    ?>

    <form name="check" id="check"  action="" method="post">
        <?= $check ; ?>
    </form>


  <?php  echo '  <table id="table"  class="table table-hover container text-center table-profils">
                    <thead class="bg-dark text-white ">
                    <tr>
                        <th scope="col">Activité</th>           
                        <th scope="col">Status</th>
                        <th scope="col">Controller</th>
                        <th scope="col">Tous les controles</th>
                        <th scope="col">Gérer l\'abonnement</th>
                    </tr>
                    </thead>
                    <tbody>';

    foreach ($resultAbon as $abn){
        $status=null;
        if (!$abn['status']){
            $status = '<button class="btn btn-danger btnStatus" disabled><span class="d-flex justify-content-center">Expiré</span></button>';
        } else {
            $status = '<button class="btn btn-info btnStatus text-white" disabled><span class="d-flex justify-content-center">Actif</span></button>';
        }
        $dateFin = date_format(new DateTime($abn['date_fin']),('d-m-y'));
        if ($abn['status']){
            $btn = '<button id="alert" class="btn btn-success btnStatus" type="submit" name="valider'.$abn['id'].'"><span class="d-flex justify-content-center">Valider</span></button>';
        } else {
            $btn = '';
        }
        echo '
      
                 <tr>
                     <th scope="row">'.$abn['type_sport'].'</th>

                     <th>'.$status.'</th>
                     <th><form method="post">'.$btn.'</form></th>
                     <th>
                         <button class="btn btn-primary">
                         <a class="text-white text-decoration-none btnStatus" href="controlles_history.php?id='.$_GET['id'].'&activity='.$abn['id'].'"><span class="d-flex justify-content-center">Voir</span></a>
                         </button>
                     </th>
                     <th> 
                        <button class="btn btn-outline-primary">
                            <a href="edit_activity.php?id='.$abn['id_client'].'&abn='.$abn['id'].'"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                     <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                       <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                        </button>
                     </th>
       
             </tr>
        ';

        if (isset($_POST['valider'.$abn['id']])){

            $reqDelet = $db->prepare('insert into controlle (id_abonnement,date) values (:id_abonnement,NOW()) ');
            $reqDelet->bindParam(':id_abonnement',$abn['id']);
            $reqDelet->execute();
            echo"<meta http-equiv='refresh' content='0'>";

            $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert"><h4>Le client a bien été controlé</h4></div>';
        }

    }


}


?>

</tbody>
</table>

<div id="root2">
    <form  class="container" action="" method="post">
    <table class="table container">
        <thead>
        <tr>
            <th scope="col">Nom de l'activité</th>
            <th scope="col">Date de début</th>
            <th scope="col">Date de fin</th>
        </tr>
        <tr>
            <th>

                    <select name="type_sport" class="form-control" id="selectSport">
                        <option>Choisir une activité</option>
                        <?php foreach ($activitys as $activity){
                            echo '      <option>'.$activity['name'].'</option>';
                        } ?>
                    </select>
                </th>
            <th>
                <input class="form-control" type="date" id="date_debut" name="date_debut">
            </th>
            <th>
                <input class="form-control" type="date" id="date_fin" name="date_fin">
            </th>
        </tr>
        </tbody>
    </table>
        <div class="container text-center"><button id="subAbn" type="submit" class="btn btn-primary mb-5 " style="width: 30vw" name="validerAbn">Valider</button></div>
    </form>

</div>

<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>