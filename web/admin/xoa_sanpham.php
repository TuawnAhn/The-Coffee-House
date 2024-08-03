<?php
session_start();
include "../dao/pdo.php";
include "../dao/sanpham.php";

// Kiểm tra quyền admin
if (!isset($_SESSION['s_user']) || !is_array($_SESSION['s_user']) || $_SESSION['s_user']['role'] != 1) {
    header('location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    sanpham_delete($id);
    header('Location: trangadmin.php?action=manage_products');
    exit();
}

header('Location: trangadmin.php?action=manage_products');
exit();
