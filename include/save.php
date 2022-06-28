<?php
require_once 'vendor/autoload.php';
require_once 'database/database.php';
$db = getPdo();
$dp = new mysqli('localhost', 'root', '', 'club');

if (isset($_POST['save'])){
    $req1 =$db->prepare('select * from nbrsave where id=1');
    $req1->execute();
    $resa = $req1->fetch();
    $count =$resa['nbr'];
    if ($count < 2 ){
        $count++;
        $nbrsave = $db->prepare('update nbrSave set date=NOW(),nbr=:nbr where id=1');
        $nbrsave->bindParam(':nbr',$count);
        $nbrsave->execute();

        $req= $db->prepare('select photo from client');
        $req->execute();
        $img = $req->fetchAll(PDO::FETCH_ASSOC);

        $req = $db->prepare('insert into save (folderName,date) values (:name , NOW())');
        $date = date_create();
        $savDate = date_format($date,('ymdHi'));

        $folderName = 'databaseSave/'.$savDate.'';
        if(!is_dir($folderName))
        {
            mkdir($folderName, 0777);
        }

        $scan = scandir('./images/img_users');
        foreach ($scan as $file){
            if ($file!=='.' && $file!=='..'){
                copy("images/img_users/$file","databaseSave/$savDate/$file");
            }
        }

        $req->bindParam(':name',$savDate);
        $req->execute();
        $dump = new MySQLDump($dp);
        $dump->save('databaseSave/'.$savDate.'.sql.gz');


        $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
        $action ='a fait une sauvegarde de la base de donnée';
        $history->bindParam(':id',$_SESSION['id']);
        $history->bindParam(':action',$action);
        $history->execute();


        echo '<div id="alert" class="alert alert-success mt-3 container text-center" role="alert">La base de donnée a bien été enregistrée</div>';
    } else {
        echo '<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Vous avez le droit qu\'à 2 sauvegardes par jour</div>';
    }

}


$req = $db->prepare('select * from save ORDER BY date DESC LIMIT 50');
$req->execute();
$sauvegarde = $req->fetchAll(PDO::FETCH_ASSOC);

if ($sauvegarde){

    foreach ($sauvegarde as $save){
        $folder =$save['folderName'];
        $scan = scandir('./databaseSave/'.$folder.'');

        if (isset($_POST[$save['folderName']])){
            echo '<div id="alert" class="alert alert-success mt-3 container text-center" role="alert">La base de donnée a bien été restaurée</div>';
            foreach ($scan as $file){
                if ($file!=='.' && $file!=='..'){
                    copy("./databaseSave/$folder/$file","images/img_users/$file");
                }
            }
            $import = new MySQLImport($dp);
            $import->load('databaseSave/'.$save['folderName'].'.sql.gz');

            $history = $db->prepare('insert into suivi (action,date,id_user) values (:action , NOW() , :id)');
            $action ='a effectué une restauration de la base de donnée';
            $history->bindParam(':id',$_SESSION['id']);
            $history->bindParam(':action',$action);
            $history->execute();

        }

    }
}