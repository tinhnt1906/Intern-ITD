<?php
session_start();
include "./core/config.php";
include "./core/database.php";
include "./core/MysqlDatabase.php";
$db = new MysqlDatabase();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cart</title>
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Mobile Store</a>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
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
                    <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item"
                            class="badge badge-danger"></span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div style="display:<?php
                if (isset($_SESSION["showAlert"])) {
                  echo $_SESSION["showAlert"];
                } else {
                  echo "none";
                }
                unset($_SESSION["showAlert"]);
                ?>" class="alert alert-success alert-dismissible mt-3">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php
                    if (isset($_SESSION["message"])) {
                      echo $_SESSION["message"];
                    }
                    unset($_SESSION["showAlert"]);
                    ?></strong>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <td colspan="7">
                                    <h4 class="text-center text-info m-0">Products in your cart!</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>
                                    <a href="action.php?clear=all" class="badge-danger badge p-1"
                                        onclick="return confirm('Are you sure want to clear your cart?');"><i
                                            class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $carts = $db->table("carts")->get();
                            $grand_total = 0;
                            foreach ($carts as $cart) { ?>
                            <tr>
                                <td><?= $cart->id ?></td>
                                <input type="hidden" class="id" value="<?= $cart->id ?>">
                                <td><img src="<?= $cart->product_image ?>" width="50"></td>
                                <td><?= $cart->product_name ?></td>
                                <td>
                                    <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format(
                                      $cart->product_price,
                                      2
                                    ) ?>
                                </td>
                                <input type="hidden" class="price" value="<?= $cart->product_price ?>">
                                <td>
                                    <input type="number" class="form-control quantity" value="<?= $cart->quantity ?>"
                                        style="width:75px;">
                                </td>
                                <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;
                                    <?= number_format($cart->total_price, 2) ?>
                                </td>
                                <td>
                                    <a href="action.php?remove=<?= $cart->id ?>" class="text-danger lead"
                                        onclick="return confirm('Are you sure want to remove this item?');"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php $grand_total += $cart->total_price;}
                            ?>
                            <tr>
                                <td colspan="3">
                                    <a href="index.php" class="btn btn-success"><i
                                            class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                                        Shopping</a>
                                </td>
                                <td colspan="2"><b>Grand Total</b></td>
                                <td><b><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format(
                                  $grand_total,
                                  2
                                ) ?></b>
                                </td>
                                <td>
                                    <a href="checkout.php" class="btn btn-info <?= $grand_total >
                                    1
                                      ? ""
                                      : "disabled" ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp; </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $(".quantity").on('change', function() {
            var $el = $(this).closest('tr');

            var id = $el.find(".id").val();
            var price = $el.find(".price").val();
            var quantity = $el.find(".quantity").val();
            location.reload(true);
            $.ajax({
                url: 'action.php',
                method: 'post',
                cache: false,
                data: {
                    quantity,
                    id,
                    price
                },
                success: function(response) {
                    console.log(response);
                    console.log(quantity);
                }
            })
        });
    });
    </script>
</body>

</html>