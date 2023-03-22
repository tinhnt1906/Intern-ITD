<?php

//order_process.php

session_start();

$total_price = 0;

$item_details = '';

$order_details = '
<div class="table-responsive" id="order_table">
 <table class="table table-bordered table-striped">
        <tr>  
            <th>Product Name</th>  
            <th>Quantity</th>  
            <th>Price</th>  
            <th>Total</th>  
        </tr>
';

if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $order_details .= '
  <tr>
    <td>' . $values["product_name"] . '</td>
    <td>' . $values["product_quantity"] . '</td>
    <td align="right">$ ' . $values["product_price"] . '</td>
    <td align="right">$ ' . number_format($values["product_quantity"] * $values["product_price"], 2) . '</td>
  </tr>
  ';
        $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);

        $item_details .= '- ' . $values["product_name"] . ' * ' . $values["product_quantity"] . ' = ' . $values["product_price"] * $values["product_quantity"] . '<br/>';
    }
    // $item_details = substr($item_details, 0, -2);
    $order_details .= '
 <tr>  
        <td colspan="3" align="right">Total</td>  
        <td align="right">$ ' . number_format($total_price, 2) . '</td>
    </tr>
 ';
}
$order_details .= '</table>';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!-- link ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <!-- font awesome cdn link  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">
    <style>
    .popover {
        width: 100%;
        max-width: 800px;
    }

    .require {
        border: 1px solid #FF0000;
        background-color: #cbd9ed;
    }
    </style>
</head>

<body>
    <?php

    
    ?>

    <?php include 'components/header.php' ?>
    <?php
    if (isset($_SESSION['user_email']) && $_SESSION['shopping_cart']) {
    ?>
    <div class="container">

        <br />
        <h3 align="center"><a href="#">Shopping Cart</a></h3>
        <br />
        <span id="message"></span>
        <div class="panel panel-default">
            <div class="panel-heading">Order Process</div>
            <div class="panel-body">
                <form method="post" id="order_process_form" action="process_checkout.php">
                    <div class="row">
                        <div class="col-md-7" style="border-right:1px solid #ddd;">
                            <h4 align="center">Customer Details</h4>
                            <div class="form-group">
                                <label><b>Card Holder Name <span class="text-danger">*</span></b></label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control"
                                    value="" />
                                <span id="error_customer_name" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label><b>Email Address <span class="text-danger">*</span></b></label>
                                <input type="text" name="email_address" id="email_address" class="form-control"
                                    value="" />
                                <span id="error_email_address" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label><b>Address <span class="text-danger">*</span></b></label>
                                <textarea name="customer_address" id="customer_address" class="form-control"></textarea>
                                <span id="error_customer_address" class="text-danger"></span>
                            </div>

                            <br />
                            <div align="center">
                                <input type="hidden" name="total_price" value="<?php echo $total_price; ?>" />

                                <input type="submit" name="button_action" id="button_action"
                                    class="btn btn-success btn-sm" value="Pay Now" />
                            </div>
                            <br />
                        </div>
                        <div class="col-md-5">
                            <h4 align="center">Order Details</h4>
                            <?php
                                echo $order_details;
                                ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } else {
        header('location:cart.php');
    } ?>
    <?php include 'components/footer.php' ?>
    <script src="resources/js/script.js"></script>
</body>

</html>