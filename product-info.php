<?php
session_start(); // Start the session
$id = ($_GET['id']);

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();} // Create an empty shopping cart

  // Check if the form is submitted
if (isset($_POST['add-to-cart'])) {
  if (isset($_POST['size'], $_POST['quantity'])) {
      // Retrieve and sanitize user inputs
      $product_name = htmlspecialchars($_POST['product_name']);
      $size = htmlspecialchars($_POST['size']);
      $quantity = (int)$_POST['quantity'];

      // Create an item array
      $item = array(
          'name' => $product_name,
          'size' => $size,
          'quantity' => $quantity
      );

      // Add the item to the cart
      $_SESSION['cart'][] = $item;

      echo '<script type="text/javascript"> ';
      echo 'alert("Item Added!");';
      echo 'window.location.href = "product-info.php?id='.$id.'";';
      echo '</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Product | Jim Outfitters</title>

    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yeseva+One' rel='stylesheet'>

    <script src="scripts/imageClick.js"></script>

  </head>

  <body>
    <header>
      <?php include "header.php"?>
    </header>
    <!-- overlay for expanding image -->
    <div id="overlay" onclick="exitImage()">
      <div id="current-img" onclick="exitImage()"></div>
    </div>


    <!-- actual content -->
<?php

if(isset($_GET['id'])){
  require_once 'database.php';

  // Use the id from the GET request and sanitize it to prevent SQL injection
  $product_id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "SELECT product_id, description, img1,img2,img3,img4, product_name, price,cat FROM products WHERE product_id = '$product_id'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    // Assuming you want to loop through the results
    while ($row = $result->fetch_assoc()) {
      $product_name = $row['product_name'];
      $img1 = $row['img1'];
      $img2 = $row['img2'];
      $img3 = $row['img3'];
      $img4 = $row['img4'];
      $description = $row['description'];
      $price = $row['price'];
      $cat = $row['cat'];

      switch ($cat) {
        case "top":
          $sizechart = "top.png";
            break;
        case "pants":
          $sizechart = "pants.png";
            break;
        // ...
        case "shorts":
          $sizechart = "shorts.png";
            break;
        default:

    }
    }
  } else {
    echo "Error in the SQL query: " . mysqli_error($conn);
  }
}


echo ' <div class="product-info" id="product-info"> ';
echo ' <div class="product-info-content"> ';

echo '   <div class="product-info-img"> ';

echo ' <img src="images/products/' . $img1 . '" id="main-img" onclick="expandImage(event, \'main-img\')"> ';
echo ' <div class="product-more-img"> ';
echo '   <div class="more-img"> ';
echo '     <img src="images/products/' . $img2 . '" id="img-1" onclick="expandImage(event, \'img-1\')"> ';
echo '   </div> ';
echo '   <div class="more-img"> ';
echo '     <img src="images/products/' . $img3 . '" id="img-2" onclick="expandImage(event, \'img-2\')"> ';
echo '   </div> ';
echo '   <div class="more-img"> ';
echo '     <img src="images/products/' . $img4 . '" id="img-3" onclick="expandImage(event, \'img-3\')"> ';
echo '   </div> ';


echo '     </div> ';
echo '   </div> ';

echo ' <div class=""></div>';
        echo ' <div class="product-info-text">';
          echo ' <h3>'. $product_name.' </h3>';
          echo ' <h6> '.$description.'</h6>';
          echo ' <h3> $'.$price.'</h3>';

          // Start of Form
          echo ' <div class="product-form">';
          echo ' <form class="" action="' . 'product-info.php?id='.$product_id . '" method="post">';
          echo '<input type="hidden" id="product_name" name="product_name" value="'.$product_id.'">';
              echo ' <div class="prod-form-size">';
                echo ' <label for="size">Select Size:</label>';
                echo ' <select name="size">';
                  echo ' <option value="S">S</option>';
                  echo ' <option value="M">M</option>';
                  echo ' <option value="L">L</option>';
                echo' </select>';
              echo '</div>';
              echo ' <div class="prod-form-qty">';
                echo ' <label for="qty">Quantity:</label>';
                echo ' <input type="number" name="quantity" value="1" min="1" max="99">';
              echo '</div>';
              echo ' <div class="add-cart-button">';
                echo ' <input type = "submit" name = "add-to-cart" value="Add to Cart" placeholder="ADD TO CART">';
              echo' </div>';
            echo' </form>';
          echo '</div>';

          echo '<div class="size-chart">';

          echo '<img src="images/size-chart/'.$sizechart.'">';
          echo '</div>';
          ?>
        </div>
      </div>
    </div>

    <footer>
      <?php include "footer.php"?>
    </footer>

  </body>
</html>
