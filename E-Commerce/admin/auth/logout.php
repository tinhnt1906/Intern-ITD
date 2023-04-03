<?php
session_start();
if (isset($_SESSION['user_email_admin']) && $_SESSION['user_role_admin'] == 'admin') {
    unset($_SESSION['user_email_admin']);
    unset($_SESSION['user_role_admin']);
    header('location:login.php');
}
