<?php



	require_once("session.php");

	

	require_once("php_includes/class.user.php");

	$auth_user = new USER();

	

	

	$user_id = $_SESSION['user_session'];

	

	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");

	$stmt->execute(array(":user_id"=>$user_id));

	

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	
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

                <div class="col-xs-12 well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Profil</a></li>
      <li><a href="#profile" data-toggle="tab">Mot de passe</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        
       <form id="tab" role="form" class="col-xs-3">
<br>
<fieldset disabled>
<label>Pr&#233;nom</label><br>
<input id="disabledTextInput" name="firstname" type="text" value="<?php echo $firstname;?>" class="form-control" >
</fieldset> 

<br>
<fieldset disabled>
<label>Nom</label><br>
<input id="disabledTextInput" name="name" type="text" value="<?php echo $name;?>" class="form-control" >
</fieldset>  

<br>
<fieldset disabled>
<label>Email</label><br>
<input id="disabledTextInput" name="email" type="text" value="<?php echo $email;?>" class="form-control" >
</fieldset>  

<br>
<fieldset>
<label>Sexe</label><br>
            <label class="radio-inline"><input type="radio" name="sex" value="Homme" checked>Homme</label>
	    <label class="radio-inline"><input type="radio" name="sex" value="Femme" >Femme</label><br>
</fieldset>  

<br>
<fieldset>
<label>T&#233;l&#233;phone</label><br>
<input id="disabledTextInput" name="phone" type="text" value="<?php echo $phone;?>" class="form-control" >
</fieldset> 

<br>
<fieldset>
<label>Ecole</label><br>
            <label class="radio-inline"><input type="radio" name="school" value="ESILV" checked>ESILV</label>
	    <label class="radio-inline"><input type="radio" name="school" value="IIM" >IIM</label>
	    <label class="radio-inline"><input type="radio" name="school" value="EMLV">EMLV</label>
	    <label class="radio-inline"><input type="radio" name="school" value="DevSchool">DevSchool</label>
            <label class="radio-inline"><input type="radio" name="school" value="Autre">Autre</label>	
</fieldset>  

<br>
<fieldset>
<label>Ann&#233;e</label><br>
            <label class="radio-inline"><input type="radio" name="year" value="1" checked>Ann&#233;e 1</label>
	    <label class="radio-inline"><input type="radio" name="year" value="2" >Ann&#233;e 2</label>
	    <label class="radio-inline"><input type="radio" name="year" value="3">Ann&#233;e 3</label>
	    <label class="radio-inline"><input type="radio" name="year" value="4">Ann&#233;e 4</label>
	    <label class="radio-inline"><input type="radio" name="year" value="5">Ann&#233;e 5</label><br>	
</fieldset>     
          	<div><br>
        	    <button class="btn btn-primary">Mettre à jour</button>
        	</div>
       </form>

      </div>

      <div class="tab-pane fade" id="profile">
    	

      <form id="tab2">
<br>
<fieldset>
<label>Nouveau mot de passe</label><br>
<input  name="pass1" type="password" placeholder="Mot de passe"  class="form-control" >
</fieldset>  

<br>
<fieldset>
<label>Confirmer le mot de passe</label><br>
<input  name="pass2" type="password" placeholder="Mot de passe"  class="form-control" >
</fieldset> <br> 
        	<div>
        	    <button class="btn btn-primary">Mettre à jour</button>
        	</div>
      </form>
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
