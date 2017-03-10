<?php

$googleid = $_GET['id'];


	require_once("session.php");

	

	require_once("php_includes/class.user.php");

	$auth_user = new USER();

	

	

	$user_id = $_SESSION['user_session'];

	

	$project = $auth_user->runQuery("SELECT * FROM projects WHERE googleid=:googleid");

	$project->execute(array(":googleid"=>$googleid));	

	$projectRow=$project->fetch(PDO::FETCH_ASSOC);



$idpro = $projectRow['id'];

$uidpro = $projectRow['userid'];

$midpro = $projectRow['memberid'];

$title = html_entity_decode($projectRow['title']);

$scope = html_entity_decode($projectRow['scope']);

$typ = $projectRow['type'];

$conf = $projectRow['conf'];

$idpro = $projectRow['id'];

$status = $projectRow['status'];

$datecreated = $projectRow['datecreated'];

$dateover = $projectRow['dateover'];

$datedebut = $projectRow['datedebut'];

$datefinish = $projectRow['datefinish'];

$comment = $projectRow['comment'];




	$fabuser = $auth_user->runQuery("select distinct firstname,lastname,email from users inner join projects where users.id = :midpro;");

	$fabuser->execute(array(":midpro"=>$midpro));

	$fabuRow=$fabuser->fetch(PDO::FETCH_ASSOC);

//select distinct firstname,lastname,email from users inner join projects where users.id = 17;
//select distinct firstname,lastname,email from users inner join projects where users.id = :midpro;

$fabfirstname = $fabuRow['firstname'];

$fablastname = $fabuRow['lastname'];

$fabemail = $fabuRow['email'];
	
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

*/


?>



<?php

include("head.php");

?>

<style>
@import url(http://fonts.googleapis.com/css?family=Open+Sans:700);
.panel-heading-fd{
    font-family: 'Open Sans', Helvetica, sans-serif;
    background: #39b1cc;
    background: -moz-linear-gradient(top, #51bbd2 0%, #2d97af 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #51bbd2), color-stop(100%, #2d97af));
    background: -webkit-linear-gradient(top, #51bbd2 0%, #2d97af 100%);
    background: -o-linear-gradient(top, #51bbd2 0%, #2d97af 100%);
    background: -ms-linear-gradient(top, #51bbd2 0%, #2d97af 100%);
    background: linear-gradient(to bottom, #51bbd2 0%, #2d97af 100%);
    color: #ffffff;
    padding: 5px 17px 8px;

}

.panel-title-fd{
    color: #ffffff;
    font-size: 14px;
    font-weight: 700;
    /*color: #d3eced;*/
    text-transform: uppercase;
    letter-spacing: 1px;


@import url("http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.body-panel
{
    overflow-y: scroll;
    height: 250px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
}
</style>
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
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Vous aimez le Fablab?</strong> Likez notre page facebook </a> ! <br>
<div class="fb-like" data-href="https://www.facebook.com/devincifablab/" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>                        
</div>
                    </div>
                </div>
                <!-- /.row -->


<div class="container">
	<div class="row">

<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading-fd">
                <h3 class="panel-title-fd">Votre projet : <?php echo $title; ?></h3>
            </div>

            <div class="panel-body">
                <div class="media">
      <a class="pull-left" href="#">
        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="img/logo1.png" style="width: 64px; height: 64px;">
      </a>
      <div class="media-body">
        <h4 class="media-heading"><a href="#"><?php echo $title; ?></a></h4>
        <u>Projet num :</u> <?php echo $idpro; ?><br>
        <u>Projet soumis le :</u> <?php echo $datecreated; ?><br>
        <u>Projet fini le :</u> <?php if ($dateover == "0000-00-00") { echo "Projet en cours";}else{echo $dateover;} ?><br>
        <u>Date pr&#233;f&#233;rentielle de d&#233;but :</u> <?php echo $datedebut; ?><br>
        <u>Date pr&#233;f&#233;rentielle de fin :</u> <?php echo $datefinish; ?><br>
	 <u>Type de projet :</u> <?php echo $typ; ?><br>
        <u>Etendu du projet :</u> <?php echo $conf; ?><br>
        <u>Description du projet :</u> <?php echo $scope; ?><br>
        <u>Commentaires :</u> <?php 
if (!isset($comment) || $comment != null) { echo $comment;} else { echo "Pas de commentaire disponible"; } ?><br>
	 <u>Votre fichier :</u><br><br>
<iframe src="https://drive.google.com/embeddedfolderview?id=<?php echo $googleid;?>#list" style="width:100%; height:130px; border:0;"></iframe>

<bold><?php if ($midpro < 1 ){echo "Votre projet n'a pas encore &#233;t&#233; pris en charge par un de nos membres";}
else{echo "Votre projet est sous la charge de "; echo $fabfirstname; echo " "; echo $fablastname; echo "."; 
echo "<br>Voici son email <a href='mailto:"; echo $fabemail; echo "'>"; echo $fabemail; echo "</a>"; } ?>  </bold>
<br><br>
<u>Progression actuelle du projet :</u> <br><br>
<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="<?php echo $status;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $status; ?>%">
    <?php echo $status;?>%
  </div>
</div>


      </div>
    </div>

<div class="container">
    <div class="row form-group">
        <div class="col-xs-12 col-md-offset-2 col-md-8 col-lg-8 col-lg-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Comments
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
                            </span>Refresh</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-time"></span>
                                Away</a></li>
                            <li class="divider"></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-off"></span>
                                Sign Out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body body-panel">
                    <ul class="chat">
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer clearfix">
                    <textarea class="form-control" rows="3"></textarea>
                    <span class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-xs-12" style="margin-top: 10px">
                        <button class="btn btn-warning btn-lg btn-block" id="btn-chat">Send</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

                
            </div>
        </div>
    </div>

</div>
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
