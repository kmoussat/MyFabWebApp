

<?php

function SendMail($firstname,$name,$email){
// Activation Email

date_default_timezone_set('Etc/UTC');
require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

// use
// $mail->Host = gethostbyname('smtp.gmail.com');

// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "devinci.fablab@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "fablab971";

//Set who the message is to be sent from
$mail->setFrom('no-reply.devinci.fablab@gmail.com','No reply - Devinci Fablab Projects');

//Set an alternative reply-to address
$mail->addReplyTo('no-reply.devinci.fablab@gmail.com', 'No reply - Devinci Fablab Projects');
//Set who the message is to be sent to

$mail->addAddress($email,$firstname);
//Set the subject line

$mail->Subject = 'Activation MyFab- DeVinci Fablab';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

$mail->IsHTML(true);

$mail->Body = '<!DOCTYPE html><html><head><meta charset="ISO 8859-15"><title>DeVinci Fablab MyFab</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://fablab-dvc.pe.hu/"><img src="http://fablab-dvc.pe.hu/img/logo1.png" width="50" height="50" alt="DeVinci Fablab Projects" style="border:none; float:left;"></a>&nbsp;&nbsp;DeVinci Fablab MyFab - Activation de votre compte</div><div style="padding:24px; font-size:17px;">Bonjour '.$firstname.' '.$name.',<br /><br />Veuillez cliquer sur lien ci-dessous afin d&#39;activer votre compte:<br /><br /><a href="http://fablab-dvc.pe.hu/confirmation.php?prenom='.$firstname.'&nom='.$name.'&email='.$email.'">Cliquer ici pour activer votre compte d&#232;s maintenant</a><br /><br />Apr&#232;s l&#39;activation r&#233;ussie, connectez vous avec votre E-mail:<br />* Adresse E-mail: <b>'.$email.'</b></div></body></html>';

//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';

//Attach an image file

//$mail->addAttachment('images/phpmailer_mini.png');


//send the message, check for errors
if (!$mail->send()) {
   // echo "Mailer Error: " . $mail->ErrorInfo;
} else {
   // echo "Message sent!";
}

}



include('php_includes/db_con.php');


require_once('php_includes/class.user.php');


$user = new USER();

if(isset($_POST['submit']))

{

$email = $_POST['email'];

		$stmt = $user->runQuery("SELECT * FROM users WHERE email=:email");

			$stmt->execute(array(':email'=>$email));

			$row=$stmt->fetch(PDO::FETCH_ASSOC);


if($row['email'] == $email)
{

$error[] = "Votre compte existe d&#233;j&#224; ! Avez-vous oubli&#233; votre mot de passe ?";
}
else if(strpos($email, '&#64;devinci.fr') !== false)
{
$error[] = "$email n&#145;est pas valide! Veuillez utiliser une adresse email &#64;devinci.fr";

} 
else if($_POST['mdp'] != $_POST['mdp-verif'])
{
$error[] = "Vos mots de passe ne sont pas les m&#234;mes! Veuillez r&#233;essayer!";
}
/*
else if(!preg_match('/[A-Z]+[a-z]+[0-9]+/', $_POST['mdp'] ))
{
$error[] = "Votre mot de passe doit contenir au minimum un chiffre et une lettre majuscule!";
}
*/

else 
{
//	if($row['email'] != $email)
//{


if (!isset($_POST['prenom']) || !isset($_POST['nom']) || !isset($_POST['email']) || !isset($_POST['mdp']))
{

header('Location: index.php'); 

}

else
{

$firstname = $_POST['prenom'];
$name = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['mdp'];
$num = $_POST['numero'];

//$password = password_hash($password, PASSWORD_DEFAULT);
$password = md5($password);


//ip address retrieval
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

// SQL Entry

try
{
    $sql = "INSERT INTO users (id, firstname, lastname, email, phone, year, pwd, type, nbpro, joining_date, ip, activated, lastlogin)
    VALUES ('', '".$firstname."', '".$name."', '".$email."', '".$num."', '', '".$password."', '0', '', now(), '".$ip."', '3', now())";
    // use exec() because no results are returned
    $conn->exec($sql);
    //echo "New record created successfully";
	
	
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

SendMail($firstname,$name,$email);


header('Location: http://fablab-dvc.pe.hu/activation.php?prenom='.$firstname.'&nom='.$name.'&email='.$email.'');
  exit();
}


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

<!-- jQuery js -->

		<script src="js/jquery.js"></script>

    <title>MyFab</title>



    <!-- Stylesheets -->

    <link href="css/bootstrap.css" rel="stylesheet">

	<link href="css/animation.css" rel="stylesheet">

	<!-- link href="css/checkbox/orange.css" rel="stylesheet" -->

	<link href="css/preview.css" rel="stylesheet">

	<link href="css/authenty.css" rel="stylesheet">

	<link href="css/checkbox.css" rel="stylesheet">

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

									  <h1>DeVinci Fablab  MyFab</h1>

									  <h5>Become A Maker!</h5>

								  </div>

									<div id="form_1" data-animation="bounceIn">

										<div class="form-header">

										  <i class="fa fa-user"></i>

									  </div>

									  <div class="form-main">

										  <div class="form-group">
											<form method="post" action="">

								  			<input type="text" name="prenom" id="un_1" class="form-control" placeholder="Pr&eacute;nom*" value="<?php echo $_POST['prenom']; ?>" " required="required">

											<input type="text" name="nom" id="un_1" class="form-control" placeholder="Nom*" value="<?php echo $_POST['nom']; ?>" required="required">

											<input type="text" name="email" id="email" class="form-control" placeholder="Email @devinci.fr*"  value="<?php echo $_POST['email']; ?>" required="required">
												<span id="email-result"></span>	

												<input type="text" name="numero" maxlength="10" id="phone" class="form-control" value="<?php echo $_POST['numero']; ?>" placeholder="Num&eacute;ro">	

												<input type="password" pattern=".{8,}" name="mdp" id="pw_1" class="form-control" placeholder="Mot de passe* (min 8 caract&#232;res)" required="required">

												<input type="password" pattern=".{8,}" name="mdp-verif" id="pw_2" class="form-control" placeholder="Confirmez le mot de passe*" required="required">
												

<span><div class="alert alert-info"><input type="checkbox" autocomplete="off" required>


               											         &nbsp; <a href ="" >* J&#146;accepte les conditions d&#146;utilisation.</a> </div>

           										          
												 </span>

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


											<input type="submit" name="submit" class="btn btn-block signin" value="S'inscrire"> 

											</form>
										  </div>


									    
										
										  <!-- /div -->
									


										<div class="form-footer">

											<div class="row">

												<div class="col-xs-7">

													<i class="fa fa-unlock-alt"></i>

													<a href="#password_recovery" id="forgot_from_1">Mot de passe oubli&eacute;?</a>

												</div>

												<div class="col-xs-5">

													<i class="fa fa-check"></i>

													<a href="index.php" id="signup_from_1">Se loguer</a>

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

		<!-- script src="js/jquery.icheck.min.js"></script -->

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

