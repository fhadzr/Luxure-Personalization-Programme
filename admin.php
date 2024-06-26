<?php
session_start();
if (!isset($_SESSION["valid_admin"])){
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Admin | Luxure Personalization Programme</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yeseva+One' rel='stylesheet'>

    <script src="scripts/productTabs.js">
      document.getElementById("defaultOpen").click();
    </script>
  </head>
  <body>
    <div class="admin-page">
      <div class="admin-nav-col">
        <div class="admin-nav">
          <h4>HELLO ADMIN</h4>
          <div class="admin-nav-buttons">
            <button class="tablinks" onclick="openProducts(event, 'products')" id="defaultOpen">Products</button>
          </div>
          <div class="admin-nav-buttons">
            <button class="tablinks" onclick="openProducts(event, 'orders')" id="ordersButton">Orders</button>
          </div>
          <div class="admin-nav-buttons">
            <a href="logout.php"><h6>Log Out</h6></a>
          </div>
        </div>
      </div>
      <div class="admin-edit-col">

 <!-- Product Tab -->
        <div id="products" class="tabcontent">
          <div class="admin-edit-products-title">
            <h3>PRODUCTS</h3>
            <?php
            echo '<a href="adminEditProd.php?id=0"><button type="button" name="button">ADD PRODUCT</button></a>';
            ?>
          </div>
          <div class="edit-products-table">
            <div class="edit-products-head">
              <div class="edit-products-head-content">
                <h6>ID</h6>
                <h6>IMAGE</h6>
                <h6>NAME</h6>
                <h6>DESCRIPTION</h6>
                <h6>GENDER</h6>
                <h6>CATEGORY</h6>
                <h6>PRICE</h6>
                <h6>NEW</h6>
                <h6>ACTIONS</h6>
              </div>
            </div>

            <!-- Start of PHP -->
            <?php
            require_once 'database.php';

            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);

            while ($row = $result->fetch_assoc()) {
              $product_id = $row['product_id'];
              $img1 = $row['img1'];
              $img2 = $row['img2'];
              $img3 = $row['img3'];
              $img4 = $row['img4'];
              $price = $row['price'];
              $product_name = $row['product_name'];
              $description = $row['description'];
              $gender = $row['gender'];
              $cat = $row['cat'];
              $is_new = $row['is_new'];

              echo '<div class="edit-products-item-padding">';
              echo '<div class="edit-products-item">';
              echo '<div class="edit-prod-id edit-prod-padding">';
              echo '<p>'.$product_id.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-img edit-prod-padding">';
              echo '<div class="edit-prod-img-grid">';
              echo '<div class="edit-prod-img-item">';
              echo '<img src="images/products/'.$img1.'">';
              echo '<p>'.$img1.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-img-item">';
              echo '<img src="images/products/'.$img2.'">';
              echo '<p>'.$img2.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-img-item">';
              echo '<img src="images/products/'.$img3.'">';
              echo '<p>'.$img3.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-img-item">';
              echo '<img src="images/products/'.$img4.'">';
              echo '<p>'.$img4.'</p>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '<div class="edit-prod-name edit-prod-padding">';
              echo '<p>'.$product_name.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-desc edit-prod-padding">';
              echo '<p>'.$description.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-gender edit-prod-padding">';
              echo '<p>'.$gender.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-cat edit-prod-padding">';
              echo '<p>'.$cat.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-price edit-prod-padding">';
              echo '<p>$'.$price.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-new edit-prod-padding">';
              echo '<p>'.$is_new.'</p>';
              echo '</div>';
              echo '<div class="edit-prod-action">';
              echo '<form action="" method="post">';
              echo '<a href="adminEditProd.php?id='.$product_id.'">';
              echo '<button type="button" name="edit"><p>EDIT</p></button>';
              echo '</a>';
              echo '</form>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
            ?>
            <!-- End of PHP -->

          </div>
        </div>

        <!-- Orders Tab -->
        <div id="orders" class="tabcontent">
          <div class="admin-orders">
            <div class="admin-orders-title">
              <h3>ORDERS</h3>
            </div>
            <div class="admin-orders-table">
              <div class="admin-orders-head">
                <div class="admin-orders-head-content">
                  <h6>SN</h6>
                  <h6>ORDER ID</h6>
                  <h6>EMAIL</h6>
                  <h6>ORDER DATE</h6>
                  <h6>ORDER TOTAL</h6>
                </div>
              </div>

              <!-- PHP Starts Here -->
              <?php
              require_once 'database.php';

              // Initialize arrays with product_id and customer_id as keys
              $product_data = [];
              $customer_data = [];

              // Fetch product data
              $sql = "SELECT product_id, product_name FROM products";
              $result = mysqli_query($conn, $sql);
              while ($row = $result->fetch_assoc()) {
                  $product_data[$row['product_id']] = $row['product_name'];
              }

              // Fetch customer data
              $sql = "SELECT customer_id, email FROM customers";
              $result = mysqli_query($conn, $sql);
              while ($row = $result->fetch_assoc()) {
                  $customer_data[$row['customer_id']] = $row['email'];
              }

              // Fetch orders
              $sql = "SELECT * FROM orders";
              $result = mysqli_query($conn, $sql);

              $i = 1;
              while ($row = $result->fetch_assoc()) {
                $order_id = $row['order_id'];
                $customer_id = $row['customer_id'];
                $order_date = $row['order_date'];
                $order_total = $row['order_total'];

                echo '<div class="admin-orders-item-padding">';
                echo '<div class="admin-orders-item">';
                echo '<div class="order-sn order-padding">';
                echo '<p>'.$i.'</p>';
                echo '</div>';
                echo '<div class="order-id order-padding">';
                echo '<p>'.$order_id.'</p>';
                echo '</div>';
                echo '<div class="order-email order-padding">';
                echo '<p>'.$customer_data[$customer_id].'</p>';
                echo '</div>';
                echo '<div class="order-date order-padding">';
                echo '<p>'.$order_date.'</p>';
                echo '</div>';
                echo '<div class="order-status order-padding">';
                echo '<p>$'.$order_total.'</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="admin-order-details-head">';
                echo '<div class="admin-order-details-head-content">';
                echo '<p>Name</p>';
                echo '<p>Size</p>';
                echo '<p>Quantity</p>';
                echo '<p>Price</p>';
                echo '<p>Custom Image</p>';
                echo '</div>';

                $sql = "SELECT * FROM order_details WHERE order_id = $order_id";
                $rresult = mysqli_query($conn, $sql);
                while ($row = $rresult->fetch_assoc()) {
                  $product_id = $row['product_id'];
                  $item_size = $row['item_size'];
                  $quantity = $row['quantity'];
                  $subtotal = $row['subtotal'];
                  $custom_image = $row['custom_image'];  // Fetch custom image

                  echo '</div>';
                  echo '<div class="admin-order-details">';
                  echo '<div class="admin-order-details-items">';
                  echo '<div class="order-detail-name order-detail-padding">';
                  echo '<p>'.$product_data[$product_id].'</p>';
                  echo '</div>';
                  echo '<div class="order-detail-size order-detail-padding">';
                  echo '<p>'.$item_size.'</p>';
                  echo '</div>';
                  echo '<div class="order-detail-qty order-detail-padding">';
                  echo '<p>'.$quantity.'</p>';
                  echo '</div>';
                  echo '<div class="order-detail-subtotal order-detail-padding">';
                  echo '<p>$'.$subtotal.'</p>';
                  echo '</div>';
                  echo '<div class="order-detail-custom-image order-detail-padding">';
                  echo '<img src="images/uploads/'.$custom_image.'" alt="Custom Image">';
                  echo '</div>';
                  echo '</div>';
                }
                echo '</div>';
                echo '</div>';

                $i++;
              }
              ?>
              <!-- PHP Ends Here -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
