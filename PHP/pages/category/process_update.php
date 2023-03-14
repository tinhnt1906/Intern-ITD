<?php
include '../../core/database.php';
include '../../drivers/MysqlDatabase.php';
include '../../env.php';
$db = new MysqlDatabase;

if (isset($_SESSION['email'])) {
    $result = $db->table('categories')->update(
        $_POST['id'],
        [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
        ]
    );
    if ($result) {
        echo "<script type='text/javascript'>alert('create category successfully');</script>";
        header("location:http://localhost/PHP/pages/category/");
    }
}
