<?php
require_once 'pdo.php';

/**
 * Truy vấn tất cả các loại
 * @return array mảng loại truy vấn được
 * @throws PDOException lỗi truy vấn
 */
function danhmuc_all()
{
    $sql = "SELECT * FROM danhmuc ORDER BY stt DESC";
    return pdo_query($sql);
}
function showdm($dsdm)
{
    $html_dm = '';
    foreach ($dsdm as $dm) {
        extract($dm);
        $link = 'index.php?pg=sanpham&iddm=' . $id;
        $html_dm .= '<a href="' . $link . '">' . $name . '</a>';
    }
    return $html_dm;
}
function get_name_dm($id)
{
    $sql = "SELECT name FROM danhmuc WHERE id=" . $id;
    $kq = pdo_query_one($sql);
    return $kq["name"];
}

/**
 * Xóa danh mục theo ID
 * @param int $id ID của danh mục cần xóa
 * @return void
 */
function danhmuc_delete($id)
{
    $sql = "DELETE FROM danhmuc WHERE id = :id";
    pdo_execute($sql, ['id' => $id]);
}


/**
 * Cập nhật danh mục
 * @param int $id ID của danh mục
 * @param string $name Tên danh mục mới
 * @return bool Trả về true nếu thành công, false nếu không
 */
// File: dao/danhmuc.php

global $pdo;

function danhmuc_update($id, $name)
{
    global $pdo;
    try {
        if ($pdo === null) {
            $pdo = pdo_get_connection(); // Khởi tạo nếu chưa có
        }
        $stmt = $pdo->prepare("UPDATE danh_muc SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}




/**
 * Lấy thông tin danh mục theo ID
 * @param int $id ID của danh mục
 * @return array Mảng chứa thông tin danh mục
 */
function danhmuc_get_by_id($id)
{
    $sql = "SELECT * FROM danhmuc WHERE id = :id";
    return pdo_query_one($sql, ['id' => $id]);
}
