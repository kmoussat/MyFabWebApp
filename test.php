<?php

if(isset($_POST['submit']))
{
$email = $_POST['email'];


if(strpos($email, 'devinci.fr') === false)
{
echo $email;
echo " Ne contient pas devinci.fr";

}
else
 	{
 		echo $email;
 		echo " Contient devinci.fr";
 } 
}
?>

<html>
<form action="" method="post">
<input type="text" name="email">
<input type="submit" name="submit">


</form>
</html>