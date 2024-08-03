<?php
session_start();
include "../dao/pdo.php";
include "../dao/sanpham.php";

// Kiểm tra quyền admin
if (!isset($_SESSION['s_user']) || !is_array($_SESSION['s_user']) || $_SESSION['s_user']['role'] != 1) {
    header('location: login.php');
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = sanpham_get_by_id($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    sanpham_update($id, $name, $price);
    header('Location: trangadmin.php?action=manage_products');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
</head>

<body>
    <h2>Sửa Sản Phẩm</h2>
    <form method="post">
        <label for="name">Tên Sản Phẩm:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        <label for="price">Giá:</label>
        <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        <button type="submit">Cập Nhật</button>
    </form>
</body>

</html>