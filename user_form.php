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
	<title>Fortnite Friend Finder</title>
	<meta charset="UTF-8">
<link href="app.css" rel="stylesheet" type="text/css">
<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <script>
        $(function(){
            $("input[type=submit]").button();
        });
    </script>
</head>
<body>
<!-- Navbar -->
<div class="w3-top">
<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
<a class="w3-bar-item w3-button w3-padding-large w3-theme-d4" href='social.php'><i class="fa fa-home w3-margin-right"></i>Home</a>
<!-- change link to account editing-->
<a class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="My Account" href="user_form.php">
<img src="<?php echo("avatars/" . $_SESSION['avatar'] . ".jpg")?>" class="w3-circle" style="height:23px;width:23px" alt="Profile">
</a>
<button class="w3-bar-item w3-button w3-left w3-padding-large" onclick="location.href='friendQuery.php';">FriendFinder</button>
<button class="w3-bar-item w3-button w3-right w3-padding-large" onclick="location.href='logout.php';">Log Out</button>
</div>

</div>
<div id="mainContainer" style="margin-top: 60px">
    <div id="loginWidget" class="ui-widget">
        
        <h1 class="ui-widget-header" style="border-radius: 10px 10px 0 0;">Edit Account Details</h1>
        
        <?php
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        ?>

        <form action="getUser.php" method="POST">
            
            <input type="hidden" name="action" value="updateUser">
            
        <?php
            $con = mysqli_connect('localhost','root','Capstone18','FFF');
			if (!$con) {
		    	die('Could not connect: ' . mysqli_error($con));
			}
			
			$sql="SELECT * FROM members WHERE username = '" . $loggedIn . "'";
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
                <input class="greenButton" type="submit" value="Save">

                <button class="redButton logoutButton" onclick="location.href='social.php';">Cancel</button>
            </div>

        </form> 
    </div>

</body>
</html>
