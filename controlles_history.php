<?php
$title='HISTORIQUE CONTROLE';
include_once 'include/Controlle.php';
include_once ('head.php');
$controlle = new Controlle();
$history = $controlle->getControle();

if ($history){ ?>
    <h2 class="my-4 text-center">Derniers controles</h2>
    <hr class="my-4 container">
    <table class="table container text-center">
    <thead>
    <tr>

        <th scope="col">Nom de l'activité</th>
        <th scope="col">Date d'inscription</th>
        <th scope="col">Date d'expiration</th>
        <th scope="col">La date de controle</th>
        <th scope="col">L'heure du controle</th>
        <th scope="col">Par</th>
    </tr>
    </thead>
    <tbody>

    <?php

    foreach ($history as $historique){
        $dateDebut = date_format(new DateTime($historique['date_debut']),('d-m-Y'));
        $dateFin = date_format(new DateTime($historique['date_fin']),('d-m-Y'));
        $dateControle = date_format(new DateTime($historique['date']),('d-m-Y'));
        $heureControlle = date_format(new DateTime($historique['date']),('H:i'));
        echo '
        
        <tr>
            <td>'.$historique['type_sport'].'</td>
            <td>'.$dateDebut.'</td>
            <td>'.$dateFin.'</td>
            <td>'.$dateControle.'</td>
            <td>'.$heureControlle.'</td>
            <td>'.$historique['id_user'].'</td>
        </tr>
        
        ';
    }

    ?>

    </tr>
    </tbody>
</table>

<?php } else {
    echo $alert = '<div class="alert alert-danger mt-3 container text-center" role="alert"><h4>Aucun controlle n\'est éféctué</h4></div>';
}
?>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>