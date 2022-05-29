<?php
$db = new PDO ('mysql:host=localhost;dbname=club','root','');
$alert=null;
$res=null;
if (isset($_POST['submit'])){
    $badge=htmlspecialchars($_POST['badge']);
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $birth = $_POST['birth'];
    $genre = $_POST['genre'];
    $cin = htmlspecialchars($_POST['cin']);
    $tel = $_POST['tel'];
    $adresse = htmlspecialchars($_POST['adresse']);

    $req = $db->prepare('select * from client where firstName=:firstName && lastName=:lastName && birth=:birth ');

    $req->bindParam(':firstName',$firstName);
    $req->bindParam(':lastName',$lastName);
    $req->bindParam(':birth',$birth);


    $req->execute();
    $result = $req->fetch();

    $req->execute();
    $result = $req->fetch();

    if ($result > 0){
        $alert = '<div class="alert alert-
        danger mt-3" role="alert"><h2>Il semble qu\'il y a deja un utilisateur avec ces coordonées </h2></div>';
    } else {

        $req = $db->prepare('insert into client (badge,firstName,lastName,birth,genre,cin,tel,adresse,date) values (:badge,:firstName,:lastName,:birth,:genre,:cin,:tel,:adresse, NOW())');
        $req->bindParam(':badge',$badge);
        $req->bindParam(':firstName',$firstName);
        $req->bindParam(':lastName',$lastName);
        $req->bindParam(':birth',$birth);
        $req->bindParam(':genre',$genre);
        $req->bindParam(':cin',$cin);
        $req->bindParam(':tel',$tel);
        $req->bindParam(':adresse',$adresse);

        $req->execute();

        $alert = '<div class="alert alert-success mt-3" role="alert"><h2>Le client a bien été enregistré</h2></div>';

        $reqProfil = $db->prepare('select * from client where badge=:badge');
        $reqProfil->bindParam(':badge',$badge);
        $reqProfil->execute();
        $resultProfil = $reqProfil->fetch();
        header( "refresh:2;url=profils.php?id=".$resultProfil['id']."" );
    }
}

/*  Liste des dernier clients inscrit  */
$reqAll = $db->prepare('select * from client order by date desc LIMIT :start, :final ');
$final = 20;
$page = $_GET['page'] ?? 1;
$reqAll->bindParam(':final',$final,pdo::PARAM_INT);
$reqAll->bindValue(':start' ,$final * ( (int)$page - 1)  , PDO::PARAM_INT );
$reqAll->execute();

$countStatement = $db ->prepare('SELECT COUNT(*) as nbrresult FROM client');
$countStatement->execute();
$totalresult = $countStatement->fetch(pdo::FETCH_ASSOC);
$nbrPage = ceil($totalresult['nbrresult'] / $final );

$resultAll = $reqAll->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['chercher'])){
    if (!empty($_POST['filter'])){
        if ($_POST['select']==='Nom'){
            strtolower($_POST['filter']);
            $req = $db->prepare('select * from client where lastName=:lastName');
            $req->bindParam(':lastName',$_POST['filter']);
            $req->execute();
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            if (!$res){$alert = '<div class="alert alert-danger mt-3 container text-center" role="alert">Aucun resultat n\'est trouvé avec le nom <strong>'.$_POST['filter'].'</strong></div>';}
        }
        else if ($_POST['select']==='Prénom'){
            strtolower($_POST['filter']);
            $req = $db->prepare('select * from client where firstName=:firstName');
            $req->bindParam(':firstName',$_POST['filter']);
            $req->execute();
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            if (!$res){$alert = '<div class="alert alert-danger mt-3 container text-center" role="alert">Aucun resultat n\'est trouvé avec le prénom <strong>'.$_POST['filter'].'</strong></div>';}
        } else if ($_POST['select']==='Badge'){
            strtolower($_POST['filter']);
            $req = $db->prepare('select * from client where badge=:badge');
            $req->bindParam(':badge',$_POST['filter']);
            $req->execute();
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            if (!$res){$alert = '<div class="alert alert-danger mt-3 container text-center" role="alert">Aucun resultat n\'est trouvé avec la date <strong>'.$_POST['filter'].'</strong></div>';}
        }
        else if ($_POST['select']==='Date de naissance'){
            strtolower($_POST['filter']);
            $req = $db->prepare('select * from client where birth=:birth');
            $req->bindParam(':birth',$_POST['filter']);
            $req->execute();
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            if (!$res){$alert = '<div class="alert alert-danger mt-3 container text-center" role="alert">Aucun resultat n\'est trouvé avec le badge <strong>'.$_POST['filter'].'</strong></div>';}
        }
    } else {$alert = '<div class="alert alert-danger mt-3 container text-center" role="alert">Veuillez saisir un mot clé de recherche</div>';}
}

?>