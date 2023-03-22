<?php
session_start();
include('./core/config.php');
try {
    $item_array = array();
    foreach ($_SESSION['shopping_cart'] as $keys => $value) {
        $item_array[] = array(
            'name' => $value['product_name'],
            'price' => $value['product_price'],
            'quantity' => $value['product_quantity'],
        );
    }
    $response = $gateway->purchase([
        'amount' => $_POST['total_price'],
        'items' => $item_array,
        'currency' => PAYPAL_CURRENCY,
        'returnUrl' => PAYPAL_RETURN_URL,
        'cancelUrl' => PAYPAL_CANCEL_URL,
        'address' => 'sa huỳnh',
    ])->send();

    if ($response->isRedirect()) {
        $response->redirect(); // this will automatically forward the customer
    } else {
        echo $response->getMessage();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
