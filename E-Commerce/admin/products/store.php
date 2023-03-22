<?php
include '../core/database.php';
include '../core/MysqlDatabase.php';
include '../core/config.php';
$db = new MysqlDatabase;

$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$description = $_POST['description'];
$category_id = $_POST['category'];
$image_file = $_FILES['image']['name'];
$file = $_FILES['image']['tmp_name'];


$folder = '../resources/uploads/products/';
$extension = substr($image_file, strlen($image_file) - 4, strlen($image_file));
$filename = rand() . '' . time() . '' . $extension;
$image_path = $folder . $filename;
$target_file = $folder . basename($image_path);
move_uploaded_file($file, $target_file);
$result = $db->table('products')->create([
    'name' => $name,
    'price' => $price,
    'quantity' => $quantity,
    'description' => $description,
    'category_id' => $category_id,
    'image' => 'resources/uploads/products/' . $filename,
]);


if ($result) {
    header('location:index.php');
}
