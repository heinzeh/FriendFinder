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
	<title>Profile</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="app.css">
    <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>
<body>
    
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
            <a class="w3-bar-item w3-button w3-padding-large w3-theme-d4" href='social.php'><i class="fa fa-home w3-margin-right"></i>Home</a>
            <a class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="My Account" href='profile.php'>
                <img src="<?php echo("avatars/" . $_SESSION['avatar'] . ".jpg")?>" class="w3-circle" style="height:23px;width:23px" alt="Profile">
            </a>
            <button class="w3-bar-item w3-button w3-left w3-padding-large" onclick="location.href='friendQuery.php';">FriendFinder</button>

            <button class="w3-bar-item w3-button w3-right w3-padding-large" onclick="location.href='logout.php';">Log Out</button>
        </div>
    </div>

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
    </div>
    
	<div id="accountWrapper">
        <div class="titleWrapper" style="padding-top: 80px;">
            <h1 class="titleWrapper">Fortnite Friend Finder</h1>
        </div>
        
            <?php
                if ($error) {
                    print "<div class=\"ui-state-error\">$error</div>\n";
                }
         
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
                    echo "<div class='w3-container' style='margin-top:10px;'>
                              <!-- The Grid -->
                              <div class='w3-row-padding'>
                                <div class='w3-panel w3-round-xlarge w3-light-grey'>
                                    <h1 style='padding-top:10px;'>Profile Information</h1>
                                </div>
                                <!-- Left Column -->
                                <div class='w3-quarter'>";
                        echo "<div class='w3-card w3-round w3-white'>
                                <div class='w3-container'>
                                    <h4 class='w3-center' style='padding-top:10px;'>My Profile</h4>
                                    <p class='w3-center'><img src='avatars/$row[avatar].jpg' class='w3-circle' style='height:106px;width:106px' alt='Avatar'></p>
                                <hr>
                                    <p><i class='fa fa-user fa-fw w3-center w3-text-theme'></i>$row[username]</p>
                                    <p><i class='fa fa-address-book fa-fw w3-center w3-text-theme'></i>$row[firstName] $row[lastName]</p>
                                    <p><i class='fa fa-envelope fa-fw w3-center w3-text-theme'></i>$row[email]</p>
                                </div>
                            </div>
                            </div>";
                
                        echo "<div class='w3-quarter'><div class='w3-card w3-round w3-white'>
                                <h4 class='w3-center' style='padding-top:10px;'>Solo</h4>
                                <hr>
                                <div class='w3-container' style='column-count:2;'>
                                    <p><i class='fa fa-pencil fa-fw w3-margin-left w3-text-theme'></i>wins$row[username]</p>
                                    <p><i class='fa fa-percent fa-fw w3-margin-left w3-text-theme'></i>$row[firstName]</p>
                                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-left w3-text-theme'></i>$row[lastName]</p>
                                    <p><i class='fa fa-crosshairs fa-fw w3-margin-right w3-text-theme'></i>$row[username]</p>
                                    <p><i class='fa fa-home fa-fw w3-margin-right w3-text-theme'></i>$row[firstName]</p>
                                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i>$row[email]</p>
                                </div>
                            </div></div>";

        
                        echo "<div class='w3-quarter'><div class='w3-card w3-round w3-white'>
                                <h4 class='w3-center' style='padding-top:10px;'>Duo</h4>
                                <hr>
                                <div class='w3-container' style='column-count:2;'>
                                    <p><i class='fa fa-pencil fa-fw w3-margin-right w3-text-theme'></i>$row[username]</p>
                                    <p><i class='fa fa-percent fa-fw w3-margin-right w3-text-theme'></i>$row[firstName]</p>
                                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i>$row[lastName]</p>
                                    <p><i class='fa fa-crosshairs fa-fw w3-margin-right w3-text-theme'></i>$row[username]</p>
                                    <p><i class='fa fa-percent fa-fw w3-margin-right w3-text-theme'></i>$row[firstName]</p>
                                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i>$row[lastName]</p>
                                </div>
                            </div></div>";

                        echo "<div class='w3-quarter'><div class='w3-card w3-round w3-white'>
                                <h4 class='w3-center' style='padding-top:10px;'>Squads</h4>
                                <hr>
                                <div class='w3-container' style='column-count:2;'>
                                    <p><i class='fa fa-pencil fa-fw w3-margin-right w3-text-theme'></i>$row[username]</p>
                                    <p><i class='fa fa-percent fa-fw w3-margin-right w3-text-theme'></i>$row[firstName]</p>
                                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i>$row[lastName]</p>
                                    <p><i class='fa fa-crosshairs fa-fw w3-margin-right w3-text-theme'></i>$row[username]</p>
                                    <p><i class='fa fa-percent fa-fw w3-margin-right w3-text-theme'></i>$row[firstName]</p>
                                    <p><i class='fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme'></i>$row[lastName]</p>
                                </div>
                            </div></div>"; 
    
                    echo "</div></div></div>";
                
                    
                /*
                ADD stats here once functions are created probably going to have to make a table using that info
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
            <!-- add update functionality to stats tables-->
            <button class="greenButton">Update Stats</button>
        </div>
    </body>
</html>
