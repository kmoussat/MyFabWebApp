<?php

	
/*
	require_once("session.php");

	

	require_once("php_includes/class.user.php");

	$auth_user = new USER();

	

	

	$user_id = $_SESSION['user_session'];

	

	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");

	$stmt->execute(array(":user_id"=>$user_id));

	

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	
//print($userRow['email']);




$id = $userRow['id'];

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




if(isset($_POST['submit']))

{

// Check file size
if ($_FILES["fileToUpload"]["size"] > 8388608) {
    $error[] = "Désolé, votre fichier est trop lourd. Veuillez nous envoyer un mail à <a href='mailto:devinci.fablab@gmail.com'>devinci.fablab@gmail.com</a>.";
    $uploadOk = 0;
}


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  
        $uploadOk = 1;
   
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error[] = "Désolé, votre fichier n'a pas été téléchargé. Veuillez nous envoyer un mail à <a href='mailto:devinci.fablab@gmail.com'>devinci.fablab@gmail.com</a>.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
       $error[] = "Désolé, votre fichier n'a pas pu être téléchargé. Veuillez nous envoyer un mail à <a href='mailto:devinci.fablab@gmail.com'>devinci.fablab@gmail.com</a>.";

    }
}



// Google Drive Upload

require_once "google/google-api-php-client/src/Google_Client.php";

require_once "google/google-api-php-client/src/contrib/Google_DriveService.php";

require_once "google/google-api-php-client/src/contrib/Google_Oauth2Service.php";
 
require_once "google/vendor/autoload.php";

$DRIVE_SCOPE = 'https://www.googleapis.com/auth/drive';
$SERVICE_ACCOUNT_EMAIL = 'myfab-725@myfab-158803.iam.gserviceaccount.com';
$SERVICE_ACCOUNT_PKCS12_FILE_PATH = 'MyFab-621272c02a49.p12';

function buildService() {//function for first build up service
global $DRIVE_SCOPE, $SERVICE_ACCOUNT_EMAIL, $SERVICE_ACCOUNT_PKCS12_FILE_PATH;

  $key = file_get_contents($SERVICE_ACCOUNT_PKCS12_FILE_PATH);
  $auth = new Google_AssertionCredentials(
      $SERVICE_ACCOUNT_EMAIL,
      array($DRIVE_SCOPE),
      $key);
  $client = new Google_Client();
  $client->setUseObjects(true);
  $client->setAssertionCredentials($auth);
  return new Google_DriveService($client);
}

function createPublicFolder($service, $folderName,$parentId) {//function for create a publlic folder

  $file = new Google_DriveFile();
  $file->setTitle($folderName);
  $file->setMimeType('application/vnd.google-apps.folder');
    $parent = new Google_ParentReference();
    $parent->setId($parentId);
    $file->setParents(array($parent));
  $createdFile = $service->files->insert($file, array(
      'mimeType' => 'application/vnd.google-apps.folder',
  ));
  //assign the file with MIME 
  $permission = new Google_Permission();
  $permission->setValue('me');
  $permission->setType('anyone');
  $permission->setRole('writer');
  //assign the permission

 $service->permissions->insert(
      $createdFile->getId(), $permission);

  return $createdFile;
}

function insertFile($service, $title, $description, $parentId, $mimeType, $filename) {//function for insert a file
 
  $file = new Google_DriveFile();
  $file->setTitle($title);
  $file->setDescription($description);
  $file->setMimeType($mimeType);

  // Set the parent folder.
  if ($parentId != null) {
    $parent = new Google_ParentReference();
    $parent->setId($parentId);
    $file->setParents(array($parent));
  }

  try {
    $data = file_get_contents($filename);
    //$data = $filename;	

    $createdFile = $service->files->insert($file, array(
      'data' => $data,
      'mimeType' => $mimeType,
    ));


//set the file with MIME
$permission = new Google_Permission();
$permission->setRole( 'writer' );
$permission->setType( 'anyone' );
$permission->setValue( 'me' );
$service->permissions->insert( $createdFile->getId(), $permission );

//insert permission for the file


    
    return $createdFile;
  } catch (Exception $e) {
print "An error occurred1: " . $e->getMessage();
  }
}


try {


$root_id='0B20cPsqZXZ0jXzFTUVM5Q1F5cnM';

$service=buildService();

$limit=1;
for($i=1;$i<=$limit;$i++){
  $folderName='Project_'.$_POST['title'];
  $parent=createPublicFolder($service, $folderName,$root_id);
  $root_id=$parent->getId();
  $googleid=$root_id;
}

$title=basename($_FILES["fileToUpload"]["name"]);
$description='';
$parentId=$googleid;
$file=$target_file;
$mimeType="application/zip";//For Excel File
$filename=$file;
$parentId=insertFile($service, $title, $description, $parentId, $mimeType, $filename);




  } catch (Exception $e) {
  print "An error occurred1: " . $e->getMessage();
  }


unlink($target_file);


// SQL Entry

include('php_includes/db_con.php');


$title = htmlentities(htmlspecialchars($_POST['title']));
$scope = htmlentities(htmlspecialchars($_POST['scope']));
//$title = str_replace(' ','&nbsp;',$_POST['title']);
//$scope = str_replace(' ','&nbsp;',$_POST['scope']);
$title = str_replace(' ','&nbsp;',$title);
$scope = str_replace(' ','&nbsp;',$scope);

try
{
    $sql = "INSERT INTO projects (id,userid,title,scope,type,conf,datecreated,datedebut,datefinish,status,googleid)
    VALUES ('','".$_POST['uid']."','".$title."','".$scope."','".$_POST['type']."','".$_POST['conf']."', now(),'".$_POST['datedebut']."','".$_POST['datefinish']."','25','".$googleid."')";
    // use exec() because no results are returned
    $conn->exec($sql);
    //echo "New record created successfully";
	
	
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }


$umail = $_POST['umail'];

try
{
$sql = "UPDATE users SET nbpro = '".$row['nbpro']."' + '1'  WHERE users.email = '".$umail."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenure! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }

$conn = null;

sleep(4);

header('Location: 3Dproject.php?id='.$googleid.'&state=1');
  

}



 

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
                            &nbsp;MyFab <small>Votre espace Maker <?php //echo $googleid; ?></small>
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
        <form method="POST" action="" enctype="multipart/form-data">
	    <h3>Soumettez votre projet d'impression 3D</h3>	
            <fieldset class="form-group">
            <label for="title">*Titre du projet</label>
            <textarea class="form-control" id="title" name="title" rows="1" maxlength="30" value="<?php echo $_POST['title']; ?>" required></textarea>
            <small class="text-muted">Donnez nous un titre &#224; votre projet. (30 caract&#232;res max)</small> 
            </fieldset>        
            <fieldset class="form-group">
            <label for="scope">*Description du projet</label>
            <textarea class="form-control" id="scope" name="scope" rows="3" value="<?php echo $_POST['scope']; ?>" required></textarea>
            <small class="text-muted">R&#233;digez une description de votre projet.</small> 
            </fieldset>
            <fieldset class="form-group">
            <label for="type">*Type de projet</label><br>
            <label class="radio-inline"><input type="radio" name="type" value="Projet&nbsp;Fun" checked>Projet Fun</label>
	    <label class="radio-inline"><input type="radio" name="type" value="Projet&nbsp;de&nbsp;cours" >Projet de cours</label>
	    <label class="radio-inline"><input type="radio" name="type" value="Projet&nbsp;d&#145;ann&#233;e">Projet d'ann&#233;e (PIX/PING/PI2)</label>
	    <label class="radio-inline"><input type="radio" name="type" value="Projet&nbsp;d&#145;association">Projet d'association</label><br>	
            <small class="text-muted">S&#233;lectionnez le type de projet correspondant &#224; votre demande.</small>             
            </fieldset>
	    <fieldset class="form-group">
            <label for="conf">*Etendu du projet</label><br>
            <label class="radio-inline"><input type="radio" name="conf" value="Pi&#232;ce&nbsp;Unique" checked>Pi&#232;ce Unique</label>
	    <label class="radio-inline"><input type="radio" name="conf" value="Assemblage">Assemblage</label><br>	
            <small class="text-muted">S&#233;lectionnez <i>Assemblage</i> si votre projet comprend plusieurs pi&#232;ces &#224; imprimer et <i>Pi&#232;ce unique</i> si vous n'en avez qu'une seule.</small>             
            </fieldset>
	    <fieldset class="form-group">
	    <label for="datedown">*Date de d&#233;but de r&#233;alisation souhait&#233;e</label><br>
	    <input type="date" name="datedebut" value="<?php echo date('Y-m-d'); ?>"> 
	    </fieldset>	
	    <fieldset class="form-group">
	    <label for="dateup">*Date de fin de r&#233;alisation du projet souhait&#233;e</label><br>
	    <input type="date" name="datefinish" value="<?php echo date('Y-m-d'); ?>"> 
	    </fieldset>	
            <small class="text-muted">Attention : il faut parfois compter plusieurs jours avant le traitement de la demande et avant sa r&#233;alisation.<p>En fonction du projet, cela peut prendre plus ou moins de temps </p></small>  <br>           
            <fieldset class="form-group">
            <label for="comments">Commentaires suppl&#233;mentaires</label>
            <textarea class="form-control" name="comments" id="comments" rows="2" maxlength="200" value="<?php echo $_POST['comments']; ?>" ></textarea>
            </fieldset>
	    <input type="hidden" name="uid" value="<?php echo $id; ?>"> 
             <input type="hidden" name="umail" value="<?php echo $email; ?>"> 
            <!-- input type="hidden" name="test" value="<?php // echo $firstname; ?>" --> 

<script>
document.forms[0].addEventListener('submit', function( evt ) {
    var file = document.getElementById('fileToUpload').files[0];

    if(file && file.size > 8388608) { // 8 MB (this size is in bytes)
        //Prevent default and display error
        evt.preventDefault();
document.getElementById("message").innerHTML = "<div class='alert alert-warning'><i class='glyphicon glyphicon-warning-sign'></i> &nbsp;Votre fichier est trop lourd. Veuillez nous envoyer un mail &#224; <a href='mailto:devinci.fablab@gmail.com'>devinci.fablab@gmail.com</a>. </div>";

    }

}, false);
</script>

<script type="text/javascript">
            function alertFilename()
            {
                var thefile = document.getElementById('fileToUpload').files[0].name;
                //alert(thefile.value);
document.getElementById("fname").innerHTML = "<br><div class='alert alert-info'><i class='glyphicon glyphicon-info-sign'></i> &nbsp; " + thefile +"</div>";


            }


        </script>


           
            <fieldset class="form-group">
            <label class="btn btn-info">
                <input id="fileToUpload" name="fileToUpload" type="file" style="display:none;" onchange="alertFilename()" required>
                T&#233;l&#233;charger le(s) fichier(s) 
            </label>      
            <small class="text-muted">T&#233;l&#233;charger le(s) fichier(s) de votre projet au format .zip, .rar ou stl. <bold><u> 8 MB Max</u></bold></small>
	    <br>
	    <p id="fname"></p>	
            <p id="message"></p>	
            </fieldset>          
            <button type="submit" class="btn btn-primary" name="submit" value="submit" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Soumission du projet">Soumettre ce projet</button>
            <!-- button type="submit" class="btn btn-info" name="save-new-recipe-button" value="save-new-recipe-button">Sauvegarder ce projet</button>
            <button type="submit" class="btn btn-danger"  name="delete-recipe-button" value="delete-recipe-button">Annuler ce projet</button --> 



        </form>

<script type="text/javascript">

$("#load").click(function () 
{
     $(this).button('loading');
     // Long waiting operation here
     $(this).button('reset');
}
);
</script>


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

    <!-- /div -->    
	</div>
</div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php

include("tail.php");

?> 
