<?php
session_start();
$total_price = 0;
$cart_detail = '';
$cart_total = '';
if (isset($_SESSION['shopping_cart'])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $cart_detail .= '
        <div  class="box form-submit" id="cart_details">
            <input type="hidden" name="cart_id" class="product_id" value="' . $values["product_id"] . '">
            <a href="product.php?id=' . $values["product_id"] . '" class="fas fa-eye"></a>
            <img src="' . $values["product_image"] . '" alt="">
            <div class="name"> ' . $values["product_name"] . '</div>
            <div class="flex">
                <div class="price">$' . $values["product_price"] . '/-</div>
                <input type="number" name="product_quantity" id="change_quantity" class="product_quantity" min="1" max="5"  value="' . $values["product_quantity"] . '">
            </div>
            <div class="sub-total"> sub total :
                <span>$' . ($values["product_price"] * $values["product_quantity"]) . '</span>
            </div>
            <button class="delete-btn remove-cart" name="delete">delete</button>
        </div>';
        $total_price += ($values["product_price"] * $values["product_quantity"]);
    }
} else {
    $cart_detail .= '<p class="empty">your cart is empty</p>';
}
$check_total_price =  $total_price > 1 ? '' : 'disabled';
$isLogin = '';

if (isset($_SESSION['user_email'])) {
    $isLogin =   '<a href="checkout.php" class="btn  ' . $check_total_price . '">proceed to checkout</a>';
} else {
    $isLogin = '<a href="login.php" class="btn">please login to checkout</a>';
}
$cart_total .= '
    <p>total price : <span>$' . $total_price . '</span></p>
    <a href="shop.php" class="option-btn">continue shopping</a>
    <button id="clear-all-cart" class="delete-btn ' . $check_total_price . '">delete all item</button>
  ' . $isLogin . '
';


$data = array(
    'cart_detail' => $cart_detail,
    'cart_total' => $cart_total,
    'is_login' => $isLogin
);
echo json_encode($data);
