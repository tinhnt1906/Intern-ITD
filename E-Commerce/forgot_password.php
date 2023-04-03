<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">

</head>
<?php
include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
include 'sendMail.php';

$db = new MysqlDatabase;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //check user already exists
    $users = $db->table('users')->where(['email' => $_POST['email']]);
    foreach ($users as $user);
    if (!$users) {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('user not found');
            window.location.href='forgot_password.php';
            </script>");
    }

    $password_reset_token = md5(uniqid(rand(), true));
    $result = $db->table('users')->update($user->id, ['password_reset_token' => $password_reset_token]);

    $subject = 'Forgot password reset';
    $resetURL = '<br><br> Bạn đã yêu cầu thay đổi password. Vui lòng click vào đường link sau để thay đổi password <br>
    <a href="http://localhost/E-commerce/reset_password.php?token=' . $password_reset_token . '">Click me</a>';

    sendMail($_POST['email'], $user->username, $resetURL, $subject);
    echo "<script type='text/javascript'>alert('check email to recover password');</script>";
}
?>

<body>
    <?php include 'components/header.php'; ?>
    <?php if (empty($_SESSION['user_email'])) { ?>
    <section class="form-container">
        <form action="" method="post" onsubmit="return validateLogin(event);">
            <h3>Forgot password</h3>
            <input type="email" id='email' name="email" placeholder="enter your email" maxlength="50" class="box">
            <button class="btn">Submit</button>
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