<?php

try {
    $conn = new PDO('mysql:host=mysql.hostinger.fr;dbname=u492584299_fabla','u492584299_fabla','fablab17');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>