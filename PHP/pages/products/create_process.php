<?php

include '../../core/database.php';
include '../../drivers/MysqlDatabase.php';
include '../../env.php';
$db = new MysqlDatabase;

$name = $_POST['name'];
$price = $_POST['price'];
$image_file = $_FILES['image']['name'];
$file = $_FILES['image']['tmp_name'];

$folder = '../../resources/uploads/products/';
$extension = substr($image_file, strlen($image_file) - 4, strlen($image_file));
$filename = rand() . '' . time() . '' . $extension;
$image_path = $folder . $filename;
$target_file = $folder . basename($image_path);
move_uploaded_file($file, $target_file);

$db->table('products')->insert([
    'name' => $name,
    'price' => $price,
    'image' => 'resources/uploads/products/' . $filename,
]);
