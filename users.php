<?php

include("head.php");


if($type < 2)
{
header('Location : index.php');
exit();
}




if(isset($_POST['setban']))
{
if (!isset($_POST['pid']))
{
//do nothing
}
else
{

try
{

$conn = null;
include('php_includes/db_con.php');
$sql = "UPDATE users SET activated = '2' WHERE id = '".$_POST['pid']."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenue! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }


//header('Location : users.php');
$conn = null;
}
}


if(isset($_POST['remban']))
{
if (!isset($_POST['pid']))
{
//do nothing
}
else
{

try
{

$conn = null;
include('php_includes/db_con.php');
$sql = "UPDATE users SET activated = '1' WHERE id = '".$_POST['pid']."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenue! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }


//header('Location : users.php');
$conn = null;
}
}




if(isset($_POST['setuser']))
{
if (!isset($_POST['pid']))
{
//do nothing
}
else
{

try
{

$conn = null;
include('php_includes/db_con.php');
$sql = "UPDATE users SET type = '0' WHERE id = '".$_POST['pid']."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenue! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }


//header('Location : users.php');
$conn = null;
}
}


if(isset($_POST['setmember']))
{
if (!isset($_POST['pid']))
{
//do nothing
}
else
{

try
{

$conn = null;
include('php_includes/db_con.php');
$sql = "UPDATE users SET type = '1' WHERE id = '".$_POST['pid']."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenue! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }


//header('Location : users.php');
$conn = null;
}
}

if(isset($_POST['setadmin']))
{
if (!isset($_POST['pid']))
{
//do nothing
}
else
{

try
{

$conn = null;
include('php_includes/db_con.php');
$sql = "UPDATE users SET type = '2' WHERE id = '".$_POST['pid']."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenue! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }


//header('Location : users.php');
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

          <div class="container">
    <div class="row">
        <div id="filter-panel" >
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" role="form" name="search" method="get" action="users.php">
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Chercher:</label>
                            <input type="text" name="text_search" class="form-control input-sm" id="pref-search" value="<?php echo $_GET['text_search'];?>">
                        </div><!-- form group [search] -->
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-orderby">&nbsp;Chercher par:</label>
                            <select id="pref-orderby" name="search_type" class="form-control" value="<?php echo $_GET['search_type'];?>">
                <option value="firstname">Nom</option>
                                <option value="email">Email</option>
                <option value="type">Statut</option>
                <option value="school">Ecolé</option>
                            </select>                                
                        </div> <!-- form group [order by] --> 
            <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-orderby">&nbsp;Ordonner par:</label>
                            <select id="pref-orderby" name="order_by" class="form-control" value="<?php echo $_GET['order_by']; ?>">
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
//echo $search_type;
//echo $text_search;
//echo $order_by;

if(isset($_GET['search']))
{
       $myproject = $auth_user->runQuery("SELECT DISTINCT * FROM users WHERE $search_type LIKE '%$text_search%' ORDER BY $search_type $order_by;");

}
else
{

	$myproject = $auth_user->runQuery("SELECT DISTINCT * FROM users;");

}


	$myproject->execute(array(":id"=>$id));	

	$myprojectRow=$myproject->fetchAll(PDO::FETCH_ASSOC);

foreach($myprojectRow as &$rowSQL){



echo "<form method='post' action='users.php'><h1>";
echo $rowSQL['firstname'];
echo " ";
echo $rowSQL['lastname'];
echo "</h1><p>";
echo $rowSQL['name'];
echo "</p><p>Email :  <a href='mailto:";
echo $rowSQL['email'];
echo "'>";
echo $rowSQL['email'];
echo "</a></p>";
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
echo "<input type='submit' class='btn btn-success' id='setuser' name='setuser' value='Utilisateur' disabled/>&nbsp;";
echo "<input type='submit' class='btn btn-warning' id='setmember' name='setmember' value='Donner le statut Membre' />&nbsp;";
echo "<input type='submit' class='btn btn-danger' id='setadmin' name='setadmin' value='Donner le statut Admin' />&nbsp;&nbsp;&nbsp;";
if($rowSQL['activated'] == 2)
{
echo "<input type='submit' class='btn btn-primary' id='remban' name='remban' value='Réintégrer'/>";
}
else
{
echo "<input type='submit' class='btn btn-primary' id='setban' name='setban' value='Bannir'/>";
}

}
else if ($rowSQL['type'] > 1)
{
echo "<input type='submit' class='btn btn-success' id='setuser' name='setuser' value='Donner le statut Utilisateur' />&nbsp;";
echo "<input type='submit' class='btn btn-warning' id='setmember' name='setmember' value='Donner le statut Membre' />&nbsp;";
echo "<input type='submit' class='btn btn-danger' id='setadmin' name='setadmin' value='Admin' disabled/>";

}
else
{
echo "<input type='submit' class='btn btn-success'  id='setuser' name='setuser' value='Donner le statut Utilisateur'/>&nbsp;";
echo "<input type='submit' class='btn btn-warning' id='setmember' name='setmember' value='Membre'  disabled/>&nbsp;";
echo "<input type='submit' class='btn btn-danger' id='setadmin' name='setadmin' value='Donner le statut Admin' />";

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
