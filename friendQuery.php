<?php

    session_start();
        if($_SESSION['loggedin'] == FALSE){
            header("Location:index.php");
        }
?>

<html>
<head>
<title>Fortnite Friend Finder</title>
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
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
                showButton();
            }
        };
        xmlhttp.open("GET","fq_backend.php?q="+str,true);
        xmlhttp.send();
    }
}

function showButton () { $('#refresh').show(); }
</script>
</head>
<body>
<!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
            <a class="w3-bar-item w3-button w3-padding-large w3-theme-d4" href='social.php'><i class="fa fa-home w3-margin-right"></i>Home</a>
            <a class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="My Account" href='profile.php'>
                <img src=<?php echo("'avatars/" . $_SESSION['avatar'] . ".jpg'");?> class="w3-circle" style="height:23px;width:23px" alt="Profile">
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

<div id="mainContainer">
        <div class="titleWrapper"><h1 class = "titleWrapper" style="padding-top: 100px;">Fortnite Friend Finder</h1>
		</div>
<form>
<select name="selectmenu" id="selectmenu" onchange="showUser(this.value)">
  <option disabled selected value="">Preferred Gametype:</option>
  <option value=1>Duos</option>
  <option value=2>Squads</option>
</select>
</form>
<br>
<div id="txtHint"><b>Select your preferred gametype above to view people looking for partners.</b></div>
<br>
</div>
</body>
</html>
