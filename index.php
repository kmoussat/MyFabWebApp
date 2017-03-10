<?php

session_start();

include('php_includes/db_con.php');

require_once("php_includes/class.user.php");

$login = new USER();



if($login->is_loggedin()!="")

{



//UPDATE  `u492584299_fabla`.`users` SET  `nb_login` =  '1' + '1' WHERE  `users`.`id` =16;
	$login->redirect('landing.php');

}



if(isset($_POST['submit']))

{

	//$uname = strip_tags($_POST['txt_uname_email']);

	$umail = strip_tags($_POST['email']);

	$upass = strip_tags($_POST['password']);

        $stmt = $login->runQuery("SELECT * FROM users WHERE email=:umail");

			$stmt->execute(array(':umail'=>$umail));

			$row=$stmt->fetch(PDO::FETCH_ASSOC);

	if($row['activated'] == 1)
{

	if($login->doLogin($umail,$upass))

	{

try
{
$sql = "UPDATE users SET nb_login = '".$row['nb_login']."' + '1'  WHERE users.email = '".$umail."';";
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
$sql = "UPDATE users SET lastlogin = now()  WHERE users.email = '".$umail."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenure! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }

//ip address retrieval
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

try
{
$sql = "UPDATE users SET ip = '".$ip."'  WHERE users.email = '".$umail."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenure! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }

		$login->redirect('landing.php');

	}

	else

	{

		$error[] = "Votre compte n&#145;existe pas ou n&#146;a pas encore &#233;t&#233; cr&#233;&#233;! Vous pouvez en cr&#233;er un <a href='signup.php'>ici!</a>";

}
	
}
	else if($row['activated'] == 2)
{

$error[] = "Bonjour! Votre compte a &#233;t&#233; suspendu par un administrateur! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";

}
	else if($row['activated'] == 3)
{

$error[] = "Bonjour! Votre compte n&#145;est pas activ&#233;! Veuillez regarder vos emails pour lancer l&#145;activation.</a>";



}
else

{

$error[] = "Votre compte n&#145;existe pas ou n&#146;a pas encore &#233;t&#233; cr&#233;&#233;! Vous pouvez en cr&#233;er un <a href='signup.php'>ici!</a>";

}	

	

}

?>

<!DOCTYPE html>

<html lang="fr">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Login, registration forms">

    <meta name="author" content="">



    <title>MyFab</title>



    <!-- Stylesheets -->

    <link href="css/bootstrap.css" rel="stylesheet">

	<link href="css/animation.css" rel="stylesheet">

	<link href="css/checkbox/orange.css" rel="stylesheet">

	<link href="css/preview.css" rel="stylesheet">

	<link href="css/authenty.css" rel="stylesheet">

	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/themes/smoothness/jquery-ui.css">



	<!-- Font Awesome CDN -->

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	

	<!-- Google Fonts -->

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


<link rel="icon" type="image/png" href="img/logo1.png" />

    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    <![endif]-->

  </head>

  <body>

	

		

		<section id="authenty_preview">

			<section id="signin_main" class="authenty signin-main">

				<div class="section-content">

				  <div class="wrap">

					  <div class="container">	  

							<div class="form-wrap">

								<div class="row">

								  <div class="title" data-animation="fadeInDown" data-animation-delay=".8s">

									  <h1>DeVinci Fablab   MyFab</h1>

									  <h5>Become A Maker!</h5>

								  </div>

									<div id="form_1" data-animation="bounceIn">

										<div class="form-header">

										  <i class="fa fa-user"></i>

									  </div>

									  <div class="form-main">

										  <div class="form-group">
											<form action="" method="post" id="login-form">
								  			<input type="text" id="un_1" name="email" class="form-control" placeholder="Email" required="required">

												<input type="password" id="pw_1" name="password" class="form-control" placeholder="Mot de passe" required="required">
												<span>
												 <?php if(isset($error))

													{

			 										foreach($error as $error)

													 	{

												 ?>

              											       <div class="alert alert-warning">

               											         <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>

           										          </div>

												<?php
														}

													}

			
												?>

      												  </div>


												</span>
										  </div>

									    <input type="submit" name="submit" class="btn btn-block signin" value="Se loguer">
										</form>
									  </div>

										<div class="form-footer">

											<div class="row">

												<div class="col-xs-7">

													<i class="fa fa-unlock-alt"></i>

													<a href="#password_recovery" id="forgot_from_1">Mot de passe oubli&eacute;?</a>

												</div>

												<div class="col-xs-5">

													<i class="fa fa-check"></i>

													<a href="signup.php" id="signup_from_1">S'inscrire</a>

												</div>

											</div>

										</div>		

								  </div>

								</div>

							</div>

					  </div>

				  </div>

				</div>

			</section>

		

		

			

		

	  

    <!-- js library -->

    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>

    	<script src="js/bootstrap.min.js"></script>

		<script src="js/jquery.icheck.min.js"></script>

		<script src="js/waypoints.min.js"></script>

		

		<!-- authenty js -->

		<script src="js/authenty.js"></script>

		

		<!-- preview scripts -->

		<script src="js/preview/jquery.malihu.PageScroll2id.js"></script>

		<script src="js/preview/jquery.address-1.6.min.js"></script>

		<script src="js/preview/scrollTo.min.js"></script>

		<script src="js/preview/init.js"></script>

		

		

		<!-- preview scripts -->

		<script>

			(function($) {

				

				// get full window size

				$(window).on('load resize', function(){

				    var w = $(window).width();

				    var h = $(window).height();



				    $('section').height(h);

				});		



				// scrollTo plugin

				$('#signup_from_1').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });

				$('#forgot_from_1').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });

				$('#signup_from_2').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });

				$('#forgot_from_2').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });

				$('#forgot_from_3').scrollTo({ easing: 'easeInOutQuint', speed: 1500 });

				

				

				// set focus on input

				var firstInput = $('section').find('input[type=text], input[type=email]').filter(':visible:first');

        

				if (firstInput != null) {

            firstInput.focus();

        }

				

				$('section').waypoint(function (direction) {

					var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');

					target.focus();

				}, {

	          offset: 300

	      }).waypoint(function (direction) {

					var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');

			  	target.focus();

	      }, {

	          offset: -400

	      });

				

				

				// animation handler

				$('[data-animation-delay]').each(function () {

	          var animationDelay = $(this).data("animation-delay");

	          $(this).css({

	              "-webkit-animation-delay": animationDelay,

	              "-moz-animation-delay": animationDelay,

	              "-o-animation-delay": animationDelay,

	              "-ms-animation-delay": animationDelay,

	              "animation-delay": animationDelay

	          });

	      });

				

	      $('[data-animation]').waypoint(function (direction) {

	          if (direction == "down") {

	              $(this).addClass("animated " + $(this).data("animation"));

	          }

	      }, {

	          offset: '90%'

	      }).waypoint(function (direction) {

	          if (direction == "up") {

	              $(this).removeClass("animated " + $(this).data("animation"));

	          }

	      }, {

	          offset: '100%'

	      });

			

			})(jQuery);

		</script>

  </body>

</html>

