<?php
$db = new PDO('mysql:host=localhost;dbname=club', 'root', '');
$req = $db->prepare('select * from controlle join abonnement on controlle.id_abonnement=abonnement.id && id_abonnement=:id_abonnement order by date desc LIMIT :start, :final');
$req->bindParam((':id_abonnement'),$_GET['activity']);
$final = 100;
$page = $_GET['page'] ?? 1;
$req->bindParam(':final',$final,pdo::PARAM_INT);
$req->bindValue(':start' ,$final * ( (int)$page - 1)  , PDO::PARAM_INT );
$req->execute();
$result = $req->fetchAll(PDO::FETCH_ASSOC);

$countStatement = $db ->prepare('SELECT COUNT(*) as nbrresult FROM controlle where id_abonnement=:id_abonnement');
$countStatement->bindParam((':id_abonnement'),$_GET['activity']);
$countStatement->execute();
$totalresult = $countStatement->fetch(pdo::FETCH_ASSOC);
$nbrPage = ceil($totalresult['nbrresult'] / $final );

$title='HISTORIQUE CONTROLE';

include_once ('head.php');


if ($result){ ?>
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

    foreach ($result as $historique){
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
    <div class="text-center container-lg">

        <ul id="ulPagination" class="pagination pagin">
            <?php
            if ($nbrPage>1){
                for($i = 1 ; $i <= $nbrPage ; $i++ )
                {
                    if (isset($_GET['page'])){

                        if ($i!=$_GET['page']){
                            echo '<li class="page-item" aria-current="page"><a class="page-link pagination"
                        href="?id='.$_GET['id'].'&activity='.$_GET['activity'].'&page='.$i.'">'.$i.'</a></li>';
                        } else {
                            echo '<li class="page-item active" aria-current="page"><a class="page-link pagination"
                         href="?id='.$_GET['id'].'&activity='.$_GET['activity'].'&page='.$i.'">'.$i.'</a></li>';
                        }
                    } else {
                        echo '<li class="page-item" aria-current="page"><a class="page-link pagination"
                        href="?id='.$_GET['id'].'&activity='.$_GET['activity'].'&page='.$i.'">'.$i.'</a></li>';
                    }


                }
            }
            ?>
        </ul>

    </div>
<?php } else {
    echo $alert = '<div class="alert alert-danger mt-3 container text-center" role="alert"><h4>Aucun controlle n\'est éféctué</h4></div>';
}
?>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>