<?php
	
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	
	if ($loggedIn) {
		header("Location: social.php");
		exit;
	}
	
	
	$action = empty($_POST['action']) ? '' : $_POST['action'];
	
	if ($action == 'do_login') {
		handle_login();
	} else {
		login_form();
	}
	
	function handle_login() {
	
		$username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
		
		$con = mysqli_connect('localhost','root','Capstone18','FFF');
		
		if (!$con) {
		    die('Could not connect: ' . mysqli_error($con));
		}
		
		$sql="SELECT * FROM members WHERE username = '" . $username . "'";
		
		$result = mysqli_query($con,$sql);
		
		
		$row = mysqli_fetch_array($result);
			
		$hashedPassword = hash('sha256', $password);
			
		if ($hashedPassword == $row['password'] && $hashedPassword != "") {
			$_SESSION['loggedin'] = $username;
            $_SESSION['avatar'] = $row['avatar'];
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['lastName'] = $row['lastName'];
            $_SESSION['gameType'] = $row['gameType'];
            $_SESSION['console'] = $row['console'];
			header("Location: social.php");
				
		} 
		else {	
			$error = 'Incorrect username or password';
			require "loginform.php";
			
		}	
		
		
	}
	
	
	
	function login_form() {
		$username = "";
		$error = "";
		require "loginform.php";
		return;
	}
	
	
?>
