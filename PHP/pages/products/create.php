<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <form action="create_process.php" method="POST" enctype="multipart/form-data">
        <h2>Add products</h2>

        <div div class="form-group">
            <div class="row">
                <div class="col"><input type="text" class="form-control" name="name" placeholder="Product Name..." required="true"></div>
            </div>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="price" placeholder="Price..." required="true">
        </div>

        <div class=" form-group">
            <input type="file" class="form-control" name="image" required="true">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Submit</button>
        </div>
    </form>
</body>

</html>