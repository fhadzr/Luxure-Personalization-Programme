<?php
require_once 'database.php';

$sql = "SELECT
                products.product_id,
                products.img1,
                products.product_name,
                products.description,
                products.price,
                SUM(order_details.quantity) AS total_quantity
        FROM products
        LEFT JOIN order_details ON products.product_id = order_details.product_id
        GROUP BY products.product_id, products.product_name, products.price, products.description
        ORDER BY total_quantity DESC
        LIMIT 1;";

$result = mysqli_query($conn, $sql);
if ($row = $result->fetch_assoc()){
     $product_name = $row['product_name'];
     $img1 = $row['img1'];
     $price = $row['price'];
     $description = $row['description'];
     $productid = $row['product_id'];

echo '<div class="Hoodie-Man-1.JPEG">';
echo '<img src="images/products/' .$img1. '"height="350">';
echo '</div>';
echo '<div class="best-product-details">';
echo '<h3>'. $product_name .'</h3>';
echo '<p>'. $description .'</p>';
echo '<p> $'. $price .'</p>';
echo '<a href="product-info.php?id='. $productid. '">';
echo '<button class="brown-btn view-prod-btn" type="button">View Product   > </button></a>';
echo '</a>';
echo '</div>';
}
?>
