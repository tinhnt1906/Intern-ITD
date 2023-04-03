<?php
session_start();
include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
$db = new MysqlDatabase;
if (isset($_SESSION['user_id'])) {
    $orders = $db->table('orders')->where(['user_id' => $_SESSION['user_id']]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- link ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">

</head>

<body>
    <?php include 'components/header.php'; ?>
    <div class="container" style="font-size: 15px;">
        <?php if (isset($_SESSION['user_id'])) { ?>
            <h1 class="text-center">order history</h1>
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Payment status</th>
                                            <th>Order status</th>
                                            <th>View detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($orders) {
                                            foreach ($orders as  $order) {
                                        ?>
                                                <tr>
                                                    <td><?= $order->id ?></td>
                                                    <td><?= date("d-m-Y H:i:s", strtotime($order->date));  ?></td>
                                                    <td><?= $order->total_price . ' ' . $order->currency ?></td>
                                                    <td><?= $order->payment_status ?></td>
                                                    <td><?= $order->order_status ?></td>
                                                    <td class="process">
                                                        <a href="show_order.php?id=<?= $order->id ?>">Show Detail</a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
            echo '<p class="empty">Please <a href="login.php">login</a> to view your order</p>';
        } ?>
    </div>
    <script src="resources/js/script.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>