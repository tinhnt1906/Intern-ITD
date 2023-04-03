<?php
if (!isset($_SESSION)) {
    session_start();
}
$total_item = 0;
if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $total_item += 1;
    }
}
?>

<header class="header">
    <section class="flex">
        <a href="/E-commerce" class="logo">Shopie<span>.</span></a>
        <nav class="navbar">
            <a href="/E-commerce">home</a>
            <a href="about.php">about</a>
            <a href="order.php">my orders</a>
            <a href="shop.php">shop</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart "></i><span id="cart-item"></span></a>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="profile">
            <?php
            if (isset($_SESSION['user_email'])) {
            ?>
                <p><?= $_SESSION['user_email'] ?></p>
                <a href="update_profile.php" class="btn">update profile</a>
                <a href="logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>
            <?php
            } else {
            ?>
                <div class="flex-btn">
                    <a href="register.php" class="option-btn">register</a>
                    <a href="login.php" class="option-btn">login</a>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
</header>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
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