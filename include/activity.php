<?php
$db = new PDO ('mysql:host=localhost;dbname=club','root','');
$alert =null;
            if (isset($_POST['addBtn'])){$db = new PDO ('mysql:host=localhost;dbname=club','root','');
                $reqActivity = $db ->prepare('select * from activity order by name ');
                $reqActivity->execute();
                if (!$reqActivity->fetch()){
                    $reqAdd = $db->prepare('insert into activity (name) values (:name) ');
                    $reqAdd->bindParam(':name',$_POST['add']);
                    $reqAdd->execute();
                    $alert = '<div class="alert alert-success mt-3 container text-center" role="alert"><h4>L\'activité a bien été ajoutée</h4></div>';
                    header( "refresh:1;url=activity.php" );
                } else {
                    $alert = '<div class="alert alert-danger mt-3 container text-center" role="alert">Cette activité existe deja</div>';
                }

            }
            $reqActivity = $db ->prepare('select * from activity order by name ');
            $reqActivity->execute();
            $activitys = $reqActivity->fetchAll();
            if (!$activitys){
                $alert = '<div class="alert alert-warning mt-3 container text-center" role="alert"><h4>Aucune activité n\'est ajoutée</h4></div>';
            }
