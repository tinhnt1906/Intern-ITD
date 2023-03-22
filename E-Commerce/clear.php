<?php
session_start();
if (isset($_SESSION['shopping_cart'])) {
    unset($_SESSION['shopping_cart']);
}
