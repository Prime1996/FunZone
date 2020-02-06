<?php
session_start();

?>



<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
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
  <h3 style="text-align: center; color: #1A3333">Feast yourself with the latest movies</h3>
  <?php
  $con = mysqli_connect("localhost","root","","users");
  $i = 1;
    $q = "SELECT * FROM vidieos";
    $query = mysqli_query($con, $q);
    echo "<table><tr><th>Sl No.</th><th>Movie</th></tr>";
    while ($row = mysqli_fetch_assoc($query)) {
      $id = $row['id'];
      $name = $row['name'];
      echo "<tr><td>$i</td><td>$name</td>";
      echo "<td><a href='watch.php?id=$id'>Watch</a></td>";
      if ($_SESSION['username'] == "admin") {
        echo "<td><a href='delete1.php?id=$id'>Delete</a></td>";
      }
      echo "<td><a href='download.php?id=$name'>Download</a></td></tr>";
      $i = $i + 1;
    }
    echo "</table>";
     ?>

  </body>
</html>
