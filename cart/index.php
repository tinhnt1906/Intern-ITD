<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shopping Cart System</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>



<body>

    <!-- Navbar start -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="index.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Mobile Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php"><i class="fas fa-mobile-alt mr-2"></i>Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-th-list mr-2"></i>Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navbar end -->

    <!-- Displaying Products Start -->
    <div class="container">
        <div id="message"></div>
        <div class="row mt-2 pb-3">
            <?php
            include './core/config.php';
            include './core/database.php';
            include './core/MysqlDatabase.php';
            $db = new MysqlDatabase;
            $products = $db->table('products')->get();
            foreach ($products as $product) {

            ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                    <div class="card-deck">
                        <div class="card p-2 border-secondary mb-2">
                            <img src="<?php echo $product->image ?>" class="card-img-top" height="250">
                            <div class="card-body p-1">
                                <h4 class="card-title text-center text-info"><?php echo $product->name ?></h4>
                                <h5 class="card-text text-center text-danger">Giá: <?php echo $product->price ?>
                                </h5>

                            </div>
                            <div class="card-footer p-1">
                                <form action="" class="form-submit">
                                    <!-- <div class="row p-2">
                                    <div class="col-md-6 py-1 pl-4">
                                        <b>Quantity : </b>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control pqty"
                                            value="<?php echo $product->quantity ?>">
                                    </div>
                                </div> -->
                                    <input type="hidden" class="id" value="<?php echo $product->id ?>">
                                    <input type="hidden" class="name" value="<?php echo $product->name ?>">
                                    <input type="hidden" class="price" value="<?php echo $product->price ?>">
                                    <input type="hidden" class="image" value="<?php echo $product->image ?>">
                                    <input type="hidden" class="code" value="<?php echo $product->code ?>">
                                    <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                                        cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".addItemBtn").click(function(e) {
                e.preventDefault();
                var $form = $(this).closest('.form-submit');
                var id = $form.find(".id").val();
                var name = $form.find(".name").val();
                var price = $form.find(".price").val();
                var image = $form.find(".image").val();
                var code = $form.find(".code").val();
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: {
                        id,
                        name,
                        price,
                        image,
                        code,
                    },
                    success: function(response) {
                        $('#message').html(response);
                        window.scrollTo(0, 0);
                        load_cart_item_number();
                    }
                });
            });
            load_cart_item_number();

            function load_cart_item_number() {
                $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: {
                        cartItem: "cart_item"
                    },
                    success: function(response) {
                        $("#cart-item").html(response);
                    }
                });
            }
        });
    </script>
</body>

</html>