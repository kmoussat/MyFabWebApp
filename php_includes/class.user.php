<?php



require_once('dbconfig.php');



class USER

{	



	private $conn;

	

	public function __construct()

	{

		$database = new Database();

		$db = $database->dbConnection();

		$this->conn = $db;

    }

	

	public function runQuery($sql)

	{

		$stmt = $this->conn->prepare($sql);

		return $stmt;

	}

	

	public function register($umail,$upass)

	{

		try

		{

			//$new_password = password_hash($upass, PASSWORD_DEFAULT);
			$new_password = md5($upass);
			

			$stmt = $this->conn->prepare("INSERT INTO users(email,pwd) 

		                                               VALUES(:umail, :upass)");

												  

			//$stmt->bindparam(":uname", $uname);

			$stmt->bindparam(":umail", $umail);

			$stmt->bindparam(":upass", $new_password);										  

				

			$stmt->execute();	

			

			return $stmt;	

		}

		catch(PDOException $e)

		{

			echo $e->getMessage();

		}				

	}

	

	

	public function doLogin($umail,$upass)

	{

		try

		{

			$stmt = $this->conn->prepare("SELECT id, email, pwd FROM users WHERE email=:umail ");

			$stmt->execute(array(':umail'=>$umail));

			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() == 1)

			{

				//if(password_verify($upass, $userRow['pwd']))
				if(md5($upass) == $userRow['pwd'])
				{

					$_SESSION['user_session'] = $userRow['id'];

					return true;

				}

				else

				{

					return false;

				}

			}

		}

		catch(PDOException $e)

		{

			echo $e->getMessage();

		}

	}

	

	public function is_loggedin()

	{

		if(isset($_SESSION['user_session']))

		{

			return true;

		}

	}

	

	public function redirect($url)

	{

		header("Location: $url");

	}

	

	public function doLogout()

	{

		session_destroy();

		unset($_SESSION['user_session']);

		return true;

	}

}

?>