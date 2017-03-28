<?php



	require_once("session.php");

	

	require_once("php_includes/class.user.php");

	$auth_user = new USER();

	

	

	$user_id = $_SESSION['user_session'];

	

	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");

	$stmt->execute(array(":user_id"=>$user_id));	

	$Row=$stmt->fetch(PDO::FETCH_ASSOC);

    

    $qr = $auth_user->runQuery("SELECT COUNT(*) as 'nbProject' FROM projects WHERE userid=:user_id");

    $qr->execute(array(":user_id"=>$user_id));    

    $infoRow=$qr->fetch(PDO::FETCH_ASSOC);

	
//print($userRow['email']);


/*

$firstname = $userRow['firstname'];

$name = $userRow['lastname'];
	
$email = $userRow['email'];

$phone = $userRow['phone'];

$year = $userRow['year'];

$type = $userRow['type'];

$nbpro = $userRow['nbpro'];

$joining_date = $userRow['joining_date'];

$lastlogin = $userRow['lastlogin'];

$nb_login = $userRow['nb_login'];

$nb_new_msg = $userRow['nb_new_msg'];

*/
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
                            &nbsp;MyFab <small>Votre espace Maker</small>

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
                <!-- /.row -->



                <div class="row">
                    <div class="col-lg-12">
                 
                 <?php 

                 if($nb_login < 2)
                 {
                    echo  "<div class='alert alert-info alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <i class='fa fa-info-circle'></i>  <strong>Bienvenue sur votre platerforme MyFab $firstname $name!</strong> <br>                    
                            </div>";
                 }

                 if($nb_login > 5)
                 {}
                 else {
                          # code...
                      
                       echo  "<div class='alert alert-info alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <i class='fa fa-info-circle'></i>  <strong>Vous aimez le Fablab?</strong> Likez notre page facebook </a> ! <br>
<div class='fb-like' data-href='https://www.facebook.com/devincifablab/'' data-layout='standard' data-action='like' data-size='large' data-show-faces='true' data-share='true'></div>                        
</div>";

    } ?>
                    </div>
                </div>
                <!-- /.row -->


  
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-cogs fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $infoRow['nbProject']; ?></div>
                                        <div>MyFab Projects!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"><a href="myprojects.php">Manager mes projets</a></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $nb_new_msg; ?></div>
                                        <div>Nouveaux Messages!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Consulter mes messages</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                  <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bell fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">0</div>
                                        <div>Notifications!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir mes notifications</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">0</div>
                                        <div>Demandes Support Projet!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Voir mes demandes</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

         <div class="containercar">
        <div id="carousel">
			<figure><img src="http://lorempixel.com/186/116/nature/1" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/2" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/3" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/4" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/5" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/6" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/7" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/nature/8" alt=""></figure>
			<figure><img src="http://lorempixel.com/186/116/people/9" alt=""></figure>
		</div>
	</div>      

               
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

include("tail.php");

?> 
