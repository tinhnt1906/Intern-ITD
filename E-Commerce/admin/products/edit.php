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
$products = $db->table('products')->getId($_GET['id']);
$categories = $db->table('categories')->get();
foreach ($products as $product);
?>
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
                                                    <a href="index.php">Products</a>
                                                </li>
                                                <li class="list-inline-item seprate">
                                                    <span>/</span>
                                                </li>
                                                <li class="list-inline-item">Edit product</li>
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
                        Add product
                    </div>
                    <div class="card-body card-block">
                        <form action="update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $product->id ?>">
                            <input type="hidden" name="image_path_old" value="<?= $product->image ?>">
                            <div class="row form-group">
                                <div class="col-6">
                                    <label class="control-label mb-1">Name</label>
                                    <input type="text" name="name" placeholder="product name... " value="<?= $product->name ?>" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label class="control-label mb-1">Price</label>
                                    <input type="number" value="<?= $product->price ?>" name="price" placeholder="price..." class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="control-label mb-1">Quantity</label>
                                    <input type="number" min="1" value="<?= $product->quantity ?>" step="1" name="quantity" placeholder="quantity..." class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <label class=" form-control-label">Description</label>
                                    <textarea name="description" rows="3" placeholder="description..." class="form-control"><?= $product->description ?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <label for="select" class=" form-control-label">Category</label>
                                    <select name="category" id="select" class="form-control">
                                        <?php
                                        foreach ($categories as $category) {
                                        ?>
                                            <option value="<?php echo $category->id ?>" <?php if ($product->category_id == $category->id) { ?> selected <?php } ?>>
                                                <?php echo $category->category_name ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <label class=" form-control-label">Image</label>
                                    <div>
                                        <input type="file" name="image" accept="image/*" onchange="loadFile(event)">
                                        <img id="output" src="../<?= $product->image ?>" width=" 150" height="150" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-sm text-center">Update Product</button>
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
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
</body>

</html>
<!-- end document-->