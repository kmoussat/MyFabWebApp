<?php


session_start();



require_once("php_includes/class.user.php");

$login = new USER();



if($login->is_loggedin()!="")

{



//UPDATE  `u492584299_fabla`.`users` SET  `nb_login` =  '1' + '1' WHERE  `users`.`id` =16;
  $login->redirect('landing.php');

}


if(isset($_GET['fname']) && isset($_GET['n']) && isset($_GET['em']))
{
  include('php_includes/db_con.php');

require_once('php_includes/class.user.php');

$firstname = $_GET['fname'];
$name = $_GET['n'];
$email = $_GET['em'];


$user = new USER();



    $stmt = $user->runQuery("SELECT * FROM users WHERE email=:email");

      $stmt->execute(array(':email'=>$email));

      $row=$stmt->fetch(PDO::FETCH_ASSOC);

  if($row['activated'] == 1)
{

$error[] = "Bonjour $firstname! Votre est d&#233;j&#224; activ&#233;!  Vous pouvez vous connecter!";

}
  else if($row['activated'] == 2)
{

$error[] = "Bonjour $firstname! Votre compte a &#233;t&#233; suspendu par un administrateur! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";

}
  else if($row['activated'] == 3)
{

try
{
$sql = "UPDATE users SET activated = '1' WHERE users.email = '".$email."';";
    // use exec() because no results are returned
    $conn->exec($sql);
    $error[] = "Bravo $firstname! Votre compte est activ&#233;! Vous pouvez vous connecter!";
    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
$error[] = "Une erreur inattendue est survenue! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    }

$conn = null;

}
else

{

$error[] = "Votre compte n&#145;existe pas ou n&#145;a pas encore &#233;t&#233; cr&#233;&#233;! ";

}
}


if(isset($_POST['login']))
{
  $umail = strip_tags($_POST['emaillog']);

  $upass = strip_tags($_POST['password']);

        $stmt = $login->runQuery("SELECT * FROM users WHERE email=:umail");

      $stmt->execute(array(':umail'=>$umail));

      $row=$stmt->fetch(PDO::FETCH_ASSOC);

  if($row['activated'] == 1)
{

   if($login->doLogin($umail,$upass))

    {

        include('php_includes/db_con.php');
        try
          {
            $sql = "UPDATE users SET nb_login = '".$row['nb_login']."' + '1'  WHERE users.email = '".$umail."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    }
              catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
              $error[] = "Une erreur inattendue est survenue! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


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
          $error[] = "Une erreur inattendue est survenue! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


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
            $error[] = "Une erreur inattendue est survenue! Veuillez contacter le Fablab &#224; l&#145;adresse suivante : <a href='mailto:devinci.fablab&#64;gmail.com'>devinci.fablab&#64;gmail.com</a>";


    } 
                $conn = null;
               $login->redirect('landing.php');

     }else{
    $error[] = "Votre compte n&#145;existe pas ou n&#146;a pas encore &#233;t&#233; cr&#233;&#233;!";
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

$error[] = "Votre compte n&#145;existe pas ou n&#146;a pas encore &#233;t&#233; cr&#233;&#233;!";

} 
}








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

//$mail->addBCC("");

$mail->Subject = 'Activation MyFab- DeVinci Fablab';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

$mail->IsHTML(true);

$mail->Body = '<!DOCTYPE html><html><head><meta charset="ISO 8859-15"><title>DeVinci Fablab MyFab</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://myfab.pe.hu/"><img src="http://myfab.pe.hu/img/logo1.png" width="50" height="50" alt="DeVinci Fablab Projects" style="border:none; float:left;"></a>&nbsp;&nbsp;DeVinci Fablab MyFab - Activation de votre compte</div><div style="padding:24px; font-size:17px;">Bonjour '.$firstname.' '.$name.',<br /><br />Veuillez cliquer sur lien ci-dessous afin d&#39;activer votre compte:<br /><br /><a href="http://myfab.pe.hu/index.php?fname='.$firstname.'&n='.$name.'&em='.$email.'">Cliquer ici pour activer votre compte d&#232;s maintenant</a><br /><br />Apr&#232;s l&#39;activation r&#233;ussie, connectez vous avec votre E-mail:<br />* Adresse E-mail: <b>'.$email.'</b></div></body></html>';

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

if(isset($_POST['signup']))
{

  require_once('php_includes/class.user.php');

 

  $user = new USER();

 $email = $_POST['email'];

    $stmt = $user->runQuery("SELECT * FROM users WHERE email=:email");

      $stmt->execute(array(':email'=>$email));

      $row=$stmt->fetch(PDO::FETCH_ASSOC);


if($row['email'] == $email)
{

$error[] = "Votre compte existe d&#233;j&#224; ! Avez-vous oubli&#233; votre mot de passe ?";
}
else if(strpos($email, 'devinci.fr') === false)
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
//  if($row['email'] != $email)
//{


if (!isset($_POST['prenom']) || !isset($_POST['nom']) || !isset($_POST['badge']) || !isset($_POST['email']) || !isset($_POST['mdp']))
{

header('Location: index.php'); 

}

else
{

$firstname = $_POST['prenom'];
$name = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['mdp'];
$badge = $_POST['badge'];

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
    $sql = "INSERT INTO users (id, firstname, lastname, email, phone, year, pwd, type, nbpro, joining_date, ip, activated, lastlogin, badge)
    VALUES ('', '".$firstname."', '".$name."', '".$email."', '', '', '".$password."', '0', '', now(), '".$ip."', '3', now(), '".$badge."')";
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

$error[] = "Merci pour votre inscription! Un mail vous a &#233;t&#233; envoy&#233; pour l'activation de votre compte."; 
//$error[] = "Un mail vous a été envoyé ";
//header('Location: http://myfab.pe.hu/newindex.php?prenom='.$firstname.'&nom='.$name.'&email='.$email.'');
// header('Location: http://myfab.pe.hu/newindex.php');
//exit();
}


}
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyFab</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/newstyle.css">
  <link rel="icon" type="image/png" href="img/logo1.png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
         <font color="white">Connexion</font>                    
      </button>
     


  
      <a class="navbar-brand" href="#"><font face="verdana" size="4px">DeVinci Fablab - MyFab</font></a>
    
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right">
    
    
      
     
      <form method="POST" class="navbar-form navbar-right" role="form">
   
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="email" type="email" class="form-control" name="emaillog" value="" placeholder="Email">                                        
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" value="" placeholder="Mot de passe">   
                  </div>

                        <button type="submit" name="login" class="btn btn-primary">Connexion</button>
                   </form>

      </ul>
    </div>
  </div>
</nav>



  

<div class="container" >
    <div class="col-md-12" >
        <div id="logbox"  >
            <form id="signup" method="POST" action="" >
                <h1><img src="img/logo1.png" widht="50px" height="50px" />&nbsp;Rejoindre MyFab</h1>
                <input name="prenom" type="text" placeholder="Prénom" class="input pass"/>
                <input name="nom" type="text" placeholder="Nom" class="input pass"/>
                <input name="badge" type="number" placeholder="Badge Etudiant" class="input pass"/>
                <input name="email" type="email" placeholder="Adresse Email Devinci" class="input pass"/>
                <input name="mdp" type="password" placeholder="Choisir un mot de passe" required="required" class="input pass"/>
                <input name="mdp-verif" type="password" placeholder="Confirmer le mot de passe" required="required" class="input pass"/>
                <input type="submit" name="signup" value="Se créer un compte" class="inputButton"/>
             
      
<?php
    
        if(isset($error))

                          {

                          foreach($error as $error)

                            {
                              echo "   <div class='alert alert-info'><p style='font-size:10px'> <i class='glyphicon glyphicon-exclamation-sign'></i>&nbsp;";               
                               echo $error;
                               echo "</p></div>";
                              
                              }
                              } ?>
            </form>
        </div>
    </div>
    <!--col-md-6-->

    


</div>
</div>

</body>
</html>