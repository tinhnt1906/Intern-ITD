<?php
session_start();

include '../../core/database.php';
include '../../drivers/MysqlDatabase.php';
include '../../env.php';
$db = new MysqlDatabase;

if (isset($_SESSION['email'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $result = $db->table('categories')->insert([
        'name' => $name,
        'description' => $description
    ]);

    if ($result) {
        echo "<script type='text/javascript'>alert('create category successfully');</script>";
        header("location:http://localhost/PHP/pages/category/");
    }
}
