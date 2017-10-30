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
		
		public function createUser($firstName, $lastName, $licenseNumber, $email, $pass){
			
			if($this->doesUserExist($email)){
				return 0;
			}else{
				$password = md5($pass);
				if($stmt = $this->con->prepare("INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `license_number`, `email`, `password`) VALUES (NULL, ?, ?, ?, ?, ?);")){
					$stmt -> bind_param("sssss", $firstName, $lastName, $licenseNumber, $email, $password);
					
					if($stmt -> execute()){
						return 1;
					}else{
						return 2;
					}
				}else{
					$error=$this->con->errno.''.$this->con->error;
					echo $error;
				}
			}
			
		}
		
		public function userLogin($email, $password){
			$pass = md5($password);
			$stmt = $this->con->prepare("SELECT `first_name` FROM `user` WHERE email= ? and password= ?");
			$stmt->bind_param("ss", $email, $pass);
			$stmt->execute();
			$stmt->store_result();
			
			return $stmt->num_rows>0;			
		}
		
		public function getUser($email){
			//echo gettype($email);
			
			$statement = mysqli_prepare($this->con, "SELECT `first_name` FROM `user` WHERE email = ?");
			mysqli_stmt_bind_param($statement, "s", $email);
			mysqli_stmt_execute($statement);
			
			
			/*
			$stmt = $this->con->prepare("SELECT `first_name` FROM `user` WHERE email= ?");
			$stmt -> bind_param("s",$email);			
			$stmt -> execute();
			$error=$this->con->errno.''.$this->con->error;
			$result = $this->con->query($stmt);
			*/
			
			return $statement->get_result()->fetch_assoc();
		}
		
		private function doesUserExist($email){
			$stmt = $this->con->prepare("SELECT `user_id` FROM `user` WHERE email = ?");
			$stmt -> bind_param("s",$email);
			$stmt -> execute();
			$stmt -> store_result();
			
			return $stmt -> num_rows>0;
		}
		
	}

