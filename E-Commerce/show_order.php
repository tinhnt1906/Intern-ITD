<?php
session_start();
include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
$db = new MysqlDatabase;
$orders = $db->table('orders')->getId($_GET['id']);
$order_details = $db->table('order_detail')->where(['order_id' => $_GET['id']]);
foreach ($orders as $order);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order</title>
    <!-- link ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">

</head>

<body>
    <?php include 'components/header.php'; ?>
    <div class="container" style="
    font-size: 15px;
">
        <h1 class="text-center">order: <?= $_GET['id'] ?></h1>
        <div class="page-wrapper">
            <div class="page-container2">
                <div class="card">
                    <div class="card-body card-block">
                        <div class="table-responsive" id="order_table">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>

                                    <?php
                                    $total_price = 0;
                                    foreach ($order_details as  $item) {
                                    ?>
                                    <tr>
                                        <td><a
                                                href="product.php?id=<?= $item->product_id ?>"><?= $item->product_name ?></a>
                                        </td>
                                        <td><?= $item->quantity ?></td>
                                        <td align="right">$<?= $item->price ?></td>
                                        <td align="right">$<?= $item->price * $item->quantity ?></td>
                                    </tr>
                                    <?php
                                        $total_price += $item->price * $item->quantity;
                                    } ?>
                                    <tr>
                                        <td colspan="3" align="right">Total</td>
                                        <td align="right">$ <?= $total_price ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="font-size: 20px;">
                            <input type="hidden" name="id" value="<?= $order->id ?>">
                            <div class="row form-group">
                                <div class="col-6">
                                    <label class="control-label mb-1">Payment ID</label>
                                    <input type="text" disabled name="name" value="<?= $order->payment_id ?>"
                                        class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="control-label mb-1">Payer ID</label>
                                    <input type="text" disabled name="name" value="<?= $order->payer_id ?>"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label class="control-label mb-1">Name</label>
                                    <input type="text" disabled name="name" value="<?= $order->name ?>"
                                        class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="control-label mb-1">Phone</label>
                                    <input type="text" disabled name="name" value="<?= $order->phone ?>"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label class="control-label mb-1">Payment Stauts</label>
                                    <input type="text" disabled name="name" value="<?= $order->payment_status ?>"
                                        class="form-control">
                                </div>

                                <div class="col-6">
                                    <label class="control-label mb-1">Order status</label>
                                    <input type="text" class="form-control" disabled
                                        value="<?= $order->order_status ?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <label class=" form-control-label">Address</label>
                                    <textarea name="description" disabled rows="3"
                                        class="form-control"><?= $order->address ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="order.php" class="btn btn-primary btn-sm text-center">back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="resources/js/script.js"></script>
</body>

</html>