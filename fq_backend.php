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
//mysqli_select_db($con,"CS4320_Final_Project");
$sql="SELECT * FROM members WHERE gameType = '" . $q . "';";
$result = mysqli_query($con,$sql);
echo "<table bgcolor='#808080' class='table table-dark table-hover'>
<tr>
<th bgcolor='#595959' style='text-align: center;'>Username</th>
<th bgcolor='#595959' style='text-align: center;'>First Name</th>
<th bgcolor='#595959' style='text-align: center;'>Last Name</th>
<th bgcolor='#595959' style='text-align: center;'>Console</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td> <a href='https://www.friendfinder.com/?username=" . $row['username'] . "'> " . $row['username'] . "</a> </td>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['lastName'] . "</td>";
    echo "<td>" . $row['console'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
