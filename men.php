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
    <title>Men | Luxure Personalization Programme</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yeseva+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Barlow+Condensed' rel='stylesheet'>

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
        <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'mall')" id="defaultOpen">ALL PRODUCTS</button>
        <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'mhoodie')">HOODIE</button>
        <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'mcrewneck')">CREWNECK</button>
        <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'mlongsleeve')">LONGSLEEVE</button>
      </div>
      <!-- tab content -->
      <?php
      require_once 'database.php';

      $sql = "SELECT product_id, img1, product_name, price from products
      where gender = 'men'";
      $result = mysqli_query($conn, $sql);
      $i=1;
      echo'   <div id="mall" class="tabcontent shop-content-grid">';
      include "filter.php";

      $sql = "SELECT product_id, img1, product_name, price from products
      where (gender='men' AND cat='hoodie')";
      $result = mysqli_query($conn, $sql);
      $i=1;
      echo'   <div id="mhoodie" class="tabcontent shop-content-grid">';
      include "filter.php";

      $sql = "SELECT product_id, img1, product_name, price from products
      where (gender='men' AND cat='crewneck')";
      $result = mysqli_query($conn, $sql);
      $i=1;
      echo'   <div id="mcrewneck" class="tabcontent shop-content-grid">';
      include "filter.php";

      $sql = "SELECT product_id, img1, product_name, price from products
      where (gender='men' AND cat='longsleeve')";
      $result = mysqli_query($conn, $sql);
      $i=1;
      echo'   <div id="mlongsleeve" class="tabcontent shop-content-grid">';
      include "filter.php";
      ?>

    </div>

    <footer>
      <?php include "footer.php"?>
    </footer>
  </body>

</html>
