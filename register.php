<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "users");
if (isset($_POST['register_btn'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);

  if ($password == $password2) {
    $password = md5($password);
    $sql = "INSERT INTO user(username, email, password) VALUES('$username', '$email', '$password')";
    mysqli_query($db, $sql);
    $_SESSION['message'] = "You are now an user";
    $_SESSION['username'] = $username;
    header("location: home.php");
  }else {
    $_SESSION['message'] = "Passwords don't match";
  }
}
?>



<!DOCTYPE html>
<html>
  <head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
      <h1>New Users Register Here</h1>
    </div>
    <?php
      if (isset($_SESSION['message'])) {
        echo "<div id='error_msg'>".$_SESSION['message']."</div>";
        unset($_SESSION['message']);
      }
     ?>

    <form method="post" action="register.php">
      <table>
        <tr>
          <td>Username:</td>
          <td> <input type="text" name="username" class="textInput"> </td>
        </tr>
        <tr>
          <td>Email:</td>
          <td> <input type="email" name="email" class="textInput"> </td>
        </tr>
        <tr>
          <td>Password:</td>
          <td> <input type="password" name="password" class="textInput"> </td>
        </tr>
        <tr>
          <td>Confirm Password:</td>
          <td> <input type="password" name="password2" class="textInput"> </td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="register_btn" value="Register">  <a href="login.php">I have an account</a> </td>
        </tr>
      </table>
    </form>
  </body>
</html>
