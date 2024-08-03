<?php
session_start();
ob_start();
include "../dao/pdo.php";
include "../dao/danhmuc.php";
include "../dao/sanpham.php";
include "../dao/user.php";

// Kiểm tra quyền admin
if (!isset($_SESSION['s_user']) || !is_array($_SESSION['s_user']) || $_SESSION['s_user']['role'] != 1) {
    header('Location: login.php');
    exit();
}

$admin = $_SESSION['s_user'];

// Xử lý yêu cầu của admin
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Xử lý yêu cầu xóa
if ($action == 'delete_category' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (danhmuc_delete($id)) {
        header('Location: trangadmin.php?action=manage_categories');
    } else {
        echo 'Error deleting category.';
    }
    exit();
}

if ($action == 'delete_product' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (sanpham_delete($id)) {
        header('Location: trangadmin.php?action=manage_products');
    } else {
        echo 'Error deleting product.';
    }
    exit();
}

if ($action == 'delete_user' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (user_delete($id)) {
        header('Location: trangadmin.php?action=manage_users');
    } else {
        echo 'Error deleting user.';
    }
    exit();
}

// Xử lý yêu cầu sửa
if ($action == 'edit_category' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = danhmuc_get_by_id($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        if (danhmuc_update($id, $name)) {
            header('Location: trangadmin.php?action=manage_categories');
            exit();
        } else {
            echo 'Lỗi';
        }
    }
}

if ($action == 'edit_product' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = sanpham_get_by_id($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        if (sanpham_update($id, $name, $price)) {
            header('Location: trangadmin.php?action=manage_products');
        } else {
            echo 'Error updating product.';
        }
        exit();
    }
}

if ($action == 'edit_user' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = user_get_by_id($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        if (user_update($id, $username, $email, $role)) {
            header('Location: trangadmin.php?action=manage_users');
        } else {
            echo 'Error updating user.';
        }
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        .nav {
            display: flex;
            justify-content: center;
            background-color: #f1f1f1;
            padding: 10px 0;
        }

        .nav a {
            padding: 14px 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .nav a:hover {
            background-color: #ddd;
        }

        .content {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .btn-danger {
            background-color: #f44336;
        }

        .btn-danger:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <header>
        <h1>Trang quản lý của Admin</h1>
    </header>

    <div class="nav">
        <a href="trangadmin.php">Trang Chủ</a>
        <a href="trangadmin.php?action=manage_categories">Quản lý Danh Mục</a>
        <a href="trangadmin.php?action=manage_products">Quản lý Sản Phẩm</a>
        <a href="trangadmin.php?action=manage_users">Quản lý Người Dùng</a>
        <a href="login.php" class="btn btn-danger">Đăng Xuất</a>
    </div>

    <div class="container">
        <div class="content">
            <?php
            switch ($action) {
                case 'manage_categories':
                    $categories = danhmuc_all();
                    echo '<h2>Quản lý Danh Mục</h2>';
                    echo '<table><tr><th>ID</th><th>Tên Danh Mục</th><th>Thao Tác</th></tr>';
                    foreach ($categories as $category) {
                        echo '<tr>
                                <td>' . htmlspecialchars($category['id']) . '</td>
                                <td>' . htmlspecialchars($category['name']) . '</td>
                                <td><a href="trangadmin.php?action=edit_category&id=' . htmlspecialchars($category['id']) . '" class="btn">Sửa</a>
                                    <a href="trangadmin.php?action=delete_category&id=' . htmlspecialchars($category['id']) . '" class="btn btn-danger">Xóa</a></td>
                              </tr>';
                    }
                    echo '</table>';
                    break;

                case 'manage_products':
                    $products = get_dssp_new(10); // Hiển thị 10 sản phẩm mới nhất
                    echo '<h2>Quản lý Sản Phẩm</h2>';
                    echo '<table><tr><th>ID</th><th>Tên Sản Phẩm</th><th>Giá</th><th>Thao Tác</th></tr>';
                    foreach ($products as $product) {
                        echo '<tr>
                                <td>' . htmlspecialchars($product['id']) . '</td>
                                <td>' . htmlspecialchars($product['name']) . '</td>
                                <td>' . htmlspecialchars($product['price']) . '.000đ</td>
                                <td><a href="trangadmin.php?action=edit_product&id=' . htmlspecialchars($product['id']) . '" class="btn">Sửa</a>
                                    <a href="trangadmin.php?action=delete_product&id=' . htmlspecialchars($product['id']) . '" class="btn btn-danger">Xóa</a></td>
                              </tr>';
                    }
                    echo '</table>';
                    break;

                case 'manage_users':
                    $users = pdo_query("SELECT * FROM user");
                    echo '<h2>Quản lý Người Dùng</h2>';
                    echo '<table><tr><th>ID</th><th>Tên Đăng Nhập</th><th>Email</th><th>Vai Trò</th><th>Thao Tác</th></tr>';
                    foreach ($users as $user) {
                        echo '<tr>
                                <td>' . htmlspecialchars($user['id']) . '</td>
                                <td>' . htmlspecialchars($user['username']) . '</td>
                                <td>' . htmlspecialchars($user['email']) . '</td>
                                <td>' . ($user['role'] == 1 ? 'Admin' : 'Người Dùng') . '</td>
                                <td><a href="trangadmin.php?action=edit_user&id=' . htmlspecialchars($user['id']) . '" class="btn">Sửa</a>
                                    <a href="trangadmin.php?action=delete_user&id=' . htmlspecialchars($user['id']) . '" class="btn btn-danger">Xóa</a></td>
                              </tr>';
                    }
                    echo '</table>';
                    break;

                default:
                    echo '<h2>Chào mừng bạn đến với trang quản trị!</h2>';
                    break;
            }

            // Form chỉnh sửa danh mục
            if ($action == 'edit_category' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $category = danhmuc_get_by_id($id);
                if ($category) {
            ?>
                    <h2>Sửa Danh Mục</h2>
                    <form method="POST" action="trangadmin.php?action=edit_category&id=<?php echo htmlspecialchars($id); ?>">
                        <label for="name">Tên Danh Mục:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                        <input type="submit" value="Cập Nhật">
                    </form>

                <?php
                } else {
                    echo 'Danh mục không tồn tại.';
                }
            }

            // Form chỉnh sửa sản phẩm
            if ($action == 'edit_product' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $product = sanpham_get_by_id($id);
                if ($product) {
                ?>
                    <h2>Sửa Sản Phẩm</h2>
                    <form method="POST" action="trangadmin.php?action=edit_product&id=<?php echo htmlspecialchars($id); ?>">
                        <label for="name">Tên Sản Phẩm:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        <label for="price">Giá:</label>
                        <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                        <input type="submit" value="Cập Nhật">
                    </form>
                <?php
                } else {
                    echo 'Sản phẩm không tồn tại.';
                }
            }

            // Form chỉnh sửa người dùng
            if ($action == 'edit_user' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $user = user_get_by_id($id);
                if ($user) {
                ?>
                    <h2>Sửa Người Dùng</h2>
                    <form method="POST" action="trangadmin.php?action=edit_user&id=<?php echo htmlspecialchars($id); ?>">
                        <label for="username">Tên Đăng Nhập:</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        <label for="role">Vai Trò:</label>
                        <select id="role" name="role">
                            <option value="1" <?php echo ($user['role'] == 1) ? 'selected' : ''; ?>>Admin</option>
                            <option value="0" <?php echo ($user['role'] == 0) ? 'selected' : ''; ?>>Người Dùng</option>
                        </select>
                        <input type="submit" value="Cập Nhật">
                    </form>
            <?php
                } else {
                    echo 'Người dùng không tồn tại.';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>