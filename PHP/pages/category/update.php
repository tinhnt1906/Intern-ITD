<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
</head>
<?php
include '../../core/database.php';
include '../../drivers/MysqlDatabase.php';
include '../../env.php';
$db = new MysqlDatabase;
$categories = $db->table('categories')->getID($_GET['id']);
foreach ($categories as $category)
?>

<body>
    <?php if (isset($_SESSION['email'])) { ?>

    <form action="process_update.php" method="post">
        <div>
            <input type="hidden" name="id" value="<?php echo $category->id ?>">
        </div>
        <div>
            <input type="text" name="name" value="<?php echo $category->name ?>">
        </div>
        <div>
            <input type="text" name="description" value="<?php echo $category->description ?>">
        </div>
        <button>Sửa</button>
    </form>
    <?php } else {
    header('location: http://localhost/PHP/');
} ?>
</body>

</html>