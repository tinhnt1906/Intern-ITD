<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trang đăng ký</title>
</head>
<?php
include '../../core/database.php';
include '../../drivers/MysqlDatabase.php';
include '../../env.php';
$db = new MysqlDatabase;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //validate form
    $errors = [];
    if (empty(trim($_POST['username']))) {
        $errors['username']['required'] = "<span style='color:red;'>username không được để trống</span>";
    }

    if (empty(trim($_POST['email']))) {
        $errors['email']['required'] = "<span style='color:red;'>email không được để trống</span>";
    } else {
        if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $errors['email']['invalid'] = "<span style='color:red;'>email không hợp lệ</span>";
        }
    }

    if (empty(trim($_POST['password']))) {
        $errors['password']['required'] = "<span style='color:red;'>password không được để trống</span>";
    } else {
        if (strlen(trim($_POST['password'])) < 5)
            $errors['password']['min'] = "<span style='color:red;'>password lớn hơn 5 kí tự</span>";
    }

    if (empty(trim($_POST['phone']))) {
        $errors['phone']['required'] = "<span style='color:red;'>phone không được để trống</span>";
    } else {
        if (strlen(trim($_POST['phone'])) < 8)
            $errors['phone']['min'] = "<span style='color:red;'>phone lớn hơn 8 kí tự</span>";
    }

    // thực hiện tạo users
    if (!$errors) {
        //check user already exists
        $users = $db->table('users')->whereEmail($_POST['email']);
        if ($users) {
            echo "<script type='text/javascript'>alert('User already exists');</script>";
        } else {
            $db->table('users')->insert([
                'username' => $_POST['username'],
                'phone' => $_POST['phone'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'email' => $_POST['email'],
            ]);
            echo "<script type='text/javascript'>alert('register successfully');</script>";
        }
    }
}
?>


<body>
    <?php if (!isset($_SESSION['email'])) { ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <input type="text" name="username" placeholder="username">
            <?php if (isset($errors['username']['required'])) echo $errors['username']['required'] ?>
            <?php if (isset($checkValid)) echo $checkValid ?>
        </div>
        <div>
            <input type="email" name="email" placeholder="email">
            <?php if (isset($errors['email']['required'])) echo $errors['email']['required'] ?>
            <?php if (isset($errors['email']['invalid'])) echo $errors['email']['invalid'] ?>
        </div>
        <div>
            <input type="text" name="phone" placeholder="phone">
            <?php if (isset($errors['phone']['required'])) echo $errors['phone']['required'] ?>
            <?php if (isset($errors['phone']['min'])) echo $errors['phone']['min'] ?>
        </div>
        <div>
            <input type="password" name="password" placeholder="password">
            <?php if (isset($errors['password']['required'])) echo $errors['password']['required'] ?>
            <?php if (isset($errors['password']['min'])) echo $errors['password']['min'] ?>
        </div>
        <button>Dang ki</button>
    </form>
    <?php } else {
        header('location: http://localhost/PHP/');
    } ?>
</body>


</html>