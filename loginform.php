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
        	<div class="titleWrapper"><h1 class = "titleWrapper">Fortnite Friend Finder</h1>
	</div>
		
	<div id="siteDescription">
		<h3>Fornite Friend Finder is a tool to find people to play with in the popular 'Battle Royale' mode in Fortnite.</h3>
		<h3>Login or Sign Up below to get started.</h3>
	</div>
    
    <div id="loginWidget" class="ui-widget">
        
        <h1 class="ui-widget-header">Login</h1>
        
        <?php
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        ?>
        
        <form action="index.php" method="POST">
            
            <input type="hidden" name="action" value="do_login">
            
            <div class="stack">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="ui-widget-content ui-corner-all" autofocus value="<?php print $username; ?>">
            </div>
            
            <div class="stack">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all">
            </div>
            
            <div class="stack">
                <input class = "greenButton" style="font-family: 'Burbank';font-size: 20px;" type="submit" value="Submit">
            </div>
            
        </form>
        <button class="greenButton" style="font-family: 'Burbank';" onclick="location.href='register.php';">Sign Up</button>
     </div>
    </div>
</body>
</html>
