<?php
require_once 'vendor/autoload.php';
require_once 'database/database.php';
$db = getPdo();
$dp = new mysqli('localhost', 'root', '', 'club');

if (isset($_POST['save'])){
    $req = $db->prepare('insert into save (folderName,date) values (:name , NOW())');
    $date = date_create();
    $savDate = date_format($date,('ymdHi'));

    $req->bindParam(':name',$savDate);
    $req->execute();
    $dump = new MySQLDump($dp);
    $dump->save('databaseSave/'.$savDate.'.sql.gz');
    echo '<div id="alert" class="alert alert-success mt-3 container text-center" role="alert">La base de donnée a bien été enregistrée</div>';
}

$req = $db->prepare('select * from save');
$req->execute();
$sauvegarde = $req->fetchAll(PDO::FETCH_ASSOC);

if ($sauvegarde){
    foreach ($sauvegarde as $save){

        if (isset($_POST[$save['folderName']])){
            $import = new MySQLImport($dp);
            $import->load('databaseSave/'.$save['folderName'].'.sql.gz');
        }
    }
}