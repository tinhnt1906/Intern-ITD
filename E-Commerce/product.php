<?php
include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
$db = new MysqlDatabase;
$products = $db->table('products')->where(['id' => $_GET['id']]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product detail</title>
    <!-- link ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">

</head>

<body>

    <?php include 'components/header.php'; ?>

    <section class="quick-view">

        <h1 class="heading">quick view</h1>

        <?php
        if ($products) {
            foreach ($products as $product) {
        ?>
                <form action="" method="post" class="box form-submit">
                    <input type="hidden" class="product_id" value="<?= $product->id ?>">
                    <input type="hidden" class="product_name" value="<?= $product->name ?>">
                    <input type="hidden" class="product_price" value="<?= $product->price ?>">
                    <input type="hidden" class="product_image" value="<?= $product->image ?>">
                    <div class="row">
                        <div class="image-container">
                            <div class="main-image">
                                <img src="<?= $product->image ?>" alt="">
                            </div>
                            <div class="sub-image">
                                <img src="<?= $product->image ?> ?>" alt="">
                                <img src="<?= $product->image ?> ?>" alt="">
                                <img src="<?= $product->image ?> ?>" alt="">
                            </div>
                        </div>
                        <div class="content">
                            <div class="name"><?= $product->name ?></div>
                            <div class="flex">
                                <div class="price"><span>$</span><?= $product->price ?><span>/-</span></div>
                                <input type="number" name="product_quantity" class="product_quantity" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                            </div>
                            <div class="description"><?= $product->description  ?></div>
                            <div class="flex-btn">
                                <input type="submit" value="add to cart" class="btn add_to_cart" name="add_to_cart">
                            </div>
                        </div>
                    </div>
                </form>
        <?php
            }
        } else {
            echo '<p class="empty">Products not found!</p>';
        }
        ?>

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