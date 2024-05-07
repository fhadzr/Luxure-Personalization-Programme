<?php
session_start();
if (!isset($_SESSION["valid_admin"])){
  header("Location: index.php");
}
$id = ($_GET['id']);


if (isset($_POST['SubmitBtn'])) {

  $img1 = $_POST['edit-new-main-img'];
  $img2 = $_POST['edit-new-img1'];
  $img3 = $_POST['edit-new-img2'];
  $img4 = $_POST['edit-new-img3'];
  $price = $_POST['edit-new-price'];
  $product_name = $_POST['edit-new-name'];
  $description = $_POST['edit-new-desc'];
  $gender = $_POST['edit-new-gender'];
  $cat = $_POST['edit-new-cat'];
  $is_new = $_POST['edit-new-is-new'];

  require_once 'database.php';
  if ($id==0){

  $sql = 'INSERT INTO products ( img1, img2, img3, img4, product_name, description, gender, cat, price, is_new) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
  $stmt = mysqli_stmt_init($conn);

  if (mysqli_stmt_prepare($stmt, $sql)) {

      mysqli_stmt_bind_param($stmt, "ssssssssdi", $img1, $img2, $img3, $img4, $product_name, $description, $gender, $cat, $price, $is_new);
      mysqli_stmt_execute($stmt);

      if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo '<script type="text/javascript"> ';
        echo 'alert("Product added successfully!");';
        echo 'window.location.href = "admin.php";';
        echo '</script>';
      }

      mysqli_stmt_close($stmt);
  }

  mysqli_close($conn);


}
   else {
    $sql = "UPDATE products
    SET img1 = '$img1', img2 = '$img2', img3 = '$img3', img4 = '$img4',
        product_name = '$product_name', description = '$description',
        gender = '$gender', cat = '$cat', price = $price, is_new = $is_new
    WHERE product_id = '$id'";

      if (mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript"> ';
        echo 'alert("Product updated successfully!");';
        echo 'window.location.href = "admin.php";';
        echo '</script>';
      }
  }

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin - EDIT Products | Jim Outfitters</title>

    <link rel="stylesheet" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Yeseva+One' rel='stylesheet'>


  </head>
  <body>
    <div class="admin-page">
      <div class="admin-nav-col">
        <div class="admin-nav">
          <h4>HELLO SUPERADMIN</h4>
          <div class="admin-nav-buttons">
            <a href="admin.php"><button class="tablinks">Products</button></a>
          </div>
          <div class="admin-nav-buttons">
            <a href="admin.php#orders"><button class="tablinks">Orders</button></a>
          </div>
          <div class="admin-nav-buttons admin-logout-div">
            <a href="index.php"><h6>Log Out</h6></a>
          </div>
        </div>
      </div>
      <div class="admin-edit-col">

 <!-- edit Product Tab -->
        <div id="products" class="tabcontent">
          <div class="admin-add-products-title">
            <?php
            if ($id == 0){
echo '          <h3>ADD PRODUCTS</h3>';
            }else{
echo '              <h3>EDIT PRODUCTS</h3>';
            }
            ?>

            <?php
echo '        <a href="admin.php"><button type="button" name="button">BACK</button></a>';
echo '                             </div>';
            ?>
          <div class="add-products-table">
            <div class="add-products-head">
              <div class="add-products-head-content">
                <h6>ID</h6>
                <h6>IMAGE</h6>
                <h6>NAME</h6>
                <h6>DESCRIPTION</h6>
                <h6>GENDER</h6>
                <h6>CATEGORY</h6>
                <h6>PRICE</h6>
                <h6>NEW</h6>
              </div>
            </div>

            <!--repeated for each product -->
            <!-- start of php -->
            <?php



if ($id == 0){
  $product_id = "0";
  $img1 = "";
  $img2 = "";
  $img3 = "";
  $img4 = "";
  $price = "";
  $product_name = "";
  $description = "";
  $gender = "men";
  $cat = "top";
  $price = "0";
  $is_new = "1";
} else {

require_once 'database.php';

$sql = "SELECT * from products WHERE product_id = '$id'";
$result = mysqli_query($conn, $sql);

while ($row = $result->fetch_assoc()){
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
  $price = $row['price'];
  $is_new = $row['is_new'];
  }
}

echo '                       <form action="adminEditProd.php?id='.$id.'" method="post">';

echo '                       <div class="add-products-item-padding">';
echo '                         <div class="add-products-item">';

echo '                          <div class="add-prod-id add-prod-padding">';
echo '                             <p>'.$product_id.'</p>';
echo '                           </div>';
echo '                          <div class="add-prod-img add-prod-padding">';

echo '                              <div class="add-prod-img-item">';
echo '                                <img src="images/products/'.$img1.'">';
echo '                                <input type="text" name="edit-new-main-img" value="'.$img1.'" placeholder="M0-final.png" required>';
echo '                              </div>';
echo '                              <div class="add-prod-img-item">';
echo '                                <img src="images/products/'.$img2.'">';
echo '                                <input type="text" name="edit-new-img1" value="'.$img2.'" placeholder="M0-1.png" required>';
echo '                              </div>';
echo '                              <div class="add-prod-img-item">';
echo '                                <img src="images/products/'.$img3.'">';
echo '                                <input type="text" name="edit-new-img2" value="'.$img3.'" placeholder="M0-2.png" required>';
echo '                              </div>';
echo '                              <div class="add-prod-img-item">';
echo '                                <img src="images/products/'.$img4.'">';
echo '                                <input type="text" name="edit-new-img3" value="'.$img4.'" placeholder="M0-3.png" required>';
echo '                              </div>';

echo '                          </div>';
echo '                          <div class="add-prod-name add-prod-padding">';
echo '                            <input type="add-prod-name" name="edit-new-name" value="'.$product_name.'" placeholder="Enter product " required>';
echo '                          </div>';
echo '                          <div class="add-prod-desc add-prod-padding">';
echo '                          <input type="text" name="edit-new-desc" value="'.$description.'"  placeholder="Enter description " required>';
echo '                          </div>';
echo '                           <div class="add-prod-gender add-prod-padding">';
echo '                           <select name="edit-new-gender">';
switch ($gender) {
  case "men":
echo '                              <option value="women">women</option>';
echo '                              <option value="men"selected>men</option>';
      break;
  case "women":
echo '                              <option value="women"selected>women</option>';
echo '                              <option value="men">men</option>';
      break;
  default:

}
echo '                            </select>';
echo '                          </div>';
echo '                          <div class="add-prod-cat add-prod-padding">';
echo '                            <select name="edit-new-cat">';
switch ($cat) {
  case "pants":
    echo '                              <option value="top">top</option>';
    echo '                              <option value="shorts">shorts</option>';
    echo '                              <option value="pants"selected>pants</option>';
      break;
  case "shorts":
    echo '                              <option value="top">top</option>';
    echo '                              <option value="shorts"selected>shorts</option>';
    echo '                              <option value="pants">pants</option>';
case "top":
  echo '                              <option value="top"selected>top</option>';
  echo '                              <option value="shorts">shorts</option>';
  echo '                              <option value="pants">pants</option>';
      break;
  default:
}
echo '                             </select>';
echo '                          </div>';
echo '                          <div class="add-prod-price add-prod-padding">';
echo '                            <input type="number" name="edit-new-price" value="'.number_format($price, 2).'" step=any " min="1">';
echo '                          </div>';
echo '                         <div class="add-prod-new add-prod-padding">';
echo '                            <select name="edit-new-is-new">';
switch ($is_new) {
  case "1":
    echo '                              <option value="1"selected>Y</option>';
    echo '                              <option value="0">N</option>';
      break;
  case "0":
    echo '                              <option value="1">Y</option>';
    echo '                              <option value="0"selected>N</option>';
      break;
  default:
}
echo '                            </select>';
echo '                          </div>';

echo '      <div> </div> ';

echo ' <div class="add-cart-button">';
if ($id == 0){
  echo ' <input type = "submit" name = "SubmitBtn" value="ADD">';
} else{
  echo ' <input type = "submit" name = "SubmitBtn" value="UPDATE">';
}

echo' </div>';

echo '                       </div>';
echo '                     </div>';
echo '                    </form> ';

            ?>

            <!-- end of php -->

          </div>
        </div>

      </div>
    </div>
  </body>
</html>
