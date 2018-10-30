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
			
		//$hashedPassword = hash('sha256', $password);
			if ($password == $row['password'] && $password != "") {
				$_SESSION['loggedin'] = $username;
				header("Location: friendQuery.php");
				
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
