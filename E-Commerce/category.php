<?php
include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
$db = new MysqlDatabase;
$category_id = $_GET['category'];

$products = $db->table('products')->where(['category_id' => $category_id]);

$categories = $db->table('categories')->where(['id' => $category_id]);
foreach ($categories as $category);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category</title>
    <!-- link ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">

</head>

<body>

    <?php include 'components/header.php'; ?>

    <section class="products">

        <h1 class="heading">category <?= $category->category_name ?></h1>

        <div class="box-container">
            <?php

            if ($products) {
                foreach ($products as $product) {
            ?>
            <form action="" class="box form-submit">
                <input type="hidden" class="product_id" value="<?= $product->id ?>">
                <input type="hidden" class="product_name" value="<?= $product->name ?>">
                <input type="hidden" class="product_price" value="<?= $product->price ?>">
                <input type="hidden" class="product_image" value="<?= $product->image ?>">
                <a href="product.php?id=<?= $product->id ?>"><img src="admin/<?= $product->image ?>" alt=""></a>
                <a href="product.php?id=<?= $product->id ?>">
                    <div class="name"><?= $product->name ?></div>
                </a>
                <div class="flex">
                    <div class="price"><span>$</span><?= $product->price ?><span>/-</span></div>
                    <input type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="quantity"
                        id="product_quantity" class="product_quantity" min="1" max="99" value="1">
                </div>
                <button value="add to cart" class="btn add_to_cart" name="add_to_cart">Add to
                    cart</button>
            </form>
            <?php
                }
            } else {
                echo '<p class="empty">no products found!</p>';
            }
            ?>
        </div>
    </section>
    <?php include 'components/footer.php'; ?>

    <script src="resources/js/script.js"></script>
    <script>
    $(document).ready(function() {
        load_cart_item_number();

        function load_cart_item_number() {
            $.ajax({
                url: "action.php",
                method: "get",
                data: {
                    cartItem: "cart_item",
                },
                success: function(response) {
                    $("#cart-item").html(response);
                },
            });
        }
        $(".add_to_cart").click(function(e) {
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var product_id = $form.find(".product_id").val();
            var product_name = $form.find(".product_name").val();
            var product_price = $form.find(".product_price").val();
            var product_quantity = $form.find(".product_quantity").val();
            var product_image = $form.find(".product_image").val();
            var action = "add_to_cart";
            $.ajax({
                url: "action.php",
                method: "post",
                data: {
                    product_id,
                    product_name,
                    product_price,
                    product_quantity,
                    product_image,
                    action,
                },
                success: function(response) {
                    load_cart_item_number();
                    alert("add to cart successfully");
                },
            });
        });
    });
    </script>
</body>

</html>