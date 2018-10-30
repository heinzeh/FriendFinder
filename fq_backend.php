<?php

    session_start();
        if($_SESSION['loggedin'] == FALSE){
            header("Location:index.php");
        }
?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}
table, td, th {
    border: 1px solid black;
    padding: 5px;
}
th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);
$con = mysqli_connect('localhost','root','Capstone18','FFF');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"CS4320_Final_Project");
$sql="SELECT * FROM members WHERE gameType = '" . $q . "' ORDER BY RAND() LIMIT 8;";
$result = mysqli_query($con,$sql);
echo "<table bgcolor='#808080'>
<tr>
<th bgcolor='#595959' style='text-align: center;'>First Name</th>
<th bgcolor='#595959' style='text-align: center;'>Last Name</th>
<th bgcolor='#595959' style='text-align: center;'>Username</th>
<th bgcolor='#595959' style='text-align: center;'>Console</th>
<th bgcolor='#595959' style='text-align: center;'>Gamertag</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['lastName'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['console'] . "</td>";
    echo "<td>" . $row['gamertag'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
