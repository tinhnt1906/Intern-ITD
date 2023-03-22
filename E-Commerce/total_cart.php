<?php

$total_item = 0;
if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $total_item += 1;
    }
    echo $total_item;
}
