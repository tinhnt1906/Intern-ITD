<?php
session_start();

include '../../core/database.php';
include '../../drivers/MysqlDatabase.php';
include '../../env.php';
$db = new MysqlDatabase;

if (isset($_SESSION['email'])) {
    $result = $db->table('categories')->delete($_GET['id']);
    if ($result) {
        echo "<script type='text/javascript'>alert('delete category successfully');</script>";
        header("location:http://localhost/PHP/pages/category/");
    }
}
