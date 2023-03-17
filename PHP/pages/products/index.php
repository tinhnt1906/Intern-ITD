<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <h1>List Products</h1>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>image</th>
                <th>Name</th>
                <th>price</th>
                <th>status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            include '../../core/database.php';
            include '../../drivers/MysqlDatabase.php';
            include '../../env.php';
            $db = new MysqlDatabase;
            $products = $db->table('products')->get();
            foreach ($products as $product) {
            ?>
                <tr>
                    <td><img src="../../<?php echo $product->image ?>" width="80" height="80"></td>
                    <td><?php echo  $product->name; ?></td>
                    <td><?php echo $product->price; ?></td>
                    <td><?php echo $product->code; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo htmlentities($product->id); ?>" class="edit" title="Edit" data-toggle="tooltip">Edit</a>
                        <a href="delete.php?id=<?php echo ($product->id); ?>" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Do you really want to Delete ?');">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</body>

</html>