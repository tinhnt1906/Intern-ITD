<?php
session_start();
$total_price = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>
    <!-- link ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">

</head>

<body>

    <?php include 'components/header.php'; ?>

    <section class="products shopping-cart">
        <h3 class="heading">shopping cart</h3>

        <div class="box-container" id="cart-detail">

        </div>

        <div class="cart-total" id="cart-total">

        </div>

    </section>
    <?php include 'components/footer.php'; ?>

    <script src="resources/js/script.js"></script>
    <script>
        $(document).ready(function() {
            load_cart_data();

            function load_cart_data() {
                $.ajax({
                    url: "fetch_cart.php",
                    method: "POST",
                    dataType: "json",
                    success: function(response) {
                        $('#cart-detail').html(response.cart_detail);
                        $('#cart-total').html(response.cart_total);
                    }
                })
            }

            $(document).on('change keyup', '#change_quantity', function(e) {
                e.preventDefault();
                this.value = this.value.replace(/[^0-9]/g, '');
                var $form = $(this).closest(".form-submit");
                var product_id = $form.find(".product_id").val();
                var product_quantity = $form.find(".product_quantity").val();
                var action = 'change_quantity';
                $.ajax({
                    url: "action.php",
                    method: "post",
                    data: {
                        product_id,
                        product_quantity,
                        action,
                    },
                    success: function(response) {
                        load_cart_data();
                    },
                });
            });

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

            $(document).on('click', '#clear-all-cart', function() {
                var action = "clear-all-cart";

                $.ajax({
                    url: "action.php",
                    method: "post",
                    data: {
                        action,
                    },
                    success: function(response) {
                        alert('remove carts successfully');
                        load_cart_item_number();
                        load_cart_data();
                    },
                });
            });

            $(document).on('click', '.remove-cart', function(e) {
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var product_id = $form.find(".product_id").val();
                var action = "remove";
                console.log(product_id);
                console.log(action);
                $.ajax({
                    url: "action.php",
                    method: "post",
                    data: {
                        product_id,
                        action,
                    },
                    success: function(response) {
                        alert('remove cart item successfully');
                        load_cart_item_number();
                        load_cart_data();
                    },
                });
            });

        });
    </script>
</body>

</html>