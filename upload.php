<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Upload</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
      <h1>Welcome to AUSEMENT TIME</h1>
    </div>

  <?php
    if (isset($_SESSION['message'])) {
      echo "<div id='error_msg'>".$_SESSION['message']."</div>";
      unset($_SESSION['message']);
    }
   ?>

  <h3 style="text-align: right;">Welcome <?php echo $_SESSION['username']; if ($_SESSION['username'] == "admin") {echo " | <a href='home.php'>Home</a>";} ?> | <a href="logout.php">Log Out</a></h3>

    <form method="post" enctype="multipart/form-data">
      <input type="file" name="file" >
      <input type="submit" name="submit" value="Upload">
    </form>
    <?php
    $con = mysqli_connect("localhost","root","","users");
    if (isset($_POST['submit'])) {
      $name = $_FILES['file']['name'];
      $temp = $_FILES['file']['tmp_name'];
      move_uploaded_file($temp,"upload/".$name);
      $q = "INSERT INTO vidieos(name) VALUES ('$name')";
      if (mysqli_query($con, $q)) {
        echo "Done uploading";
      }else {
        echo "Error uploading";
      }
    }
     ?>


  </body>
</html>
