<?php
session_start();

 date_default_timezone_set('Asia/Dhaka');
 $con = mysqli_connect("localhost","root","","users");
 if (isset($_POST['csubmit'])) {
   $vid = $_POST['vid'];
   $uname = $_SESSION['username'];
   $date = $_POST['date'];
   $message = $_POST['message'];
   $sql = "INSERT INTO comments(vid,uname,date,message) VALUES('$vid','$uname','$date','$message')";
   $query1 = mysqli_query($con, $sql);
 }
  ?>



<!DOCTYPE html>
<html>
  <head>
    <title>Watch</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      text-align: left;
      border: 1px solid #dddddd;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
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

  <h3 style="text-align: right;">Welcome <?php echo $_SESSION['username']; if ($_SESSION['username']) {echo " | <a href='home.php'>Home</a>";} ?> | <a href="logout.php">Log Out</a></h3>
  <?php

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $q = "SELECT name FROM vidieos where id=$id";
      $query = mysqli_query($con,$q);
      while ($row = mysqli_fetch_assoc($query)) {
        $name = $row['name'];
        echo "<h3 style='text-align:center; color: #1A3333'>You are watching ".$name."</h3>";
        echo "<div style='text-align:center;'><video width='600' controls><source src='upload/".$name."' type='video/webm'></video></div>";
      }

    }
    else {
      echo "error";
    }
    $_SESSION['id'] = $id;

    echo "<form method='POST' action=''>
      <input type='hidden' name='vid' value='".$id."'>
      <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
      <textarea name='message' ></textarea></br>
      <button name ='csubmit' type='submit'>Comment</button>
    </form>";

    $q2 = "SELECT * FROM comments WHERE vid=$id";
    $query2 = mysqli_query($con,$q2);
    echo "<form method='POST' action=''>";
    while ($row = mysqli_fetch_assoc($query2)) {
      $user = $row['uname'];
      $dte = $row['date'];
      $msg = $row['message'];
      $coid = $row['cid'];

      echo "<table><tr><td>".$user."</td><td>".$dte."</td></tr><tr><td colspan=2>".$msg."</td></tr></table>";
      echo "<a href='delete.php?cid=$coid'>Delete</a> | <a href='edit.php?cid=$coid'>Edit</a></br></br>";

    }
    echo "</form>";
    ?>

  </body>
</html>
