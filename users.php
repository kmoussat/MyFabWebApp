<?php

include("head.php");


if($type < 2)
{
header('Location : index.php');
exit();
}


if(isset($_POST['submit']))
{
if (!isset($_POST['uid']) || !isset($_POST['pid']))
{
//do nothing
}
else
{

try
{

$conn = null;
include('php_includes/db_con.php');
$sql = "UPDATE projects SET memberid = '".$_POST['uid']."' WHERE id = '".$_POST['pid']."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenure! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }

try
{
$sql = "UPDATE projects SET status = '50'  WHERE id = '".$_POST['pid']."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenure! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }

header('Location : stprojects.php');
$conn = null;
}
}

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



	$myproject = $auth_user->runQuery("SELECT DISTINCT * FROM users;");

	$myproject->execute(array(":id"=>$id));	

	$myprojectRow=$myproject->fetchAll(PDO::FETCH_ASSOC);

foreach($myprojectRow as &$rowSQL){



echo "<form method='post' action='users.php'><h1>";
echo $rowSQL['firstname'];
echo "</h1><p>";
echo $rowSQL['name'];
echo "</p><p>A rejoint le ";
echo $rowSQL['joining_date'];
echo "</p>";
echo "<input type='hidden' name='pid' value='";
echo $rowSQL['id'];
echo "'/>";
echo "<input type='hidden' name='uid' value='";
echo $user_id;
echo "'/>";
//echo $user_id;
if ($rowSQL['type'] < 1)
{
echo "<input type='button' class='btn btn-success' value='Utilisateur' disabled/>";
}
else
{
echo "<input type='submit' class='btn btn-warning' id='submit' name='re' value='Membre ou admin' />";
}
echo "<div class='clear'></div></form><hr>";
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
