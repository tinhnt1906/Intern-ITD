<?php

include 'core/database.php';
include 'core/config.php';
include 'core/MysqlDatabase.php';
$db = new MysqlDatabase;
$categories = $db->table('categories')->get();
$products = $db->table('products')->get();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!-- link ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <!-- font awesome cdn link  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="resources/css/style.css">



</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="home-bg">

        <section class="home">

            <div class="swiper home-slider">

                <div class="swiper-wrapper">

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="resources/images/home-img-1.png" alt="">
                        </div>
                        <div class="content">
                            <span>upto 50% off</span>
                            <h3>latest smartphones</h3>
                            <a href="shop.php" class="btn">shop now</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="resources/images/home-img-2.png" alt="">
                        </div>
                        <div class="content">
                            <span>upto 50% off</span>
                            <h3>latest watches</h3>
                            <a href="shop.php" class="btn">shop now</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="resources/images/home-img-3.png" alt="">
                        </div>
                        <div class="content">
                            <span>upto 50% off</span>
                            <h3>latest headsets</h3>
                            <a href="shop.php" class="btn">shop now</a>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
    </div>

    <section class="category">

        <h1 class="heading">shop by category</h1>
        <div class="swiper category-slider">
            <div class="swiper-wrapper">
                <?php foreach ($categories as $category) { ?>
                    <a href="category.php?category=<?= $category->id ?>" class="swiper-slide slide">
                        <img src="admin/<?= $category->image ?>" alt="<?= $category->category_name ?>">
                        <h3><?= $category->category_name ?></h3>
                    </a>
                <?php } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </section>

    <section class="home-products">

        <h1 class="heading">latest products</h1>

        <div class="swiper products-slider">

            <div class="swiper-wrapper">
                <?php foreach ($products as $product) { ?>
                    <form action="" class="swiper-slide slide form-submit">
                        <input type="hidden" class="product_id" value="<?= $product->id ?>">
                        <input type="hidden" class="product_name" value="<?= $product->name ?>">
                        <input type="hidden" class="product_price" value="<?= $product->price ?>">
                        <input type="hidden" class="product_image" value="<?= $product->image ?>">
                        <a href="product.php?id=<?= $product->id ?>" class="fas fa-eye"></a>

                        <img src="<?= $product->image ?>" alt="">
                        <div class="name"><?= $product->name ?></div>
                        <div class="flex">
                            <div class="price"><span>$</span><?= $product->price ?><span>/-</span></div>
                            <input type="number" name="quantity" class="product_quantity" min="1" max="99" value="1">
                        </div>
                        <input type="submit" value="add to cart" class="btn add_to_cart" name="add_to_cart">
                    </form>
                <?php } ?>
            </div>

            <div class="swiper-pagination"></div>
        </div>

    </section>

    <?php include 'components/footer.php'; ?>


    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="resources/js/script.js"></script>
    <script src="script.js"></script>
    <script>
        var swiper = new Swiper(".home-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        var swiper = new Swiper(".category-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                },
                650: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
            },
        });

        var swiper = new Swiper(".products-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                550: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

    <script>
        $(document).ready(function() {
            load_cart_item_number();

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
            $(".add_to_cart").click(function(e) {
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var product_id = $form.find(".product_id").val();
                var product_name = $form.find(".product_name").val();
                var product_price = $form.find(".product_price").val();
                var product_quantity = $form.find(".product_quantity").val();
                var product_image = $form.find(".product_image").val();
                var action = "add_to_cart";
                $.ajax({
                    url: "action.php",
                    method: "post",
                    data: {
                        product_id,
                        product_name,
                        product_price,
                        product_quantity,
                        product_image,
                        action,
                    },
                    success: function(response) {
                        load_cart_item_number();
                        alert("add to cart successfully");
                    },
                });
            });
        });
    </script>
</body>

</html>