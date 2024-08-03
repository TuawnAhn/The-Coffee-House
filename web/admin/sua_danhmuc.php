<?php
session_start();
include "../dao/pdo.php";
include "../dao/danhmuc.php";

// Kiểm tra quyền admin
if (!isset($_SESSION['s_user']) || !is_array($_SESSION['s_user']) || $_SESSION['s_user']['role'] != 1) {
    header('location: login.php');
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$category = danhmuc_get_by_id($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    danhmuc_update($id, $name);
    header('Location: trangadmin.php?action=manage_categories');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <titl>Sửa Danh Mục</title>
</head>

<body>
    <h2>Sửa Danh Mục</h2>
    <form method="post">
        <label for="name">Tên Danh Mục:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
        <button type="submit">Cập Nhật</button>
    </form>
</body>

</html>