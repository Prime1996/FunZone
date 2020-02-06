<?php

 $con = mysqli_connect("localhost","root","","users");
 session_start();
 $id2 = $_SESSION['id'];


 //$q2 = "SELECT * FROM comments WHERE cid=$id2";
 if (isset($_GET['cid'])) {
   $id = $_GET['cid'];
   $q = "SELECT * FROM comments WHERE cid=$id";
   $query = mysqli_query($con,$q);
   while ($row = mysqli_fetch_assoc($query)) {
     $msg = $row['message'];
   }
 }
 //$query2 = mysqli_query($con,$q2);

 if (isset($_POST['edit'])) {
   $message = $_POST['message'];
   $sql = "UPDATE comments SET message='$message' WHERE cid='$id'";
   $query1 = mysqli_query($con, $sql);
   header("location: watch.php?id=$id2");
 }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    textarea{
      width: 500px;
      height: 80px;
    }
    button{
      height: 30px;
      width: 100px;
      background-color: #0A576E;
      color: #ffffff;
      cursor: pointer;
    }
    </style>
  </head>
  <body>
    <div class="header">
      <h1>Welcome to AMUSEMENT TIME</h1>
    </div>

  <?php
    if (isset($_SESSION['message'])) {
      echo "<div id='error_msg'>".$_SESSION['message']."</div>";
      unset($_SESSION['message']);
    }
   ?>

  <h3 style="text-align: right;">Welcome <?php echo $_SESSION['username']; if ($_SESSION['username'] == "admin") {echo " | <a href='upload.php'>Upload a movie</a>";} ?> | <a href="logout.php">Log Out</a></h3>

  <?php
  echo "<form method='POST' action=''>
  <textarea name='message'>".$msg."</textarea></br>
  <button name ='edit' type='submit'>Edit</button>
</form>";
   ?>
  </body>
</html>
