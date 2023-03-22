<?php
include '../core/database.php';
include '../core/MysqlDatabase.php';
include '../core/config.php';
$db = new MysqlDatabase;

$id = $_GET['id'];
$categories = $db->table('categories')->getID($id);
foreach ($categories as $category);
unlink("../$category->image");

$result = $db->table('categories')->delete($id);
if ($result) {
    header('location:index.php');
}
