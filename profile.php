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

</head>
<body>
	<div id="mainContainer">
        	<div class="titleWrapper"><h1>Fortnite Friend Finder</h1></div>
    <div id="loginWidget" class="ui-widget">
        
        <h1 class="ui-widget-header" style="border-radius: 10px 10px 0 0;">Profile Information</h1>
        
        <?php
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        ?>

        <form method="POST">
            
        <?php
            $con = mysqli_connect('localhost','root','Capstone18','FFF');
			if (!$con) {
		    	die('Could not connect: ' . mysqli_error($con));
			}
			
			$sql="SELECT * FROM members WHERE username = '" . $loggedIn . "'";
            
            /* Add query for the stats table to present them in a tabular format after the user's account info is displayed.
             $sqlStats = "SELECT * FROM stats WHERE username = '" . $loggedIn . "'";
            */
			$result = mysqli_query($con,$sql);
			while($row = mysqli_fetch_array($result)) {
                
                if ($row[gameType] == 0) {
                    $gameType = "Duos";
                } else {
                    $gameType = "Squads";
                }
                
                if ($row[console] == 0) {
                    $console = "PC";
                } else if ($row[console] == 1) {
                    $console = "Xbox One";
                } else {
                    $console = "PS4";
                }
                
				echo "<div class='stack'><label for='username'>Username:</label><label id='username' name='username' disabled='disabled' value='". $row[username] . "' class='ui-widget-content ui-corner-all'>$row[username]</label></div>";
				echo "<div class='stack'><label for='firstName'>First Name:</label><label id='firstName' name='firstName' value='". $row[firstName] . "' class='ui-widget-content ui-corner-all'>$row[firstName]</label></div>";
		        echo "<div class='stack'><label for='lastName'>Last Name:</label><label id='lastName' name='lastName' value='". $row[lastName] . "' class='ui-widget-content ui-corner-all'>$row[lastName]</label></div>";
		        echo "<div class='stack'><label for='email'>Email:</label><label id='email' name='email' value='" . $row[email] . "' class='ui-widget-content ui-corner-all'>$row[email]</label></div>";
		        echo "<div class='stack'><label for='gamertag'>Gamertag:</label><label id='gamertag' name='gamertag' value='". $row[gamertag] . "' class='ui-widget-content ui-corner-all'>$row[gamertag]</label></div>";
                echo "<div class='stack'><label for='platform'>Platform:</label><label id='platform' name='platform' value='" . $console . "' class='ui-widget-content ui-corner-all'>$console</label></div>";
		        echo "<div class='stack'><label for='preferredGametype'>Preferred Gametype:</label><label id='preferredGametype' name='preferredGametype' value='". $gameType . "' class='ui-widget-content ui-corner-all'>$gameType</label></div>";
                
                /* ADD stats here once functions are created probably going to have to make a table using that info
                <table>
                    <th></th>
                    <tr></tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                </table>
                */
 			}
 		?>
            
        </form> 
        
        <button class="greenButton" /* Add update functionality for the stats table */ >Update Stats</button>
        <button class="redButton" onclick="location.href='social.php';">Back</button>
    </div>   
</body>
</html>
