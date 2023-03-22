<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">

</head>
<?php
include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
$db = new MysqlDatabase;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //check user already exists
    $users = $db->table('users')->where(['email' => $_POST['email']]);
    foreach ($users as $user);
    if (!$users) {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('user not found');
            window.location.href='login.php';
            </script>");
    }

    $checkPassword = password_verify($_POST['password'], $user->password);
    if (!$checkPassword) {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('password not valid');
            window.location.href='login.php';
            </script>");
    }

    if ($users && $checkPassword) {
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_id'] = $user->id;
        echo "<script type='text/javascript'>alert('User login ok');</script>";
    }
}
?>

<body>
    <?php include 'components/header.php'; ?>
    <?php if (empty($_SESSION['user_email'])) { ?>
    <section class="form-container">
        <form action="" method="post" onsubmit="return validateLogin(event);">
            <h3>login now</h3>
            <input type="email" id='email' name="email" placeholder="enter your email" maxlength="50" class="box">
            <input type="password" id='password' name="password" placeholder="enter your password" maxlength="20"
                class="box">
            <button class="btn">Login</button>
            <p>don't have an account?</p>
            <a href="register.php" class="option-btn">register now</a>
        </form>
    </section>
    <?php } else {
        header('location:/E-Commerce/');
    } ?>
    <?php include 'components/footer.php'; ?>
    <script src="script.js"></script>
    <script src="resources/js/script.js"></script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body>

</html>