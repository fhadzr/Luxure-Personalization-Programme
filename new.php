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
    <title>New | Luxure Personalization Programme</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yeseva+One' rel='stylesheet'>

    <script src="scripts/productTabs.js"></script>
    <!-- <script>
      document.getElementById("defaultOpen").click();
    </script> -->

  </head>

  <body>
    <header>
      <?php include "header.php"?>
    </header>
    <div class="new-shop">
      <div class="new-page-banner" style="background-image: url('images/banners/bannernew.png');"  >
      </div>
      <div class="new-shop-content">

        <!-- tab links -->
        <div class="tab">
          <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'newall')" id="defaultOpen">ALL</button>
          <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'neww')">WOMEN</button>
          <button class="tablinks green-transparent-btn" onclick="openProducts(event, 'newm')">MEN</button>
        </div>
        <!-- tab content -->
        <?php
        require_once 'database.php';
        $sql = "SELECT product_id, img1, product_name, price from products
        where is_new='1'";
        $result = mysqli_query($conn, $sql);
        $i=1;
        echo'   <div id="newall" class="tabcontent shop-content-grid">';
        include "filter.php";

        require_once 'database.php';
        $sql = "SELECT product_id, img1, product_name, price from products
        where (gender='women' AND is_new='1')";
        $result = mysqli_query($conn, $sql);
        $i=1;
        echo'   <div id="neww" class="tabcontent shop-content-grid">';
        include "filter.php";

        require_once 'database.php';
        $sql = "SELECT product_id, img1, product_name, price from products
        where (gender='men' AND is_new='1')";
        $result = mysqli_query($conn, $sql);
        $i=1;
        echo'   <div id="newm" class="tabcontent shop-content-grid">';
        include "filter.php"?>
      </div>
    </div>

    <footer>
      <?php include "footer.php"?>
    </footer>
  </body>

</html>
