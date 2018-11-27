<?php
	
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
    
    $con = mysqli_connect('localhost','root','Capstone18','FFF');
		
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
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
        
        <h1 class="ui-widget-header" style="border-radius: 10px 10px 0 0;">Password Reset</h1>
        
        <?php
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        
        ?>
        
        <form method="POST">
            <input type="hidden" name="action" value="editPassword">
            <?php 
            
                echo "<div class='stack'><label for='username'>Username:</label><input type='text' name='username' id='username' placeholder='Username' class='ui-widget-content ui-corner-all' required></div>"
            ?>

            <div class="stack">
                <button class="greenButton" style="font-family: 'Burbank';" type="submit">Send</button>
                <button class="redButton" style="font-family: 'Burbank';" onclick="location.href='loginform.php';">Login</button>
            </div>
            <?php
                  if(isset($_POST) && !empty($_POST)){
                        $username = mysqli_real_escape_string($con, $_POST['username']);
                        $sql = "SELECT * FROM `members` WHERE username = '$username'";
                        $res = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($res);
                        if($count == 1) {
                            echo "Send email to user with password\r\n";
                            $r = mysqli_fetch_assoc($res);
//                            $password = $r['password'];
                            $password = rand(99999999, 999999999);
                            echo $password;
                            $to = $r['email'];
                            $subject = "Your Recovered Password";
                            $message = "Please use this password to login " . $password;
                            $headers = "From: FFFGroupContact@gmail.com";
                            if(mail($to, $subject, $message)) {
                                echo "Your Password has been sent to your email id\r\n";
                                $sqlUpdate = "Update password FROM `members` WHERE username = '$username'";
                                $result = mysqli_query($con, $sqlUpdate);
                            } else {
                                echo "Failed to Recover your password, try again\r\n";
                            }      
                        } else {
                            echo "User name does not exist in database\r\n";
                        }

                         
                  }
            ?>
            
        </form> 
</body>
</html>    
            