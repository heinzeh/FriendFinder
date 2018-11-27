<?php
  $con = mysqli_connect('localhost','root','Capstone18','FFF');

  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }

  mysqli_select_db($con,"CS4320_Final_Project");

  $username = "twsnyder08"

  function getUser($username) {

    $sql="SELECT * FROM members, Stats WHERE members.username = $username AND Stats.Username = $username;";
    $result = mysqli_query($con,$sql);

    // $userdata = array();
    // while($row = mysql_fetch_array($result)) {
    //   $userdata[] = $row;
    // }
    //
    // return $userdata;

  }
  echo "<pre>";
  print_r($result);
  echo "</pre>";
  mysqli_close($con);
?>
