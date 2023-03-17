<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Update product</title>
</head>
<?php

include '../../core/database.php';
include '../../drivers/MysqlDatabase.php';
include '../../env.php';
$db = new MysqlDatabase;
$products = $db->table('products')->getId($_GET['id']);
foreach ($products as $product)
?>

<body>
    <form action="edit_process.php" method="POST" enctype="multipart/form-data">
        <h2>Update products</h2>
        <input name="id" type="hidden" value="<?php echo $product->id ?>">

        <div div class="form-group">
            <div class="row">
                <div class="col"><input type="text" class="form-control" name="name"
                        value="<?php echo $product->name  ?>"></div>
            </div>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="price" value="<?php echo $product->price  ?>">
        </div>

        <div class=" form-group">
            <input type="file" class="form-control" name="image">
            <!-- <img width="50" height="50" src="../../<?php echo $product->image ?>" alt=""> -->
            <input name="image_path_old" type="hidden" value="<?php echo $product->image ?>">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Submit</button>
        </div>
    </form>
</body>

</html>