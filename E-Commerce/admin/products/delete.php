<?php
include '../core/database.php';
include '../core/MysqlDatabase.php';
include '../core/config.php';
$db = new MysqlDatabase;

$id = $_GET['id'];
$products = $db->table('products')->getID($id);
foreach ($products as $product);
unlink("../$product->image");

$result = $db->table('products')->delete($id);
if ($result) {
    header('location:index.php');
}
