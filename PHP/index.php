<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
include './core/database.php';
include './drivers/MysqlDatabase.php';
include './env.php';
$db = new MysqlDatabase;
?>

<body>
    <h1 class="">Trang chủ</h1>
    <?php if (isset($_SESSION['email'])) {
        echo $_SESSION['email'];
    } else {
        echo '';
    } ?>
</body>

</html>