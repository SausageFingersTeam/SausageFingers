<?php

	require_once '../includes/DbOperations.php';
	
	$response = array();

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		if(isset($_POST['email']) and isset($_POST['password'])){
			$db = new DbOperation();
			
			if($db->userLogin($_POST['email'], $_POST['password'])){
				
				$email=$_POST['email'];
				
				$user = $db->getUser($email);
				$response['error'] = false;
				$response['name'] = $user['first_name'];
				$response['message'] = "Logged in";
			}else{
				$response['error'] = true;
				$response['message'] = "Wrong Email or Passord :(";
			}
			
		}else{
			$response['error'] = true;
			$response['message'] = "Required fields are misiing!";
		}
		
	}
	
	echo json_encode($response);