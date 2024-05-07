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
    <title>Luxure Apparel</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yeseva+One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Barlow+Condensed' rel='stylesheet'>

    <script src="scripts/home.js"></script>

  </head>

  <body>
    <header>
      <?php include "header.php"?>
    </header>
    <div class="home-banner">
      <div class="carousel">

        <a href="new.php">
          <!-- edit file name to link here -->
          <div class="carousel-item">
              <div class="slide-image"
                  style="background-image: url('images/banners/Banner-2.jpg');">
              </div>
          </div>
        </a>

        <a href="women.php">
          <!-- edit file name to link here -->
          <div class="carousel-item">
              <div class="slide-image" style="background-image: url('images/banners/Banner-3.jpg');">
              </div>
          </div>
        </a>

        <a href="men.php">
          <!-- edit file name to link here -->
          <div class="carousel-item">
              <div class="slide-image"
                  style="background-image: url('images/banners/Banner-4.jpg');">
              </div>
          </div>
        </a>

      </div>
    </div>

    <div class="home-prod-strip">
      <div class="home-prod-content">
        <em><b><h2>What's New</h2></b></em>
        <div class="new-arr-prod">
          <!-- whatsnew.php is to display new products -->
          <?php include "whatsnew.php"; ?>
        </div>
      </div>
    </div>
    <div class="best-banner" style="background-image: url('images/banners/best-banner.png');" >
    </div>
    <div class="home-prod-strip">
      <div class="home-prod-content">
        <em><b><h2>Trending now!</h2></b></em>
        <br>
        <h6>check out our best seller- tracked in real time!</h6>
        <div class="best-product">
        <!-- best.php is to display bestseller -->
        <?php include "best.php" ?>
        </div>
      </div>

    </div>

    <footer>
      <?php include "footer.php"?>
    </footer>
  </body>

</html>
