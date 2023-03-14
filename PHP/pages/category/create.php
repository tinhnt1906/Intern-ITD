<?php session_start() ?>
<?php if (isset($_SESSION['email'])) { ?>

    <form action="process_create.php" method="post">
        <div>
            <input type="text" name="name" placeholder="Tên Danh Mục">
        </div>
        <div>
            <input type="text" name="description" placeholder="Mô Tả">
        </div>
        <button>Thêm</button>
    </form>
<?php } else {
    header('location: http://localhost/PHP/');
} ?>