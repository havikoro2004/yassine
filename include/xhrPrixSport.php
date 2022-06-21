<?php
require_once '../database/database.php';
$db =getPdo();
if (isset($_POST['request']))
{
    $req = $db->prepare('select prix from activity where name=:name');
    $req->bindParam(':name',$_POST['request']);
    $req->execute();
    $result = $req->fetch();
}

echo $result['prix'];