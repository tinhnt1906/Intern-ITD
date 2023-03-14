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

    // thực hiện login users
    if (!$errors) {
        //check user already exists
        $users = $db->table('users')->whereEmail($_POST['email']);
        foreach ($users as $user)

            $checkPassword = password_verify($_POST['password'], $user->password);
        if ($users && $checkPassword) {
            $_SESSION['email'] = $user->email;
            echo "<script type='text/javascript'>alert('User login ok');</script>";
        } else {
            echo "<script type='text/javascript'>alert('login failed');</script>";
        }
    }
}
?>


<body>
    <?php if (!isset($_SESSION['email'])) { ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <input type="email" name="email" placeholder="email">
                <?php if (isset($errors['email']['required'])) echo $errors['email']['required'] ?>
                <?php if (isset($errors['email']['invalid'])) echo $errors['email']['invalid'] ?>
            </div>
            <div>
                <input type="password" name="password" placeholder="password">
                <?php if (isset($errors['password']['required'])) echo $errors['password']['required'] ?>
                <?php if (isset($errors['password']['min'])) echo $errors['password']['min'] ?>
            </div>
            <button>Dang nhập</button>
        </form>
    <?php } else {
        header('location: http://localhost/PHP/');
    } ?>


</body>


</html>