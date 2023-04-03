<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">
</head>

<body>
    <?php
    include 'core/database.php';
    include 'core/config.php';
    include 'core/MysqlDatabase.php';
    $db = new MysqlDatabase;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (strlen($_POST['password']) < 5) {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Password must be more than 5 characters');
            </script>");
        } else  if ($_POST['password'] != $_POST['confirm_password']) {
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Confirmation password is incorrect');
            </script>");
        } else {
            $users = $db->table('users')->where(['password_reset_token' => $_GET['token']]);
            foreach ($users as $user);
            $result =  $db->table('users')->update($user->id, [
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'password_reset_token' => null
            ]);
            if ($result) {
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Reset password successfullly, please login again');
                window.location.href='login.php';
                </script>");
            }
        }
    }
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $result = $db->table('users')->where(['password_reset_token' => $token]);
        if ($result) {
    ?>
    <section class="form-container">
        <form id='form' action="" method="post" onsubmit="return validateRegister(event);">
            <h3>Reset password</h3>
            <input type="password" id="password" name="password" placeholder="enter your password" class="box">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="confirm your password"
                class="box">
            <button class="btn">Reset password</button>
        </form>
    </section>
    <?php }
    } else {
        '<h1>Token do not exits</h1>';
    } ?>
    <script src="script.js"></script>
    <script src="resources/js/script.js"></script>

    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body>

</html>