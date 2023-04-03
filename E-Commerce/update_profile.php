<?php
session_start();
include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
$db = new MysqlDatabase;
if (isset($_SESSION['user_id'])) {
    $users = $db->table('users')->getId($_SESSION['user_id']);
    foreach ($users as $user);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['new_password']) && $_POST['new_password'] != '') {
            $check_old_password = password_verify($_POST['old_password'], $user->password);
            if (!$check_old_password) {
                echo "<script type='text/javascript'>alert('old password is incorrect');</script>";
            } else {
                $new_password = $_POST['new_password'];
                if (strlen($new_password) < 5) {
                    echo "<script type='text/javascript'>alert('Password must be more than 5 characters ');</script>";
                }
                $confirm_password = $_POST['confirm_password'];
                if ($new_password != $confirm_password) {
                    echo "<script type='text/javascript'>alert('Confirmation password is incorrect');</script>";
                } else {
                    $result =  $db->table('users')->update(
                        $_SESSION['user_id'],
                        [
                            'password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
                        ]
                    );
                    if ($result) {
                        echo "<script type='text/javascript'>alert('update successfully');</script>";
                    }
                }
            }
        }
        $username_old = $user->username;
        if (isset($_POST['username']) && $_POST['username'] != $username_old) {
            $result =  $db->table('users')->update(
                $_SESSION['user_id'],
                [
                    'username' => $_POST['username'],
                ]
            );
            if ($result) {
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('update successfully');
                window.location.href='update_profile.php';
                </script>");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update profile</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
</head>

<body>
    <?php include 'components/header.php'; ?>
    <section class="form-container">
        <form action="" method="post">
            <h3>update profile</h3>
            <input type="hidden" name="prev_pass">
            <input type="text" name="username" required placeholder="enter your username" value="<?= $user->username ?>" class="box">
            <input type="password" id="old_password" name="old_password" placeholder="enter your old password" class="box">
            <input type="password" id="new_password" name="new_password" placeholder="enter your new password" class="box">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="confirm your new password" class="box">
            <input type="submit" value="update now" class="btn update-profile" name="submit">
        </form>
    </section>
    <?php include 'components/footer.php'; ?>
    <script src="resources/js/script.js"></script>
    <script>
    </script>
</body>

</html>