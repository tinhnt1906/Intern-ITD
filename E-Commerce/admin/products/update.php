<?php
include '../core/database.php';
include '../core/MysqlDatabase.php';
include '../core/config.php';
$db = new MysqlDatabase;

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image_path_old = $_POST['image_path_old'];
$quantity = $_POST['quantity'];
$description = $_POST['description'];
$category_id = $_POST['category'];
$image_file = $_FILES['image']['name'];
$file = $_FILES['image']['tmp_name'];

if ($image_file && $file) {
    unlink("../$image_path_old");
    $folder = '../resources/uploads/products/';
    $extension = substr($image_file, strlen($image_file) - 4, strlen($image_file));
    $filename = rand() . '' . time() . '' . $extension;
    $image_path = $folder . $filename;
    $target_file = $folder . basename($image_path);
    move_uploaded_file($file, $target_file);
    $result = $db->table('products')->update($id, [
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
}
$result = $db->table('products')->update($id, [
    'name' => $name,
    'price' => $price,
    'quantity' => $quantity,
    'description' => $description,
    'category_id' => $category_id,
]);

if ($result) {
    header('location:index.php');
}
