<?php
	
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	
	if ($loggedIn) {
		header("Location: friendQuery.php");
		exit;
	}
	
	
	$action = empty($_POST['action']) ? '' : $_POST['action'];
	//If user didn't get to this page from registration_form.php, send them there	
	if ($action == 'do_registration') {
		handle_registration();
	} else {
		registration_form();
	}

	function handle_registration() {
		
		$firstName = empty($_POST['firstName']) ? '' : $_POST['firstName'];
		$lastName = empty($_POST['lastName']) ? '' : $_POST['lastName'];
		$username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
		$passwordConfirm = empty($_POST['passwordConfirm']) ? '' : $_POST['passwordConfirm'];
		$email = empty($_POST['email']) ? '' : $_POST['email'];
		$gamertag= empty($_POST['gamertag']) ? '' : $_POST['gamertag'];
		$console = empty($_POST['console']) ? '' : $_POST['console'];
		$gameType = empty($_POST['gameType']) ? '' : $_POST['gameType'];
		
		$con = mysqli_connect('localhost' ,'root','Capstone18','FFF');
		
		if (!$con) {
		    die('Could not connect: ' . mysqli_error($con));
		}
		
		//Check if username is already in use
		$check_sql="SELECT * FROM members WHERE username = '" . $username . "'";
		$result = mysqli_query($con,$check_sql);
		
		if($result && (mysqli_num_rows($result) > 0)) {
			$error = "Username is already in use.";
			require "registration_form.php";
			return;
		}
		
		if($username != "" && $password != "" && $firstName != "" && $lastName != "" && $email != "" && $gamertag != "" && $console != "" && $gameType != "") {
			if($password != $passwordConfirm){
				$error = "Passwords do not match.";
				require "registration_form.php";
				return;
			}
			
			$insert_sql = "INSERT INTO members (firstName, lastName, username, password, gamertag, email, console, gameType) VALUES ('" . $firstName . "', '" . 
			$lastName . "', '" . $username . "', '" . $password . "', '" . $gamertag . "', '" . $email . "', '" . $console . "', " . $gameType . ");";
			
			if(!mysqli_query($con,$insert_sql)){
				$error = "User could not be created";
				require "registration_form.php";
				return;
			}
			else {
				$_SESSION['loggedin'] = $username;
				header("Location: friendQuery.php");
			}
			
		}
		else {
			$error = "Please fill out all fields.";
			require "registration_form.php";
			return;
		}
	}
				


	
	function registration_form() {
		$username = "";
		$error = "";
		require "registration_form.php";
		return;
	}
	
?>
