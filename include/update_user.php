<?php
require_once 'database/database.php';
$db = getPdo();
if (isset($_POST['edit'])){
    $req=$db->prepare('select * from client where birth=:birth && firstName=:firstName && lastName=:lastName');
    $req->bindParam(':birth',$_POST['birth']);
    $req->bindParam(':firstName',$_POST['firstName']);
    $req->bindParam('lastName',$_POST['lastName']);
    $req->execute();
    $result = $req->fetch();
    if ($result && $result['id']!=$_GET['id']){
        $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Un utilisateur a deja le même nom & prénom et date de naissai</div>';
        echo "<meta http-equiv='refresh' content='0'>";
    } else {

        $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
        $action = $_SESSION['name'].' a mis à jour le profil de '.$_POST['firstName'].' '.$_POST['lastName'];
        $history->bindParam(':id',$_SESSION['id']);
        $history->bindParam(':action',$action);
        $history->execute();

        $req = $db->prepare('update client set firstName=:firstName, lastName=:lastName , cin=:cin , tel=:tel , adresse=:adresse where id=:id');
        $req->bindParam(':id',$_GET['id']);
        $req->bindParam(':firstName',$_POST['firstName']);
        $req->bindParam(':lastName',$_POST['lastName']);
        $req->bindParam(':cin',$_POST['cin']);
        $req->bindParam(':tel',$_POST['tel']);
        $req->bindParam(':adresse',$_POST['adresse']);
        $req->execute();
        $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert"><h4>Les informations ont bien été modifiés</h4></div>';
        header( "refresh:2;url=profils.php?id=".$_GET['id']."" );
    }
}
if (isset($_POST['editAdmin'])){
    $req=$db->prepare('select * from user where id=:id  && password=:password');
    $req->bindParam(':id',$_GET['id']);
    $req->bindParam(':password',$_POST['oldPwd']);
    $req->execute();
    if ($req->fetch()){
        $req=$db->prepare('update user set pseudo=:pseudo,password=:password where id=:id ');
        $req->bindParam(':id',$_GET['id']);
        $req->bindParam(':pseudo',$_POST['pseudo']);
        $req->bindParam(':password',$_POST['pwd']);
        $req->execute();
        $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert"><h4>Les informations ont bien été modifiés</h4></div>';

    } else {
        $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">L\'ancien mot de passe n\'est pas correct</div>';

    }


}

if (isset($_POST['subUser'])){
    $roles= ['Editeur'=>2,'Controlleur'=>3];
        $req = $db->prepare('select * from user where pseudo=:pseudo');
        $req->bindParam(':pseudo', $_POST['pseudoUser']);
        $req->execute();
        if ($req->fetch()) {
            $_SESSION['status'] = '<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Ce pseudo est deja utilisé veuillez choisir un autre pseudo</div>';
        } else {
            $req = $db->prepare('insert into user (name,pseudo,password,date_inscription ,id_type) values(:name,:pseudo,:password,NOW(), :id_type) ');
            $req->bindParam(':name', $_POST['nom']);
            $req->bindParam('pseudo', $_POST['pseudoUser']);
            $req->bindParam('password', $_POST['pwdUser']);
            $req->bindParam('id_type', $roles[$_POST['role']]);
            $req->execute();
            $_SESSION['status'] = '<div id="alert" class="alert alert-success mt-3 container text-center" role="alert">Utilisateur a bien été crée</div>';
            echo "<meta http-equiv='refresh' content='1'>";
        }

}

/*  show user & roles  */
$reqUsers = $db->prepare('select * from roles join user on user.id_type=roles.id && roles.id!=1 order by date_inscription desc');
$reqUsers->execute();
$users = $reqUsers->fetchAll(PDO::FETCH_ASSOC);
if (!$users){
    $_SESSION['status'] = '<div id="alert" class="alert alert-dark mt-3 container text-center" role="alert">Aucun utilisateur est ajouté </div>';
}

if (isset($_POST['editUser'])){
    $roles= ['Editeur'=>2,'Controlleur'=>3];

        $req = $db->prepare('update user set name=:name,pseudo=:pseudo,password=:password,id_type=:id_type where id=:id');
        $req->bindParam(':name', $_POST['nom']);
        $req->bindParam('pseudo', $_POST['pseudoUser']);
        $req->bindParam('password', $_POST['pseudoUser']);
        $req->bindParam('id_type', $roles[$_POST['role']]);
    $req->bindParam('id', $_GET['id']);
        $req->execute();
        $_SESSION['status'] = '<div id="alert" class="alert alert-success mt-3 container text-center" role="alert">Modifications effectués avec success</div>';
        echo "<meta http-equiv='refresh' content='1'>";


}

