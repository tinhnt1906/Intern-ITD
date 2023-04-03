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
    <link href="../resources/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"
        media="all">
    <link href="../resources/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="../resources/vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">
    <link href="../resources/css/theme.css" rel="stylesheet" media="all">
</head>

<?php
session_start();
include '../core/database.php';
include '../core/config.php';
include '../core/MysqlDatabase.php';
$db = new MysqlDatabase;
$orders = $db->table('orders')->get();
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
                                                <a href="#">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item"><a href="index.php">Order</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <input name="search_box" class="au-input au-input--full au-input--h55" type="text"
                                    placeholder="Search for order id " />
                            </form>
                        </div>
                        <div class="col-md-12 mt-2">
                            <!-- DATA TABLE-->
                            <?php if (empty($_POST['search_box'])) { ?>
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th>Payment status</th>
                                            <th>Order status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if ($orders) {
                                                    foreach ($orders as  $order) {
                                                ?>
                                        <tr>
                                            <td><?= $order->id ?></td>
                                            <td><?= date("d-m-Y", strtotime($order->date));  ?></td>
                                            <td><?= $order->name ?></td>
                                            <td><?= $order->total_price . ' ' . $order->currency ?></td>
                                            <td><?= $order->payment_status ?></td>
                                            <td><?= $order->order_status ?></td>
                                            <td class="process">
                                                <a href="show.php?id=<?= $order->id ?>">Show Detail</a>
                                            </td>
                                        </tr>
                                        <?php
                                                    }
                                                } else {
                                                    echo 'not found';
                                                }
                                                ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } else { ?>
                            <!-- DATA SEARCH -->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th>Payment status</th>
                                            <th>Order status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                if (isset($_POST['search_box'])) {
                                                    $search_box = $_POST['search_box'];
                                                    $sql = " SELECT * FROM `orders` WHERE id LIKE '%{$search_box}%'";
                                                    $result = $db->connect->query($sql);
                                                    $rowcount = mysqli_num_rows($result);
                                                    $_POST['search_box'] =  null;
                                                    if ($rowcount > 0) {
                                                        while ($order = $result->fetch_object()) {
                                                ?>
                                        <tr>
                                            <td><?= $order->id ?></td>
                                            <td><?= date("d-m-Y", strtotime($order->date));  ?></td>
                                            <td><?= $order->name ?></td>
                                            <td><?= $order->total_price . ' ' . $order->currency ?></td>
                                            <td><?= $order->payment_status ?></td>
                                            <td><?= $order->order_status ?></td>
                                            <td class="process">
                                                <a href="show.php?id=<?= $order->id ?>">Show Detail</a>
                                            </td>
                                        </tr>
                                        <?php
                                                        }
                                                    } else {
                                                        echo '<p class="empty">no orders found!</p>';
                                                    }
                                                }
                                                ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
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

    <!-- Main JS-->
    <script src="../resources/js/main.js"></script>

</body>

</html>
<!-- end document-->