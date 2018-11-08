//Update Session locations
<?php
	
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	if (!$loggedIn) {
		header("Location: index.php");
		exit;
	}
	
?>

<!DOCTYPE html>

<html>
<head>
	<title>MovieInfo Login</title>
	<meta charset="UTF-8">
	<link href="app.css" rel="stylesheet" type="text/css">
    <script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
    
    <script>
        $(function(){
            $("input[type=submit]").button();
        });
    </script>
</head>
<body>
	<div id="mainContainer">
        	<div class="titleWrapper"><h1>Fortnite Friend Finder</h1></div>
    <div id="loginWidget" class="ui-widget">
        
        <h1 class="ui-widget-header" style="border-radius: 10px 10px 0 0;">Account Details</h1>
        
        <?php
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        ?>

        //Make New backend file
        <form action="getUser.php" method="POST">
            
            <input type="hidden" name="action" value="updateUser">
            
        <?php
            $con = mysqli_connect('localhost','root','Capstone18','FFF');
			if (!$con) {
		    	die('Could not connect: ' . mysqli_error($con));
			}
			
			$sql="SELECT * FROM Users WHERE username = '" . $loggedIn . "'";
			$result = mysqli_query($con,$sql);
			while($row = mysqli_fetch_array($result)) {
				echo "<div class='stack'><label for='username'>Username:</label><input type='text' id='username' name='username' disabled='disabled' value='". $row[username] . "' class='ui-widget-content ui-corner-all'></div>";
				echo "<div class='stack'><label for='firstName'>First Name:</label><input type='text' id='firstName' name='firstName' value='". $row[firstName] . "' class='ui-widget-content ui-corner-all'></div>";
		        echo "<div class='stack'><label for='lastName'>Last Name:</label><input type='text' id='lastName' name='lastName' value='". $row[lastName] . "' class='ui-widget-content ui-corner-all'></div>";
		        echo "<div class='stack'><label for='password'>New Password:</label><input type='password' id='password' name='password' class='ui-widget-content ui-corner-all'></div>";
		        echo "<div class='stack'><label for='passwordConfirm'>Confirm Password:</label><input type='password' id='passwordConfirm' name='passwordConfirm' class='ui-widget-content ui-corner-all'></div>";
 			}
 		?>
            
            <div class="stack">
                <input type="submit" value="Save">
            </div>
        </form> 
    </div>

    
    <div class="logoutWrapper"><button class="logoutButton" onclick="location.href='social.php';">Cancel</button></div>
    
    /*<div class="logoutWrapper"><button class="logoutButton" onclick="location.href='deleteAccount.php';">Delete Account</button></div>*/
</body>
</html>
