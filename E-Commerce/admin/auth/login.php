<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="../resources/css/font-face.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="../resources/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="../resources/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"
        media="all">
    <link href="../resources/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../resources/css/theme.css" rel="stylesheet" media="all">

</head>
<?php
session_start();
include '../core/database.php';
include '../core/config.php';
include '../core/MysqlDatabase.php';
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
        $_SESSION['user_email_admin'] = $user->email;
        $_SESSION['user_role_admin'] = $user->role;
        header('location:http://localhost/E-commerce/admin/dashboard');
    }
}
?>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="../resources/images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password"
                                        placeholder="Password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Main JS-->
    <script src="../resources/js/main.js"></script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body>

</html>
<!-- end document-->