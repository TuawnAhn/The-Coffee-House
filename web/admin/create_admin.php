<?php
include "../dao/pdo.php"; // Đường dẫn đã được điều chỉnh

// Tạo tài khoản admin mới
$tendangnhap = 'admin';
$password = 'adminpassword'; // Không mã hóa mật khẩu
$role = 1;

// Câu lệnh SQL để thêm tài khoản mới
$sql = "INSERT INTO admin (tendangnhap, password, role) VALUES (:tendangnhap, :password, :role)";

// Thực hiện câu lệnh SQL
try {
    pdo_execute($sql, ['tendangnhap' => $tendangnhap, 'password' => $password, 'role' => $role]);
    echo "Tài khoản admin đã được tạo thành công!";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
