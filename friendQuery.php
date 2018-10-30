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
<div id="mainContainer">
        <div class="titleWrapper"><h1 class = "titleWrapper">Fortnite Friend Finder</h1>
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
<button id="refresh" class="greenButton" onclick="showUser(document.getElementById('selectmenu').value);" style="display: none;">Refresh List</button>


<div class="logoutWrapper roundBox">
		
		<br>
		<button class="redButton" onclick="location.href='logout.php';">Log Out</button>

</div>

</body>
</html>
