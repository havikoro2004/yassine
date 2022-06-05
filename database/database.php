<?php
function getPdo() :PDO
{
    $db = new PDO ('mysql:host=localhost;dbname=club','root','');
    return $db;
}