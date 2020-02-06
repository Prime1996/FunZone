<?php

$con = mysqli_connect("localhost","root","","users");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $q = "SELECT * FROM vidieos where id=$id";
  $query = mysqli_query($con,$q);
  while ($row = mysqli_fetch_assoc($query)) {
    $name = $row['name'];
    $del = $row['id'];
    $q2 = "DELETE FROM vidieos WHERE id='$del'";
    $query1 = mysqli_query($con,$q2);
    unlink("upload/".$name);
  }
}

header("location: home.php");

 ?>
