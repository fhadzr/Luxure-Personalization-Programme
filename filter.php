<?php
       while ($row = $result->fetch_assoc()){
            $product_name = $row['product_name'];
            $img1 = $row['img1'];
            $price = $row['price'];
            $productid = $row['product_id'];

            echo'   <div class="shop-content">';
            echo'     <a href="product-info.php?id='. $productid. '">';
            echo'       <div class="shop-product">';
            echo'         <img src="images/products/' .$img1.'" height="300">';
            echo'         <h4>'. $product_name .'</h4>';
            echo'         <p>$'. $price .'</p>';
            echo'       </div>';
            echo'     </a>';
            echo'   </div>';
            $i++;
        }

    echo' </div>';

?>
