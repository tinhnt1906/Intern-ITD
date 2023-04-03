<?php
include '../core/database.php';
include '../core/MysqlDatabase.php';
include '../core/config.php';
$db = new MysqlDatabase;

$id = $_POST['id'];
$order_status = $_POST['order_status'];

$result = $db->table('orders')->update($id, [
    'order_status' => $order_status,
]);

if ($result) {
    header('location:index.php');
}