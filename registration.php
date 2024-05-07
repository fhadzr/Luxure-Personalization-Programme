<?php
// Start session
if (!isset($_SESSION)) session_start();

    if (isset($_POST["submit"])){
        $fullName = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];
        $address = $_POST["address"];

        $passwordHash = md5($password);

        // Connect Database
        require_once "database.php";

        $sql = "SELECT * FROM customers WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount>0){
          echo '<script type="text/javascript"> ';
          echo ' if (confirm("Email Already Exist ")) {';
          echo ' }';
          echo '</script>';
        }
        
        else if (empty($fullName)||empty($email)||empty($password)||empty($passwordRepeat)||empty($address)){
          echo '<script type="text/javascript"> ';
          echo ' if (confirm("There is missing information!"))';
          echo '</script>';
        }
        else {

            $sql = "INSERT INTO customers (fullname, email, password, address)
            VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt){
                mysqli_stmt_bind_param($stmt,"ssss",$fullName,$email,$passwordHash,$address);
                mysqli_stmt_execute($stmt);
                echo '<script type="text/javascript"> ';
                echo ' if (confirm("Account Registered! Please Login")) {';
                echo '    window.location.href = "login.php";';
                echo ' }';
                echo '</script>';
            } else {
                die ("Something went wrong");
            }
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Jim Outfitters</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="scripts/registration.js"></script>
</head>
<body class="beige-body">
  <header>
    <?php include "header.php"?>
  </header>
    <div class="login-form-styles register-form">
      <div class="login-text">
        <h3>SIGN UP</h3>
      </div>


      <form method = "post" action = "registration.php">
          <div class="login-deets-div">
            <label for="fullname">Full Name</label>
            <br>
              <input type = "text" name="fullname" id="fullname" placeholder="Full Name" onchange="valName()" required>
          </div>
          <div class="login-deets-div">
            <label for="email">Email</label>
            <br>
            <input type = "email" name="email" id="email" placeholder="Email" onchange="valEmail()" required>
          </div>
          <div class="login-deets-div">
            <label for="password">Password</label>
            <br>
            <input type = "password" name="password" id="password" placeholder="Password" onchange="valPass()" required>
          </div>
          <div class="login-deets-div">
            <label for="repeat_password">Repeat Password</label>
            <br>
            <input type = "password" name="repeat_password" id="repeat_password" placeholder="Repeat password" onchange="valRPass()" required>
          </div>
          <div class="login-deets-div">
            <label for="address">Address</label>
            <br>
            <input type = "text" name="address" id="address" placeholder="Address" onchange="valAdd()" required>
          </div>
          <div class="login-button">
            <input type = "submit" name = "submit" value="Register">
            <br><br>
            <p>or <a href="login.php">Login</a></p>
          </div>
      </form>
    </div>

    <footer>
      <?php include "footer.php"?>
    </footer>

</body>
</html>
