<?php
if ($total<100){
$ship = 5;
}
else {
$ship = 0;
}

$to = $email;
$subject = 'Order Successful: Order ID '. $order_id; // Updated subject
$message = 'Your Order is Successful!

You have ordered:
';

foreach ($_SESSION['cart'] as $cartItem) {
    $itemKey = $cartItem['name'];

    $product_id = $product_data[$itemKey];
    $size = $cartItem['size'];
    $quantity = $cartItem['quantity'];
    $subtotal = $product_price[$itemKey] * $quantity;


    $message .=  $product_id. " Size: ". $size. " Quantity: ". $quantity. " Subtotal: $". number_format($subtotal, 2)."
";
     

}
$message .= '
Shipping Fee: $'. number_format($ship, 2);
$message .= '
Total Cost: $'. number_format($total, 2);
$message .= '

Thank you and we hope you will shop with us again';

$headers = 'From: f32ee@localhost' . "\r\n" .
           'Reply-To: f32ee@localhost' . "\r\n";

mail($to, $subject, $message, $headers);
echo "Mail sent to: " . $to;
?>


