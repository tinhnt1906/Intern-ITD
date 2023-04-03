<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="keywords" content="au theme template">
    <!-- Title Page-->
    <title>Dashboard 2</title>

    <!-- Fontfaces CSS-->
    <link href="../resources/css/font-face.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../resources/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../resources/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../resources/css/theme.css" rel="stylesheet" media="all">

</head>

<?php
session_start();
include '../core/database.php';
include '../core/config.php';
include '../core/MysqlDatabase.php';
$db = new MysqlDatabase;
$orders = $db->table('orders')->getId($_GET['id']);
$order_details = $db->table('order_detail')->where(['order_id' => $_GET['id']]);
foreach ($orders as $order);
?>

<body class="animsition">
    <?php
    if (isset($_SESSION['user_email_admin']) && $_SESSION['user_role_admin'] == 'admin') {
    ?>
        <div class="page-wrapper">
            <?php include '../components/sidebar.php' ?>
            <div class="page-container2">
                <?php include '../components/header.php' ?>
                <section class="au-breadcrumb m-t-75">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="au-breadcrumb-content">
                                        <div class="au-breadcrumb-left">
                                            <span class="au-breadcrumb-span">You are here:</span>
                                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                                <li class="list-inline-item active">
                                                    <a href="index.php">Orders</a>
                                                </li>
                                                <li class="list-inline-item seprate">
                                                    <span>/</span>
                                                </li>
                                                <li class="list-inline-item">View order details</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="card">
                    <div class="card-header">
                        <span> View details order: <?= $order->id  ?></span>
                        <br />
                        <span>Date: <?= date("d-m-Y", strtotime($order->date)) ?></span>
                    </div>
                    <div class="card-body card-block">
                        <div class="table-responsive" id="order_table">
                            <table class="table table-bordered table-striped">
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
                                            <td><?= $item->product_name ?></td>
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
                        <form action="update.php" method="POST">
                            <input type="hidden" name="id" value="<?= $order->id ?>">
                            <div class="row form-group">
                                <div class="col-6">
                                    <label class="control-label mb-1">Payment ID</label>
                                    <input type="text" disabled name="name" value="<?= $order->payment_id ?>" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="control-label mb-1">Payer ID</label>
                                    <input type="text" disabled name="name" value="<?= $order->payer_id ?>" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label class="control-label mb-1">Name</label>
                                    <input type="text" disabled name="name" value="<?= $order->name ?>" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="control-label mb-1">Phone</label>
                                    <input type="text" disabled name="name" value="<?= $order->phone ?>" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label class="control-label mb-1">Payment Stauts</label>
                                    <input type="text" disabled name="name" value="<?= $order->payment_status ?>" class="form-control">
                                </div>

                                <div class="col-6">
                                    <label class="control-label mb-1">Order status</label>
                                    <select name="order_status" id="select" class="form-control">
                                        <option value="pending" <?php if ($order->order_status == 'pending') { ?> selected <?php } ?>>Peding</option>
                                        <option value="processing" <?php if ($order->order_status == 'processing') { ?> selected <?php } ?>>Processing</option>
                                        <option value="shipping" <?php if ($order->order_status == 'shipping') { ?> selected <?php } ?>>Shipping</option>
                                        <option value="completed" <?php if ($order->order_status == 'completed') { ?> selected <?php } ?>>Completed</option>
                                        <option value="decline" <?php if ($order->order_status == 'decline') { ?> selected <?php } ?>>Decline</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <label class=" form-control-label">Address</label>
                                    <textarea name="description" disabled rows="3" placeholder="description..." class="form-control"><?= $order->address ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-sm text-center">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        header('location:http://localhost/E-commerce/admin/auth/login.php');
    } ?>
    <!-- Jquery JS-->
    <script src="../resources/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../resources/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../resources/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../resources/vendor/slick/slick.min.js">
    </script>
    <script src="../resources/vendor/wow/wow.min.js"></script>
    <script src="../resources/vendor/animsition/animsition.min.js"></script>
    <script src="../resources/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../resources/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../resources/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../resources/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../resources/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../resources/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../resources/vendor/select2/select2.min.js">
    </script>
    <script src="../resources/vendor/vector-map/jquery.vmap.js"></script>
    <script src="../resources/vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="../resources/vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="../resources/vendor/vector-map/jquery.vmap.world.js"></script>
    <script src="../resources/js/main.js"></script>
</body>

</html>
<!-- end document-->