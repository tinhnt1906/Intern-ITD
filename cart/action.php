<?php
session_start();
include "./core/config.php";
include "./core/database.php";
include "./core/MysqlDatabase.php";
$db = new MysqlDatabase();

if (isset($_POST["id"])) {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $image = $_POST["image"];
  $code = $_POST["code"];
  $price = $_POST["price"];
  $quantity = 1;
  $total_price = $quantity * $price;

  echo $image;
  $checkAdd = $db->table("carts")->where(["product_code" => $_POST["code"]]);
  if (!$checkAdd) {
    $db->table("carts")->insert([
      "product_image" => $image,
      "product_name" => $name,
      "product_price" => $price,
      "quantity" => $quantity,
      "total_price" => $total_price,
      "product_code" => $code,
    ]);
    echo '<div class="alert alert-success alert-dismissible mt-2">
    					  <button type="button" class="close" data-dismiss="alert">&times;</button>
    					  <strong>Item added to your cart!</strong>
    					</div>';
  } else {
    echo '<div class="alert alert-danger alert-dismissible mt-2">
    					  <button type="button" class="close" data-dismiss="alert">&times;</button>
    					  <strong>Item already added to your cart!</strong>
    					</div>';
  }
}

if (isset($_GET["cartItem"])) {
  $db->table("carts")->count();
}

if (isset($_GET["remove"])) {
  $result = $db->table("carts")->delete($_GET["remove"]);
  if ($result) {
    $_SESSION["showAlert"] = "block";
    $_SESSION["message"] = "item remove from the cart";
    header("location:cart.php");
  }
}

if (isset($_POST["quantity"])) {
  $db->table("carts")->update($_POST["id"], [
    "quantity" => $_POST["quantity"],
    "total_price" => $_POST["quantity"] * $_POST["price"],
  ]);
}