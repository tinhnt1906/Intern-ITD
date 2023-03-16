<?php
include('./core/config.php');
include('./core/database.php');
include('./core/MysqlDatabase.php');
$db = new MysqlDatabase;

session_start();

if (isset($_POST["token"])) {


    \Stripe\Stripe::setApiKey('sk_test_51MmC4ZL4VsvdryfRnOr5xW9yQBBPaMjPadyBsBXn4qEUf5GpnCBiI8XCG7r2hCKkqmbdcw2NxbdI2WEkK5l07jqw00Lk6yboEG');

    $customer = \Stripe\Customer::create(array(
        'email'   => $_POST["email_address"],
        'source'  => $_POST["token"],
        'name'   => $_POST["customer_name"],
        'address'  => array(
            'line1'   => $_POST["customer_address"],
            'postal_code' => $_POST["customer_pin"],
            'city'   => $_POST["customer_city"],
            'state'   => $_POST["customer_state"],
            'country'  => 'US'
        )
    ));

    $order_number = rand(100000, 999999);

    $charge = \Stripe\Charge::create(array(
        'customer'  => $customer->id,
        'amount'  => $_POST["total_amount"] * 100,
        'currency'  => $_POST["currency_code"],
        'description' => $_POST["item_details"],
        'metadata'  => array(
            'order_id'  => $order_number
        )
    ));

    $response = $charge->jsonSerialize();

    if ($response["amount_refunded"] == 0 && empty($response["failure_code"]) && $response['paid'] == 1 && $response["captured"] == 1 && $response['status'] == 'succeeded') {
        $amount = $response["amount"] / 100;
        $db->table('order_table')->insert([
            'order_number'   => $order_number,
            'order_total_amount' => $amount,
            'transaction_id'  => $response["balance_transaction"],
            'card_cvc'    => $_POST["card_cvc"],
            'card_expiry_month' => $_POST["card_expiry_month"],
            'card_expiry_year'  => $_POST["card_expiry_year"],
            'order_status'   => $response["status"],
            'card_holder_number' => $_POST["card_holder_number"],
            'email_address'  => $_POST['email_address'],
            'customer_name'  => $_POST["customer_name"],
            'customer_address'  => $_POST['customer_address'],
            'customer_city'  => $_POST['customer_city'],
            'customer_pin'   => $_POST['customer_pin'],
            'customer_state'  => $_POST['customer_state'],
            'customer_country'  => $_POST['customer_country']
        ]);
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            $db->table('order_item')->insert([
                'order_id'  => $order_id,
                'order_item_name' => $values["product_name"],
                'order_item_quantity' => $values["product_quantity"],
                'order_item_price' => $values["product_price"]
            ]);
        }
        unset($_SESSION["shopping_cart"]);
        $_SESSION["success_message"] = "Payment is completed successfully. The TXN ID is " . $response["balance_transaction"] . "";
        header('location:http://localhost/cart/');
    }
}
