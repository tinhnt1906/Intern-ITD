<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

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
    $checkEmail = $db->table('users')->where(['email' => $_POST['email']]);
    $checkPhone = $db->table('users')->where(['phone' => $_POST['phone']]);
    if ($checkEmail) {
        echo "<script type='text/javascript'>alert('Email already exists');</script>";
    } else if ($checkPhone) {
        echo "<script type='text/javascript'>alert('Number phone already exists');</script>";
    } else {
        $db->table('users')->create([
            'username' => $_POST['username'],
            'phone' => $_POST['phone'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'email' => $_POST['email'],
        ]);
        echo "<script type='text/javascript'>alert('register successfully. please login');</script>";
    }
}
?>

<body>
    <?php include 'components/header.php'; ?>

    <section class="form-container">
        <form id='form' action="" method="post" onsubmit="return validateRegister(event);">
            <h3>register now</h3>
            <input type="text" id="username" name="username" placeholder="enter your username" class="box">
            <input type="text" id="phone" name="phone" placeholder="enter your phone" class="box">
            <input type="email" id="email" name="email" placeholder="enter your email" maxlength="50" class="box">
            <input type="password" id="password" name="password" placeholder="enter your password" class="box">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="confirm your password" class="box">
            <button class="btn">Register</button>
            <p>already have an account?</p>
            <a href="login.php" class="option-btn">login now</a>
        </form>

    </section>
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