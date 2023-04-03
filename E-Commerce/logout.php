<?php
session_start();

if (isset(($_SESSION['user_email']))) {
    unset($_SESSION['user_email']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('logout successfully');
    </script>");
    header('location:/E-commerce');
}
