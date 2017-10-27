<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

	class DbOperation{
		
		private $con;
		function __construct(){
			
			require_once dirname(__FILE__).'/DbConnect.php';
			
			$db = new DbConnect();
			
			$this->con = $db->connect();
			
		}
		
		/*CRUD -> C -> CREATE */
		
		function createUser($firstName, $lastName, $licenseNumber, $email, $pass){
			$password = md5($pass);
			if($stmt = $this->con->prepare("INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `license_number`, `email`, `password`) VALUES (NULL, ?, ?, ?, ?, ?);")){
			$stmt->bind_param("sssss", $firstName, $lastName, $licenseNumber, $email, $password);	
			$stmt->execute();
			}else{
				$error=$this->con->errno.''.$this->con->error;
				echo $error;
			}
			
		}
		
	}

