<?php

$firstname = $_GET['prenom'];
$name = $_GET['nom'];
$email = $_GET['email'];

?>



<!DOCTYPE html>

<html lang="fr">

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Login, registration forms">

    <meta name="author" content="">

<meta http-equiv="refresh" content="5;url=index.php" />



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

									  <h1>MyFab</h1>
<div class="alert alert-info">

                        <i class="glyphicon glyphicon-log-in"></i> &nbsp; <p><h5>Merci pour votre inscription <?php echo $firstname; ?>! Un mail vous a &#233;t&#233; envoy&#233; &#224; votre adresse  </h5></p>
									  <p><h5><ul><li><bold><?php echo $email; ?></bold></li></ul></h5></p>

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
