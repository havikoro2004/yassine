<?php
$title='ACTIVITES';
include_once ('head.php');
include_once 'include/activity.php';


clearstatcache(true);
$activity=null;

?>
<div id="root3">
    <?php
    if (isset($_SESSION['status'])){
        echo $_SESSION['status'];
        unset($_SESSION['status']);
    }
    if ($alert){echo $alert;}
    ?>

</div>
<div class="border container mt-2 rounded">
    <h2 class="my-5 text-center">Liste des activités</h2>
    <div id="editActivitys">

    </div>
    <div class="mb-5">
                <?php
                if ($activitys){ ?>
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">Nom de l'activité</th>
                            <th scope="col">Prix en DH</th>
                            <th scope="col">Activité par semaine</th>
                            <?php
                             if ($_SESSION['role']==='Admin' || $_SESSION['role']==='Editeur'){ ?>
                                 <th scope="col">Modifier</th>
                                 <th scope="col">Suprimer </th>
                           <?php  }  ?>

                        </tr>
                        </thead>
                        <tbody id="tableActivitys">

                  <?php  foreach ($activitys as $activity){
                        if (isset($_POST['dActivity'.$activity['id']])){
                            $req = $db->prepare('select * from abonnement where type_sport=:type_sport');
                            $req->bindParam(':type_sport',$activity['name']);
                            $req->execute();
                            $result = $req->fetch();
                            if ($result){
                                echo "<meta http-equiv='refresh' content='0'>";
                                $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Vous ne pouvez pas suprimer cette activité appartient à un abonnement</div>';
                            } else {
                                $deleteReq = $db->prepare('delete from activity where id=:id && name=:name');
                                $deleteReq->bindParam('id',$activity['id']);
                                $deleteReq->bindParam('name',$activity['name']);
                                $deleteReq->execute();
                                $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Activité suprimée</div>';
                                echo "<meta http-equiv='refresh' content='0'>";

                            }
                        }
                        echo
                            '  
                        
                            ';

                        if ($_SESSION['role']==='Admin' || $_SESSION['role']==='Editeur'){
                            if (isset($_POST[$activity['id']])){
                                $nbrS = $_POST['nbrActivity'];
                                $regex2 = '/[0-9]/';
                                $subject = $_POST['name'];
                                $regex = '/[\w]/';

                                if (!preg_match_all($regex2,$nbrS) || $nbrS < 0){
                                    $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Opération impossible</div>';
                                    echo "<meta http-equiv='refresh' content='0'>";
                                } else {
                                    if (preg_match_all($regex,$subject)){
                                        $name = strtoupper($_POST['name']);
                                        $req2=$db->prepare('select name from activity where name!=:name');
                                        $req2->bindParam(':name',$activity['name']);
                                        $req2->execute();
                                        $result = $req2->fetchAll(PDO::FETCH_ASSOC);
                                        $activityName=[];
                                        foreach ($result as $act){
                                            $activityName[]=$act['name'];
                                        }
                                        if (!in_array($name,$activityName)){
                                            $req1 = $db->prepare('update abonnement set type_sport=:name where type_sport=:post');
                                            $req1->bindParam(':name',$name);
                                            $req1->bindParam('post',$activity['name']);
                                            $req1->execute();

                                            $req = $db->prepare('update activity set name=:name , prix=:prix,nbrActivity=:nbrActivity where id=:id');
                                            $name = strtoupper($_POST['name']);
                                            $prix =$_POST['prix'];
                                            $nbrActivity=$_POST['nbrActivity'];

                                            $req->bindParam(':id',$activity['id']);
                                            $req->bindParam(':name',$name);
                                            $req->bindParam(':prix',$prix);
                                            $req->bindParam(':nbrActivity',$nbrActivity);
                                            echo "<meta http-equiv='refresh' content=0>";
                                            $_SESSION['status']='<div id="alert" class="alert alert-success mt-3 container text-center" role="alert">Modification effectuée avec success</div>';
                                            $req->execute();
                                        } else {
                                            echo "<meta http-equiv='refresh' content=0>";
                                            $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Il semble qu\'il y a deja une activité avec le même nom</div>';
                                        }
                                    } else {
                                        echo "<meta http-equiv='refresh' content=0>";
                                        $_SESSION['status']='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Le nom de l\'activité doit être en format alphanumérique</div>';
                                    }

                                }
                            }
                            echo '  
                                <tr>
                              <form method="post">
                                <td><input maxlength="25" name="name" class="text-center" style="border:none" type="text" value="'.$activity['name'].'"></td>
                                <td><input min=0 name="prix" class="text-center"  style="border:none" type="number" value="'.$activity['prix'].'"></td>
                                <td><input min=0 max=10 name="nbrActivity" class="text-center"  style="border:none" type="text" value="'.$activity['nbrActivity'].'"></td>
                                <td><button name='.$activity['id'].' class="btn btn-primary" type="submit">Valider</button></td>  
                              </form>           
                                <td> 
                            <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal'.$activity['id'].'">
                                  Suprimer activité
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal'.$activity['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                             
                                      <div class="modal-body">
                                        <h4>Attention</h4>
                                
                                        Vous êtes sur le point de suprimer une activité
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <form action="" method="post"><button name="dActivity'.$activity['id'].'" type="submit" class="btn btn-danger">Confirmer</button></form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                          </td>
                          </tr>';
                        } else {
                            echo '
                            <tr><td><input readonly class="text-center" style="border:none" type="text" value="'.$activity['name'].'"></td>
                            <td><input readonly class="text-center"  style="border:none" type="text" value="'.$activity['prix'].'"></td>
                            <td><input readonly class="text-center"  style="border:none" type="text" value="'.$activity['nbrActivity'].'"></td>
                            ' ;
                        }

                        ?>

                            <?php  }

                }

                ?>

            </tbody>
        </table>

    </div>
    <?php
    if ($_SESSION['role']==='Admin' || $_SESSION['role']==='Editeur'){ ?>
        <form action="" method="post" class="form-inline d-flex container mb-5">
        <button id="addBtn" name="addBtn" type="submit" class="btn btn-dark me-2">Ajouter</button>
        <input maxlength="30" id="add" id="filter" name="add" class="form-control mr-sm-2 me-2" type="search" placeholder="Ajouter une activité" aria-label="Search">
        <input id="prix" name="prix" placeholder="Prix" class="form-control me-2" type="number" min="0">
            <input id="nbrActivity" name="nbrActivity" placeholder="Nombre d'activité par semaine" class="form-control" type="number" min="0">
    </form>
  <?php  }    ?>

</div>
<script src="js/jquery.js"></script>
<script src="js/script.js" ></script>
<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>