<?php

include('php_includes/randStrGen.php');


$randstr = randStrGen(5);
echo $randstr;
$tar = 'uploads/'.$randstr;
echo $tar;
//mkdir($tar, 0755);

unlink('uploads/ry81t');

?>