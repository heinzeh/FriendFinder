<?php
	session_start();
        if($_SESSION['loggedin'] == FALSE){
            header("Location:index.php");
        }
	
	$_SESSION = array();
	
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', 1,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}
	
	session_destroy();
	
	header("Location: index.php");
	exit;
?>
