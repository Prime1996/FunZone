<?php

session_start();
$id2 = $_SESSION['id'];
$con = mysqli_connect("localhost","root","","users");
if (isset($_GET['cid'])) {
  $id = $_GET['cid'];
  $q = "DELETE FROM comments WHERE cid=$id";
  $query = mysqli_query($con,$q);
}
header("location: watch.php?id=$id2");

 ?>
