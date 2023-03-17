<?php
include '../../core/database.php';
include '../../drivers/MysqlDatabase.php';
include '../../env.php';
$db = new MysqlDatabase;
$id = $_GET['id'];
$products = $db->table('products')->getID($id);
foreach ($products as $product);
unlink("../../$product->image");

$db->table('products')->delete($id);
