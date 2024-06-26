<?php
// Start the session
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();}
require_once 'database.php';

$product_data = array();
$product_price = array();
$product_img = array();


$sql = "SELECT product_id, img1, product_name, price from products";
$result = mysqli_query($conn, $sql);

while ($row = $result->fetch_assoc()) {
    $product_id = $row['product_id'];
    $product_name = $row['product_name'];
    $price = $row['price'];
    $img1 = $row['img1'];

    $product_data[$product_id] = $product_name;
    $product_price[$product_id] = $price;
    $product_img[$product_id] = $img1;
}



// Delete Session Array Code
if (isset($_GET['delete'])) {
    $keyToDelete = $_GET['delete'];


    if (isset($_SESSION['cart'][$keyToDelete])) {
        unset($_SESSION['cart'][$keyToDelete]);

    }

}
$email = $_SESSION["valid_user"];
$sql = "SELECT customer_id from customers where email = ?";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $customer_id = $row['customer_id'];
    }
}

$order_date = date('Y-m-d', time());

if (isset($_POST['checkoutBtn'])) {
    if (!empty($_SESSION['cart'])) {
        if (isset($_SESSION["valid_user"]) && !empty($_SESSION["valid_user"])) {
            $total = $_POST["total"];
            $email = $_SESSION["valid_user"];
            // Insert an order into the "orders" table
            $sql = 'INSERT INTO orders (customer_id, order_date, order_total) VALUES (?,?,?)';
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssd", $customer_id, $order_date, $total);
                mysqli_stmt_execute($stmt);

                $order_id = mysqli_insert_id($conn);

                $sql = 'INSERT INTO order_details (order_id, product_id, item_size, quantity, subtotal, custom_image) VALUES (?, ?, ?, ?, ?, ?)';
                $stmt = mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt, $sql)) {
                    foreach ($_SESSION['cart'] as $cartItem) {
                        $product_id = $cartItem['name'];
                        $size = $cartItem['size'];
                        $quantity = $cartItem['quantity'];
                        $subtotal = $product_price[$product_id] * $quantity;
                        $custom_image = $cartItem['custom_image'];

                        echo "Product ID: " . $product_id . "<br>";
                        echo "Size: " . $size . "<br>";
                        echo "Quantity: " . $quantity . "<br>";
                        echo "Subtotal: " . $subtotal . "<br>";
                        echo "Custom Image: " . $custom_image . "<br>";

                        mysqli_stmt_bind_param($stmt, "iissds", $order_id, $product_id, $size, $quantity, $subtotal, $custom_image);
                        mysqli_stmt_execute($stmt);
                    }
                    include 'index.php';
                    unset($_SESSION["cart"]);
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                    echo '<script type="text/javascript">';
                    echo 'Swal.fire({';
                    echo '    title: "Payment Success!",';
                    echo '    text: "Continue shopping?",';
                    echo '    icon: "success",';
                    echo '    showCancelButton: true,';
                    echo '    confirmButtonText: "Yes",';
                    echo '    cancelButtonText: "No"';
                    echo '}).then((result) => {';
                    echo '    if (result.isConfirmed) {';
                    echo '        window.location.href = "index.php";';
                    echo '    }';
                    echo '});';
                    echo '</script>';
                    exit();
                }
            }

            // Don't forget to close the statement and connection when you're done
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script type="text/javascript">';
            echo 'Swal.fire({';
            echo '    title: "Please login to make payment",';
            echo '    icon: "warning",';
            echo '    showCancelButton: true,';
            echo '    confirmButtonText: "Login",';
            echo '    cancelButtonText: "Cancel"';
            echo '}).then((result) => {';
            echo '    if (result.isConfirmed) {';
            echo '        window.location.href = "login.php";';
            echo '    }';
            echo '});';
        }
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script type="text/javascript">';
        echo 'Swal.fire({';
        echo '    title: "Your cart is empty!",';
        echo '    text: "Let\'s add some items",';
        echo '    icon: "info",';
        echo '    showCancelButton: true,';
        echo '    confirmButtonText: "Go to shop",';
        echo '    cancelButtonText: "Stay here"';
        echo '}).then((result) => {';
        echo '    if (result.isConfirmed) {';
        echo '        window.location.href = "index.php";';
        echo '    }';
        echo '});';
    }
}
?>


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cart | Luxure Personalization Programme</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yeseva+One' rel='stylesheet'>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

  </head>

  <body>
    <header>
      <?php include "header.php"?>
    </header>
    <div class="cart-body">
      <div class="cart-content">

        <!-- first column -->
        <div class="cart-order-item">

        <?php   
        $subtotal=0;
        $ship=0;
        $total=0;
    // Check if the cart is not empty
    foreach ($_SESSION['cart'] as $i => $cartItem) {
      $itemKey = $cartItem['name'];
      if (isset($product_price[$itemKey])) {
          $ssubtotal = $cartItem['quantity'] * $product_price[$itemKey];
  
          echo '<div class="cart-item">';
          echo '    <div class="cart-item-img">';
          echo '        <img src="images/products/' . $product_img[$itemKey] . '">';
          echo '    </div>';
          echo '    <div class="cart-item-name">';
          echo '        <h6>' . $product_data[$itemKey] . '</h6>';
          echo '    </div>';
          echo '    <div class="cart-item-size">';
          echo '        <h6>' . $cartItem['size'] . '</h6>';
          echo '    </div>';
          echo '    <div class="cart-item-qty">';
          echo '        <h6> ' . $cartItem['quantity'] . ' </h6>';
          echo '    </div>';
          echo '    <div class="cart-item-price">';
          echo '        <h6> $' . number_format($ssubtotal, 2) . ' </h6>';
          echo '    </div>';
          echo '    <div class="cart-delete">';
          echo '        <a href="' . $_SERVER['PHP_SELF'] . '?delete=' . $i . '"><img src="images/bin-black.png" alt="Delete"></a>';
          echo '    </div>';
          echo '</div>';
  
          $subtotal += $ssubtotal;
  
          if ($subtotal < 100) {
              $ship = 5;
          } else {
              $ship = 0;
          }
          if ($subtotal == 0) {
              $total = 0;
          } else {
              $total = $subtotal + $ship;
          }
      } else {
          echo '<p>Produk dengan ID ' . $itemKey . ' tidak ditemukan.</p>';
      }
  }  

      echo '    </div>';

      echo '    <div class=""></div>';


      echo '    <div class="cart-order-summary">';
      echo '      <h3>Order Summary</h3>';
      echo '      <div class="order-values">';
      echo '        <h5>Subtotal </h5>';
      echo '       <h5 class="order-price">$'.number_format($subtotal, 2) .'</h5>';
      echo '     </div>';
      echo '     <div class="order-values bottom-border-line">';
      echo '       <h5>Shipping</h5>';
      echo '       <h5 class="order-price">$'.number_format($ship, 2).'</h5>';
      echo '     </div>';
      echo '      <div class="order-values ">';
      echo '        <h5>TOTAL</h5>';
      echo '        <h5 class="order-price">$'.number_format($total, 2).'</h5>';
      echo '      </div>';
      echo '      <form class="" action="'.$_SERVER['PHP_SELF'].'" method="post">';
      echo '        <button type="submit" name="checkoutBtn" class="brown-btn">';
      echo '          CHECK OUT';
      echo '        </button>';
      echo ' <input type="hidden" name="total" value="'.$total.'">';
      echo '      </form>';
      echo '    </div>';
      echo '  </div>';
      echo '</div> ';
      ?>

      <footer>
        <?php include "footer.php"?>
      </footer>

  </body>
</html>