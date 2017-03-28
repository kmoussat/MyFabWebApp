<?php



	require_once("session.php");

	

	require_once("php_includes/class.user.php");

	$auth_user = new USER();

	

	

	$user_id = $_SESSION['user_session'];

	
//user info
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");

	$stmt->execute(array(":user_id"=>$user_id));

	

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

//text info 1

	$id = 1;

        $stmt2 = $auth_user->runQuery("SELECT * FROM texts WHERE id=1");

	$stmt2->execute(array(":id"=>$id));

	

	$textRow=$stmt2->fetch(PDO::FETCH_ASSOC);

//text info 2

	$iid = 2;

        $stmt3 = $auth_user->runQuery("SELECT * FROM texts WHERE id=2");

	$stmt3->execute(array(":iid"=>$iid));

	

	$textRow2=$stmt3->fetch(PDO::FETCH_ASSOC);






$id = $userRow['id'];

//$ip = $userRow['ip'];

$firstname = $userRow['firstname'];

$name = $userRow['lastname'];
	
$email = $userRow['email'];

$phone = $userRow['phone'];

$year = $userRow['year'];

$type = $userRow['type'];

$nbpro = $userRow['nbpro'];

$nb_new_msg = $userRow['nb_new_msg'];

$joining_date = $userRow['joining_date'];

$lastlogin = $userRow['lastlogin'];

$nb_login = $userRow['nb_login'];

$menu_member = $textRow['menu_admin'];

$menu_admin = $textRow2['menu_admin'];

//ip address retrieval
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}



?>


<!DOCTYPE html>

<html lang="fr">



<head>


    <meta charset="ISO 8859-15">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="Ken Moussat">



    <title>MyFab - <?php echo $firstname; echo " "; echo $name; ?></title>

     

    <!-- Bootstrap Core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom CSS -->

    <link href="css/sb-admin.css" rel="stylesheet">

    <link href="css/rotation.css" rel="stylesheet">

    <!-- Morris Charts CSS -->

    <link href="css/plugins/morris.css" rel="stylesheet">

<link rel="icon" type="image/png" href="img/logo1.png" />


    <!-- Custom Fonts -->

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/Chart.min.js"></script>

</head>



<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <div id="wrapper">



        <!-- Navigation -->

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="landing.php">DeVinci Fablab - MyFab <small> | <?php echo $ip;?></small></a>

            </div>

            <!-- Top Menu Items -->

            <ul class="nav navbar-right top-nav">

               <!-- <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>

                    <ul class="dropdown-menu message-dropdown">

                        <li class="message-preview">

                            <a href="#">

                                <div class="media">

                                    <span class="pull-left">

                                        <img class="media-object" src="http://placehold.it/50x50" alt="">

                                    </span>

                                    <div class="media-body">

                                        <h5 class="media-heading"><strong>John Smith</strong>

                                        </h5>

                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>

                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="message-preview">

                            <a href="#">

                                <div class="media">

                                    <span class="pull-left">

                                        <img class="media-object" src="http://placehold.it/50x50" alt="">

                                    </span>

                                    <div class="media-body">

                                        <h5 class="media-heading"><strong>John Smith</strong>

                                        </h5>

                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>

                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="message-preview">

                            <a href="#">

                                <div class="media">

                                    <span class="pull-left">

                                        <img class="media-object" src="http://placehold.it/50x50" alt="">

                                    </span>

                                    <div class="media-body">

                                        <h5 class="media-heading"><strong>John Smith</strong>

                                        </h5>

                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>

                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="message-footer">

                            <a href="#">Read All New Messages</a>

                        </li>

                    </ul>

                </li>

                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>

                    <ul class="dropdown-menu alert-dropdown">

                        <li>

                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>

                        </li>

                        <li>

                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>

                        </li>

                        <li>

                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>

                        </li>

                        <li>

                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>

                        </li>

                        <li>

                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>

                        </li>

                        <li>

                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>

                        </li>

                        <li class="divider"></li>

                        <li>

                            <a href="#">View All</a>

                        </li>

                    </ul>

                </li> -->

                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $firstname; echo " "; echo $name; ?> <b class="caret"></b></a>

                    <ul class="dropdown-menu">

                        <li>

                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profil</a>

                        </li>

                        <li>

                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Messages</a>

                        </li>

                        <li>

                            <a href="parameters.php"><i class="fa fa-fw fa-gear"></i> Param&#232;tres</a>

                        </li>

                        <li class="divider"></li>

                        <li>

                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i>D&#233;connexion</a>

                        </li>

                    </ul>

                </li>

            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-nav side-nav">

                    <li class="active">

                        <a href="landing.php"><i class="fa fa-fw fa-dashboard"></i> MyFab</a>

                    </li>

					  <li>

                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-wrench"></i> Projets <i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="demo" class="collapse">

                            <li>

                                <a href="myprojects.php">Mes projets</a>

                            </li>

                            <li>

                                <a href="submission.php">Nouveau projet 3D</a>

                            </li>

                        </ul>

                    </li>

  <li>

                        <a href="javascript:;" data-toggle="collapse" data-target="#tools"><i class="fa fa-fw fa-compass"></i> Outils <i class="fa fa-fw fa-caret-down"></i></a>

                        <ul id="tools" class="collapse">

                            <li>

                                <a href="stlviewer.php">STL Viewer</a>

                            </li>

                            <li>

                                <a href="">New</a>

                            </li>

                        </ul>

                    </li>


		    <?php 

switch ($type) {
    case 0:
        
        break;
    case 1:
        echo $menu_member;
        break;
    case 2:
        echo $menu_member;
	echo $menu_admin;
        break;
}
?>

                    <li>
                        <!-- paul - remplacer "template.php" par "stats.php" pour faire débogguage -->
                        <a href="stats.php"><i class="fa fa-fw fa-bar-chart-o"></i> Stats</a>

                    </li>

                    <li>

                        <a href="calendar.php"><i class="fa fa-fw fa-table"></i> Calendrier</a>

                    </li>

       

                </ul>

            </div>

            <!-- /.navbar-collapse -->

        </nav>