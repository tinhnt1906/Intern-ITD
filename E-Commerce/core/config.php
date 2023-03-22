<?php
require_once "vendor/autoload.php";
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_database = 'shop_db';

use Omnipay\Omnipay;

define('CLIENT_ID', 'Af-gnmg_G1gRQKODLlmmlsxzNdsmgDjo_-CXVoGOLivaQd0cedDF491HcviuJVwoMlnUHUDuZYdvFbmA');
define('CLIENT_SECRET', 'EMwf6l186aQ4SnhYnrHsfZCNJ9nMCGeKSDTCWrQhiqnuiFy92g3qqhcsnfbCdIWHe8EDgjJrD3_PnJKj');

define('PAYPAL_RETURN_URL', 'http://localhost/E-commerce/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/E-commerce/cancel.php');
define('PAYPAL_CURRENCY', 'USD'); // set your currency here

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live