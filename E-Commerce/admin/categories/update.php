<?php
include '../core/database.php';
include '../core/MysqlDatabase.php';
include '../core/config.php';
$db = new MysqlDatabase;

$name = $_POST['name'];
$image_path_old = $_POST['image_path_old'];
$image_file = $_FILES['image']['name'];
$file = $_FILES['image']['tmp_name'];
$id = $_POST['id'];
if ($image_file && $file) {
    unlink("../$image_path_old");
    $folder = '../resources/uploads/categories/';
    $extension = substr($image_file, strlen($image_file) - 4, strlen($image_file));
    $filename = rand() . '' . time() . '' . $extension;
    $image_path = $folder . $filename;
    $target_file = $folder . basename($image_path);
    move_uploaded_file($file, $target_file);
    $result = $db->table('categories')->update($id, ['category_image' => 'resources/uploads/categories/' . $filename,]);
}
if ($name) {
    $result =  $db->table('categories')->update($id, ['category_name' => $name]);
}

if ($result) {
    header('location:index.php');
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Edit successfully');
    </script>");
}
