<?php
require_once 'pdo.php';
function get_dssp_new($limi)
{
    $sql = "SELECT * FROM sanpham ORDER BY id DESC limit " . $limi;
    return pdo_query($sql);
}
function get_dssp_best($limi)
{
    $sql = "SELECT * FROM sanpham WHERE bestseller=1 ORDER BY id DESC limit " . $limi;
    return pdo_query($sql);
}
function get_dssp_view($limi)
{
    $sql = "SELECT * FROM sanpham ORDER BY view DESC limit " . $limi;
    return pdo_query($sql);
}

function get_dssp($kyw, $iddm, $limi)
{
    $sql = "SELECT * FROM sanpham WHERE 1";
    if ($iddm > 0) {
        $sql .= " AND iddm=" . $iddm;
    }
    if ($kyw != "") {
        $sql .= " AND name like '%" . $kyw . "%'";
    }

    $sql .= " ORDER BY id DESC limit " . $limi;
    return pdo_query($sql);
}

function get_sanphamchitiet($id)
{
    $sql = "SELECT * FROM sanpham WHERE id=?";
    return pdo_query_one($sql, $id);
}

function get_dssp_lienquan($iddm, $id, $limi)
{
    $sql = "SELECT * FROM sanpham WHERE iddm=? AND id<>? ORDER BY id DESC limit " . $limi;
    return pdo_query($sql, $iddm, $id);
}

function get_iddm($id)
{
    $sql = "SELECT iddm FROM sanpham WHERE id=?";
    return pdo_query_value($sql, $id);
}

function showsp($dssp)
{
    $html_dssp = '';
    foreach ($dssp as $sp) {
        extract($sp);
        if ($bestseller == 1) {
            $best = '<div class="best"></div>';
        } else {
            $best = '';
        }
        $html_dssp .= '<div class="box25 mr15">
                            ' . $best . '
                            <a href="index.php?pg=sanphamchitiet&id=' . $id . '">
                                <img src="layout/images/' . $img . '" alt="">
                            </a>
                            <div style="text-align:center">
                            <span class="name" style="font-weight:bold; font-size: 13pt">' . $name . '</span>
                            </div>
                            
                            <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">' . $price .  '.000' . ' đ</span>
                            <form action="index.php?pg=addcart" method="post">
                                <input type="hidden" name="name" value="' . $name . '">
                                <input type="hidden" name="img" value="' . $img . '">
                                <input type="hidden" name="price" value="' . $price . '">
                                <input type="hidden" name="soluong" value="1">
                                <button type="submit" name="addcart">Đặt hàng</button>
                            </form>
                            
                        </div>';
    }
    return $html_dssp;
}
function showsp_lienquan($dssp_lienquan)
{
    $html_dssp_lienquan = '';
    foreach ($dssp_lienquan as $sp) {
        extract($sp);
        $html_dssp_lienquan .= '<div class="box25 mr15">
                                    <a href="index.php?pg=sanphamchitiet&id=' . $id . '">
                                        <img src="layout/images/' . $img . '" alt="">
                                    </a>
                                    <div style="text-align:center">
                                    <span class="name" style="font-weight:bold; font-size: 13pt">' . $name . '</span>
                                    </div>
                                    <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">' . $price .  '.000' . ' đ</span>
                                    <form action="index.php?pg=addcart" method="post">
                                        <input type="hidden" name="name" value="' . $name . '">
                                        <input type="hidden" name="img" value="' . $img . '">
                                        <input type="hidden" name="price" value="' . $price . '">
                                        <input type="hidden" name="soluong" value="1">
                                        <button type="submit" name="addcart">Đặt hàng</button>
                                    </form>
                                </div>';
    }
    return $html_dssp_lienquan;
}

/**
 * Xóa sản phẩm theo ID
 * @param int $id ID của sản phẩm cần xóa
 * @return void
 */
function sanpham_delete($id)
{
    $sql = "DELETE FROM sanpham WHERE id = :id";
    pdo_execute($sql, ['id' => $id]);
}

/**
 * Cập nhật sản phẩm
 * @param int $id ID của sản phẩm cần cập nhật
 * @param string $name Tên mới của sản phẩm
 * @param float $price Giá mới của sản phẩm
 * @return void
 */
function sanpham_update($id, $name, $price)
{
    $sql = "UPDATE sanpham SET name = :name, price = :price WHERE id = :id";
    pdo_execute($sql, ['id' => $id, 'name' => $name, 'price' => $price]);
}

/**
 * Lấy thông tin sản phẩm theo ID
 * @param int $id ID của sản phẩm
 * @return array Mảng chứa thông tin sản phẩm
 */
function sanpham_get_by_id($id)
{
    $sql = "SELECT * FROM sanpham WHERE id = :id";
    return pdo_query_one($sql, ['id' => $id]);
}
