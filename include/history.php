<?php
$db=getPdo();

$req = $db->prepare('select * from suivi join user on suivi.id_user=user.id where suivi.id_user=:id ORDER BY date DESC LIMIT :start, :final');
$req->bindParam(':id',$_GET['id']);
$final = 100;
$page = $_GET['page'] ?? 1;
$req->bindParam(':final',$final,pdo::PARAM_INT);
$req->bindValue(':start' ,$final * ( (int)$page - 1)  , PDO::PARAM_INT );
$req->execute();
$result = $req->fetchAll(PDO::FETCH_ASSOC);

$countStatement = $db ->prepare('SELECT COUNT(*) as nbrresult FROM suivi where id_user=:id');
$countStatement->bindParam((':id'),$_GET['id']);
$countStatement->execute();
$totalresult = $countStatement->fetch(pdo::FETCH_ASSOC);
$nbrPage = ceil($totalresult['nbrresult'] / $final );

if (!$result){
    $_SESSION['status'] = '<div id="alert" class="alert alert-dark mt-3 container text-center" role="alert">Aucun historique n\'est trouvé</div>';
}