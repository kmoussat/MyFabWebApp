<?php


	require_once("session.php");
	require_once("php_includes/class.user.php");
	require_once("php_includes/requetes.php");
	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	//------------------------
    try{
        //code ok mais il faut externaliser le process en utilisant la même connection ! impératif !
        //remplacer 34 par :user_id
        $graph1 = $auth_user->runQuery("SELECT COUNT(title) as 'nbProj' FROM  projects WHERE userid =34 ;");
        $graph1->execute(array(":user_id"=>$user_id));
        $graph1=$graph1->fetch(PDO::FETCH_ASSOC);
       
        $graph2 = $auth_user->runQuery("SELECT COUNT(title) as 'nbProjDone' FROM  projects WHERE userid =34 AND status = 100;");
        $graph2->execute(array(":user_id"=>$user_id));
        $graph2=$graph2->fetch(PDO::FETCH_ASSOC);

        $graph3 = $auth_user->runQuery("SELECT title, status, datedebut FROM  projects WHERE userid = 34 ORDER BY datedebut;");
        $graph3->execute(array(":user_id"=>$user_id));
        $graph3=$graph3->fetchall();

        //requêtes pour stats générales
        $graph4 = $auth_user->runQuery("SELECT COUNT(title) as 'nbProj' FROM  projects;");
        $graph4=$graph4->fetch(PDO::FETCH_ASSOC);
        
    }
    catch(PDOException $e){
        $e->getMessage();
        $graph1 = $e;
    }

?>

<?php
include("head.php");
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
														<img src="img/logo1.png" alt="My Fablab" style="width:50px;height:50px;">
                            &nbsp;MyFab <small>Votre espace Maker</small> - Statistiques
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> MyFab - Statut
<?php
switch ($type) {
    case 0:
        echo "Utilisateur";
        break;
    case 1:
        echo "Membre Fablab";
        break;
    case 2:
        echo "Administrateur";
        break;
}



?>
                            </li>
                        </ol>
                    </div>
                </div>
	
				<!-- PARTIE PRINCIPALE -->
               

                <h1>Page en travaux ...</h1>
				
				<div class="row">
					<div class="col-lg-10 well col-md-offset-1">
    					<ul class="nav nav-tabs">
      						<li class="active"><a href="#mystats" data-toggle="tab">Mes Stats</a></li>
      						<li><a href="#allstats" data-toggle="tab">Statistique générales</a></li>
    					</ul>
    					<div id="myTabContent" class="tab-content">
      						<div class="tab-pane active in" id="mystats">
       							<?php /*
       							METTRE ICI LE CONTENU DES STATS PERSO -->
                               
                                    Doit apparaitre :
                                        - nombre de projets en cours : $graph1['nbProj']
                                        - nombre de projets finis : $graph2['nbProjDone']
                                        - Pourcentage de projets réalisés (calcul direct)
                                        - graph temporel des départ de projets avec pourcentage
									
									On fait un canvas par graphique
                                */?>
                                <div class="col-lg-6">
									<canvas id="graph1_p" height="400" width="400"></canvas>
									<canvas id="graph3_p" height="400" width="400"></canvas>
            					</div>
                                <div class="col-lg-6">
                                    <canvas id="graph2_p" height="400" width="400"></canvas>
                                    <canvas id="graph4_p" height="400" width="400"></canvas>
                                </div>
      						</div>
      						<div class="tab-pane fade" id="allstats">
                                <br>
      							<p>Nombre de projets total : <?php print $graph4['nbProj'] ?></p>	
      						</div>

  						</div>
    				</div>
  				</div>


           


                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

include("tail.php");

?>
