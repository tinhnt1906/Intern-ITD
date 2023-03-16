<?php
//index.php

?>
<!DOCTYPE html>
<html>

<head>
    <title>PHP Shopping Cart with Stripe Payment Integration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
    .popover {
        width: 100%;
        max-width: 800px;
    }
    </style>
</head>

<body>
    <div class="container">
        <br />
        <h3 align="center"><a href="#">PHP Shopping Cart with Stripe Payment Integration</a></h3>
        <br />
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                        <span class="sr-only">Menu</span>
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                    </button>
                    <a class="navbar-brand" href="/">Webslesson</a>
                </div>
                <div id="navbar-cart" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                <span class="badge"></span>
                                <span class="total_price"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="popover_content_wrapper" style="display: none">
            <span id="cart_details"></span>
            <div align="right">
                <a href="order_process.php" class="btn btn-primary" id="check_out_cart">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Check out
                </a>
                <a href="#" class="btn btn-default" id="clear_cart">
                    <span class="glyphicon glyphicon-trash"></span> Clear
                </a>
            </div>
        </div>

        <div id="display_item" class="row">

        </div>


        <br />
        <br />
    </div>
    </div>
</body>

</html>

<script>
$(document).ready(function() {

    load_product();

    load_cart_data();

    function load_product() {
        $.ajax({
            url: "fetch_item.php",
            method: "POST",
            success: function(data) {
                $('#display_item').html(data);
            }
        })
    }

    function load_cart_data() {
        $.ajax({
            url: "fetch_cart.php",
            method: "POST",
            dataType: "json",
            success: function(data) {
                $('#cart_details').html(data.cart_details);
                $('.total_price').text(data.total_price);
                $('.badge').text(data.total_item);
            }
        })
    }

    $('#cart-popover').popover({
        html: true,
        container: 'body',
        content: function() {
            return $('#popover_content_wrapper').html();
        }
    });

    $(document).on('click', '.add_to_cart', function() {
        var product_id = $(this).attr('id');
        var product_name = $('#name' + product_id + '').val();
        var product_price = $('#price' + product_id + '').val();
        var product_quantity = $('#quantity' + product_id).val();
        var action = 'add';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                product_id,
                product_name,
                product_price,
                product_quantity,
                action
            },
            success: function(data) {
                load_cart_data();
                alert("Item has been Added into Cart");
            }
        })
    });

    $(document).on('click', '.remove-cart', function() {
        var product_id = $(this).attr('id');
        var action = 'remove';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                product_id,
                action
            },
            success: function(data) {
                load_cart_data();
                $('#cart-popover').popover('hide');
                console.log(data);
            }
        })
    });

    $(document).on('click', '#clear_cart', function() {
        var action = 'remove-cart-all';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                action
            },
            success: function(data) {
                load_cart_data();
            }
        })
    });
});
</script>