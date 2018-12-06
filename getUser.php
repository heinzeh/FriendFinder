<?php
	
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	

	$action = empty($_POST['action']) ? '' : $_POST['action'];

	if ($action == 'updateUser') {
		handle_update($loggedIn);
	} else {
		user_form();
	}
	
	function handle_update($loggedIn) {
	
		$password = empty($_POST['password']) ? '' : $_POST['password'];
		$passwordConfirm = empty($_POST['passwordConfirm']) ? '' : $_POST['passwordConfirm'];
		$firstName = empty($_POST['firstName']) ? '' : $_POST['firstName'];
		$lastName = empty($_POST['lastName']) ? '' : $_POST['lastName'];
		
		$con = mysqli_connect('localhost','root','Capstone18','FFF');
		
		if (!$con) {
		    die('Could not connect: ' . mysqli_error($con));
		}
		
		
		if($firstName != "" && $lastName != ""){
			$sql="UPDATE members SET firstName='" . $firstName . "', lastName='" . $lastName . "' WHERE username='" . $loggedIn . "';";
		
			if($firstName != "" && $lastName != "" && $password != ""){
				if($password != $passwordConfirm){
					$error = "Passwords do not match.";
					require "user_form.php";
					return;
				}
				else{
					$hashedPassword = hash('sha256', $password);
					$sql="UPDATE members SET firstName='" . $firstName . "', lastName='" . $lastName . "', password='" . $hashedPassword . "' WHERE username='" . $loggedIn . "';";
                    
				}
			}
			
			$result = mysqli_query($con,$sql);
			if(!$result){
				$error = "Could not update record.";
				require "user_form.php";
			}
			else{
                $_SESSION['firstName'] = $firstName;
                $_SESSION['lastName'] = $lastName;
				header("Location: social.php");
            
			}
			
		} else {	
			$error = 'Please ensure First Name and Last Name are filled out.';
			require "user_form.php";	
		}	
		
		
	}
	
	function user_form() {
		$error = "";
		require "user_form.php";
	}
	
	
?>
