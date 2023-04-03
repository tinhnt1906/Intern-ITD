<?php
include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
$db = new MysqlDatabase;

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $result = $db->table('users')->where(['verify_token' => $token]);
    if ($result) {
        $db->table('users')->updateToken($token, ['verify_token' => null]);
        echo '<h1>You have confirmed your account, please  <a href="login.php">login</a> </h1>';
    } else {
        echo '<h1>token does not exist</h1>';
    }
}