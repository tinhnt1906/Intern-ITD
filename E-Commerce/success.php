<?php
session_start();
include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
$db = new MysqlDatabase;
$order_id = md5(uniqid(rand(), true));
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $response = $transaction->send();

    if ($response->isSuccessful()) {
        $arr_body = $response->getData();
        die(print_r($arr_body));

        $payment_id = $arr_body['id'];
        $payer_id = $arr_body['payer']['payer_info']['payer_id'];
        $payer_email = $arr_body['payer']['payer_info']['email'];
        $amount = $arr_body['transactions'][0]['amount']['total'];
        $currency = PAYPAL_CURRENCY;
        $payment_status = $arr_body['state'];
        $db->table('orders')->create([
            'id' => $order_id,
            'payment_id' => $payment_id,
            'payer_id' => $payer_id,
            'user_id' => $_SESSION['user_id'],
            'email' =>  $payer_email,
            'total_price' => $amount,
            'currency' =>  PAYPAL_CURRENCY,
            'payment_status' => $payment_status,
            'order_status' => 'processing',
        ]);

        foreach ($_SESSION['shopping_cart'] as $keys => $values) {
            $db->table('order_detail')->create([
                'order_id' => $order_id,
                'product_id' => $values["product_id"],
                'quantity' => $values["product_quantity"],
                'price' => $values["product_price"]
            ]);

            $products =   $db->table('products')->where(['id' => $values["product_id"]]);
            foreach ($products as $product);
            $db->table('products')->update($values["product_id"], ['quantity' => $product->quantity - $values["product_quantity"]]);
            unset($_SESSION['shopping_cart']);
        }
        echo "Payment is successful. Your transaction id is: " . $payment_id;
    } else {
        echo $response->getMessage();
    }
} else {
    echo 'Transaction is declined';
}
