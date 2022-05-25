<?php


class Controlle
{
    private $db;

  public function __construct()
  {
      $this->db = new PDO ('mysql:host=localhost;dbname=club','root','');
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
        $req = $this->db->prepare('select * from abonnement where id_client=:id_client && id=:id');
        $req->bindParam((':id_client'),$idClient);
        $req->bindParam((':id'),$_GET['activity']);
        $req->execute();
        $result = $req->fetch();
        return $result;
    }
    public function getControle (){
        $req = $this->db->prepare('select * from controlle join abonnement on controlle.id_abonnement=abonnement.id && id_abonnement=:id_abonnement order by date desc');
        $req->bindParam((':id_abonnement'),$_GET['activity']);
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