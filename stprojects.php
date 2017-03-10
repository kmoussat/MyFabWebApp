<?php

include("head.php");


if($type < 1)
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

$a = "stprojects.php#pid";
$b = $a . $_POST['pid'];

header('Location : $b');
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
        <div id="filter-panel" >
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" role="form" name="search" method="get" action="stprojects.php">
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Chercher:</label>
                            <input type="text" name="text_search" class="form-control input-sm" id="pref-search">
                        </div><!-- form group [search] -->
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-orderby">&nbsp;Chercher par:</label>
                            <select id="pref-orderby" name="search_type" class="form-control">
				<option value="title">Tout</option>
                                <option value="datecreated">Date</option>
				<option value="title">Titre</option>
				<option value="status">Progression</option>
                            </select>                                
                        </div> <!-- form group [order by] --> 
			<div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-orderby">&nbsp;Ordonner par:</label>
                            <select id="pref-orderby" name="order_by" class="form-control">
                                <option value="ASC">Croissant</option>
				<option value="DESC">Decroissant</option>
                            </select>                                
                        </div> <!-- form group [order by] --> 
			&nbsp;
                        <div class="form-group">    
                            <button type="submit" id="search" name="search" class="btn btn-default filter-col">
                                <span class="glyphicon glyphicon-record"></span> Rechercher
                            </button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>    
	</div>
</div>


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


$search_type = $_GET['search_type'];
$text_search = $_GET['text_search'];
$order_by = $_GET['order_by'];
echo $search_type;
echo $text_search;
echo $order_by;

if(isset($_GET['search']))
{



       $myproject = $auth_user->runQuery("SELECT DISTINCT * FROM projects where $search_type LIKE '%$text_search%' ORDER BY $search_type $order_by;");

}
else
{
	$myproject = $auth_user->runQuery("SELECT DISTINCT * FROM projects where title LIKE '%%' ORDER BY datecreated ASC;");

}


	$myproject->execute(array(":id"=>$id));	

	$myprojectRow=$myproject->fetchAll(PDO::FETCH_ASSOC);

foreach($myprojectRow as &$rowSQL){


echo "<div id='pid";
echo $rowSQL['id'];
echo "'>";
echo "<form method='post' action='stprojects.php#pid";
echo $rowSQL['id'];
echo "'><h1>";
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
echo "<input type='hidden' name='pid' value='";
echo $rowSQL['id'];
echo "'/>";
echo "<input type='hidden' name='uid' value='";
echo $user_id;
echo "'/>";
//echo $user_id;
if ($rowSQL['memberid'] > 0)
{
echo "<input type='button' class='btn btn-success' value='Projet pris en charge' disabled/>";
}
else
{
echo "<input type='submit' class='btn btn-warning' id='submit' name='submit' value='Prendre en charge le projet' />";
}
echo "<div><div class='more label'><a href='3Dproject.php?id=";
echo $rowSQL['googleid'];
echo "'>Voir le projet</a></div></div><div class='clear'></div></form></div><hr>";
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
