<?php
// require_once 'pdo.php';

function user_insert($username, $password, $email)
{
    $sql = "INSERT INTO user(username, password, email) VALUES (?, ?, ?)";
    pdo_execute($sql, $username, $password, $email);
}

function user_update($username, $password, $email, $diachi, $dienthoai, $role, $id)
{
    $sql = "UPDATE user SET username=?,password=?,email=?,diachi=?,dienthoai=?,role=? WHERE id=?";
    pdo_execute($sql, $username, $password, $email, $diachi, $dienthoai, $role, $id);
}

function checkuser($username, $password)
{
    $sql = "Select * from user where username=? and password=?";
    return pdo_query_one($sql, $username, $password);
}
function get_user($id)
{
    $sql = "Select * from user where id=? ";
    return pdo_query_one($sql, $id);
}
function checkadmin($uname, $psw)
{
    $conn = pdo_get_connection();
    $sql = "SELECT * FROM admin WHERE tendangnhap = :tendangnhap AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['tendangnhap' => $uname, 'password' => $psw]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
// Xóa người dùng theo ID
function user_delete($id)
{
    $sql = "DELETE FROM user WHERE id = ?";
    pdo_execute($sql, $id);
}

// Lấy thông tin người dùng theo ID
function user_get_by_id($id)
{
    $sql = "SELECT * FROM user WHERE id = ?";
    return pdo_query_one($sql, $id);
}
