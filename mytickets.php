<?php

include("head.php");


?>



<style>
.clear {
    clear:both;    
}
.btn-info {
    margin-right:15px;
    text-transform:uppercase;
    padding:10px;
    display:block;
    float:left;
}
.btn-info a {
    display:block;
    text-decoration:none;
    width:100%;
    height:100%;
    color:#fff;
}
.more.label {
    float:right;    
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
	<div class="span8">
<?php

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

	require_once("session.php");

	

	require_once("php_includes/class.user.php");

	$auth_user = new USER();


	

	$user_id = $_SESSION['user_session'];



	$myproject = $auth_user->runQuery("SELECT DISTINCT * FROM projects where memberid = :id;");

	$myproject->execute(array(":id"=>$id));	

	$myprojectRow=$myproject->fetchAll(PDO::FETCH_ASSOC);

foreach($myprojectRow as &$rowSQL){



echo "<h1>";
echo $rowSQL['title'];
echo "</h1><p>";
echo $rowSQL['scope'];
echo "</p><p>Soumis le ";
echo $rowSQL['datecreated'];
echo "</p>";
echo "<u>Progression actuelle du projet :</u> ";
if ($rowSQL['status'] < 100)
{

echo "<bold>En cours de r&#233;alisation</bold>";

}
else
{
echo "<bold>Termin&#233;</bold>";
}
echo "<br><br><div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='";
echo $rowSQL['status'];
echo "aria-valuemin='0' aria-valuemax='100' style='width:";
echo $rowSQL['status'];
echo "%'>";
echo $rowSQL['status'];
echo "%</div></div>";
echo "<div><div class='more label'><a href='3Dproject.php?id=";
echo $rowSQL['googleid'];
echo "'>Voir le projet</a></div></div><div class='clear'></div><hr>";
}

?>   




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
