<?php
// Start session
if (!isset($_SESSION)) session_start();


if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $passwordHash = md5($password);

  require_once "database.php"; // Assuming you include your database connection here

  $sql = "SELECT fullname, email, isAdmin, password FROM customers WHERE email = ?";
  $stmt = mysqli_stmt_init($conn);

  if (mysqli_stmt_prepare($stmt, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($result && $row = mysqli_fetch_assoc($result)) {
          $dbPassword = $row['password'];
          $isAdmin = $row['isAdmin'];

          if ($passwordHash == $dbPassword) {
            if($isAdmin){
              $_SESSION["valid_admin"] = $email;
              echo '<script type="text/javascript"> ';
              echo ' if (confirm("Welcome Back, ' . $row['fullname'] . '")) {';
              echo '    window.location.href = "admin.php";';
              echo ' }';
              echo '</script>';
              exit();
            } else{
              $_SESSION["valid_user"] = $email;
              echo '<script type="text/javascript"> ';
              echo ' if (confirm("Welcome Back, ' . $row['fullname'] . '")) {';
              echo '    window.location.href = "index.php";';
              echo ' }';
              echo '</script>';
              exit();
            }
          } else {
              echo '<script type="text/javascript"> ';
              echo ' if (confirm("Incorrect Username/Password")) {';
              echo '    window.location.href = "login.php";';
              echo ' }';
              echo '</script>';
          }
      } else {
          echo '<script type="text/javascript"> ';
          echo ' if (confirm("Email not found")) {';
          echo '    window.location.href = "login.php";';
          echo ' }';
          echo '</script>';
      }

      mysqli_stmt_close($stmt);
  }

  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Jim Outfitters</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<header>
  <?php include "header.php" ?>
</header>
<body class="beige-body">

    <div class="login-form login-form-styles">
      <div class="login-text">
        <h3>LOGIN</h3>
      </div>
      <form method = "post" action = "login.php">
          <div class="login-deets-div">
            <label for="email">Email</label>
            <br>
            <input type ="email" name="email" placeholder="Enter Email">
          </div>
          <div class="login-deets-div">
            <label for="password">Password</label>
            <br>
            <input type = "password" name="password" placeholder="Enter Password">
          </div>
          <div class="login-button">
            <input type = "submit" name = "login" value="Login" placeholder="Login">
            <br><br>
            <p>or <a href="registration.php">Sign up</a></p>
          </div>
      </form>
    </div>

</body>
<footer>
  <?php include "footer.php"?>
</footer>
</html>
