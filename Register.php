<?php

	require_once '../includes/DbOperations.php';
	
	$response = array();

	if($_SERVER['REQUEST_METHOD']=='POST'){

		if (
				isset($_POST['first_name']) and 
				isset($_POST['last_name']) and 
				isset($_POST['license_number']) and
				isset($_POST['email']) and
				isset($_POST['password'])
			){
				$db = new DbOperation();
				if(!$db->createUser($_POST['first_name'], 
								$_POST['last_name'], 
								$_POST['license_number'], 
								$_POST['email'], 
								$_POST['password']
								)
				){
						$response['error'] = false;
						$response['message'] = "Registred Successfully! :)";
				}else{
						$response['error'] = true;
						$response['message'] = "There was a problem! :(";
					}
				
				
		}else{
				$response['error'] = true;
				$response['message'] = "Required fields are missing";
			}
		
		
	}else{
		$response['error'] = true;
		$response['message'] = "Invalid Request";
	}
	
	echo json_encode($response);
