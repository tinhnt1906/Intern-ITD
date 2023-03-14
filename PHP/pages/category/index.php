<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trang danh mục sản phẩm</title>
</head>
<?php
include '../../core/database.php';
include '../../drivers/MysqlDatabase.php';
include '../../env.php';
$db = new MysqlDatabase;
$categories = $db->table('categories')->get();
?>

<body>
    <?php if (isset($_SESSION['email'])) { ?>
        <h1>danh mục sản phẩm</h1>
        <a href="create.php">Thêm Danh Mục Sản Phẩm</a>
        <table border="1" width="100%">
            <tr>
                <th>Mã</th>
                <th>Tên Danh Mục</th>
                <th>Mô Tả</th>
                <th>Xoá</th>
                <th>Sửa</th>
            </tr>
            <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?php echo $category->id ?></td>
                    <td><?php echo $category->name ?></td>
                    <td><?php echo $category->description ?></td>
                    <td><a href="delete.php?id=<?php echo $category->id ?>">Xoá</a></td>
                    <td><a href="update.php?id=<?php echo $category->id ?>">Sửa</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else {
        header('location: http://localhost/PHP/');
    } ?>

</body>

</html>