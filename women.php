<?php 
// Start session
if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Women | Luxure Personalization Programme</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yeseva+One' rel='stylesheet'>

    <script src="scripts/productTabs.js"></script>
    <script>
      document.getElementById("defaultOpen").click();
    </script>

  </head>

  <body>
    <header>
      <?php include "header.php"?>
    </header>
    <div class="shop">
      <!-- tab links -->
      <div class="tab">
        <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'wall')" id="defaultOpen">ALL PRODUCTS</button>
        <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'whoodie')">HOODIE</button>
        <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'wcrewneck')">CREWNECK</button>
        <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'wlongsleeve')">LONGSLEEVE</button>
        <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'wcroplongsleeve')">CROP LONGSLEEVE</button>
      </div>
      <!-- tab content -->
      <?php
      require_once 'database.php';
      $sql = "SELECT product_id, img1, product_name, price from products
      where gender = 'women'";
      $result = mysqli_query($conn, $sql);
      $i=1;
      echo'   <div id="wall" class="tabcontent shop-content-grid">';
      include "filter.php"?>

      <?php
      require_once 'database.php';
      $sql = "SELECT product_id, img1, product_name, price from products
      where (gender='women' AND cat='hoodie')";
      $result = mysqli_query($conn, $sql);
      $i=1;
      echo'   <div id="whoodie" class="tabcontent shop-content-grid">';
      include "filter.php"?>

      <?php
      require_once 'database.php';
      $sql = "SELECT product_id, img1, product_name, price from products
      where (gender='women' AND cat='longsleeve')";
      $result = mysqli_query($conn, $sql);
      $i=1;
      echo'   <div id="wlongsleeve" class="tabcontent shop-content-grid">';
      include "filter.php"?>

      <?php
      require_once 'database.php';
      $sql = "SELECT product_id, img1, product_name, price from products
      where (gender='women' AND cat='crewneck')";
      $result = mysqli_query($conn, $sql);
      $i=1;
      echo'   <div id="wcrewneck" class="tabcontent shop-content-grid">';
      include "filter.php"?>

      <?php
      require_once 'database.php';
      $sql = "SELECT product_id, img1, product_name, price from products
      where (gender='women' AND cat='crop longsleeve')";
      $result = mysqli_query($conn, $sql);
      $i=1;
      echo'   <div id="wcroplongsleeve" class="tabcontent shop-content-grid">';
      include "filter.php"?>

    </div>

    <footer>
      <?php include "footer.php"?>
    </footer>

  </body>

</html>
