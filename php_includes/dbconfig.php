<?php

class Database

{   

    private $host = "mysql.hostinger.fr";

    private $db_name = "u492584299_fabla";

    private $username = "u492584299_fabla";

    private $password = "fablab17";

    public $conn;

     

    public function dbConnection()

	{

     

	    $this->conn = null;    

        try

		{

            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

        }

		catch(PDOException $exception)

		{

            echo "Connection error: " . $exception->getMessage();

        }

         

        return $this->conn;

    }

}

?>