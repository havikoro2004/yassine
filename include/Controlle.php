<?php

require_once 'database/database.php';

class Controlle
{
    private $db;

  public function __construct()
  {
      $this->db = getPdo();
  }
    public function getClient($e){
        $req = $this->db->prepare('select * from client where badge=:badge');
        $req->bindParam((':badge'),$e);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $list){
            return $list;
        }
    }
    public function getAbonnement($idClient){
        $req = $this->db->prepare('select * from abonnement where id_client=:id_client');
        $req->bindParam((':id_client'),$idClient);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getById($id){
        $req = $this->db->prepare('select * from client where id=:id');
        $req->bindParam((':id'),$id);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $list){
            return $list;
        }
    }

}