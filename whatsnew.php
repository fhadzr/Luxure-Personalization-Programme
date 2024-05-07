<?php
       require_once 'database.php';

       $sql = "SELECT product_id, img1, product_name, price from products
       where is_new = true";
       $result = mysqli_query($conn, $sql);
       $i=1;
       while ($row = $result->fetch_assoc()){

            $product_name = $row['product_name'];
            $img1 = $row['img1'];
            $price = $row['price'];
            $productid = $row['product_id'];

            echo '<div class="new-arr-item new-' .$i. '">';
            echo '<a href="product-info.php?id='. $productid. '">';
            echo '<div class="new-arr-item-image">';
            echo '<img src="images/products/' .$img1.'" height="280">';
            echo '</div>';
            echo '<div class="new-arr-item-name">';
            echo '<h4>'. $product_name .'</h4>';
            echo '</div>';
            echo '<div class="new-arr-item-price">';
            echo '<p> $'. $price .'</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
            $i++;
        }
        
?>
