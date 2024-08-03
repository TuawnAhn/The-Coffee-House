
<?php

// Hiển thị giỏ hàng
function viewcart()
{
   $html_cart = '';
   $i = 1;
   foreach ($_SESSION['giohang'] as $key => $sp) {
      extract($sp);
      $tt = (int)$price * (int)$soluong;
      $html_cart .= '
            <tr>
                <td>' . $i . '</td>
                <td><img src="layout/images/' . $img . '" alt="" style="width:100px"></td>
                <td>' . $name . '</td>
                <td>' . $price . '.000đ' . '</td>
                <td>' . $soluong . '</td>
                <td>' . $tt . '.000đ' . '</td>
                <td>
                <a href="?action=delete&key=' . $key . '"><button class="btn btn-default btn-lg" onclick="return confirm(\'Bạn có muôn xóa sản phẩm này?\')">Xoá</button></a>
                </td>
            </tr>
        ';
      $i++;
   }
   return $html_cart;
}
function viewcart_tt()
{
   $html_cart = '';
   $i = 1;
   foreach ($_SESSION['giohang'] as $sp) {
      extract($sp);
      $html_cart .= '
<tr style="text-align:center">
                <td style="text-align:center">Sản phẩm: ' . $i . '</td><br>
                <td><img src="layout/images/' . $img . '" alt="" style="width:100px"></td><br>
                <td>' . $name . '</td><br>
                <td><hr></td>
            </tr>
        ';
      $i++;
   }
   return $html_cart;
}


// Tính tổng đơn hàng
function get_tongdonhang()
{
   $tong = 0;
   foreach ($_SESSION['giohang'] as $sp) {
      extract($sp);
      $tt = (int)$price * (int)$soluong;
      $tong += $tt;
   }
   return $tong;
}


// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['key'])) {
   $key = $_GET['key'];
   if (isset($_SESSION['giohang'][$key])) {
      unset($_SESSION['giohang'][$key]);
      // Re-index lại mảng giỏ hàng
      $_SESSION['giohang'] = array_values($_SESSION['giohang']);
   }
   // Chuyển hướng lại trang giỏ hàng
   header('Location: index.php?pg=viewcart');
   exit();
}


function save_bill($madh, $iduser, $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $nguoinhan_ten, $nguoinhan_diachi, $nguoinhan_tel, $total, $ship, $voucher, $tongthanhtoan, $pttt)
{
   $conn = pdo_get_connection();
   $sql = "INSERT INTO bill (madh, iduser, nguoidat_ten, nguoidat_email, nguoidat_tel, nguoidat_diachi, nguoinhan_ten, nguoinhan_diachi, nguoinhan_tel, total, ship, voucher, tongthanhtoan, pttt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$madh, $iduser, $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $nguoinhan_ten, $nguoinhan_diachi, $nguoinhan_tel, $total, $ship, $voucher, $tongthanhtoan, $pttt]);
   return $conn->lastInsertId(); // Trả về ID của hóa đơn vừa tạo
}


function save_cart($cart, $idbill)
{
   $conn = pdo_get_connection();
   foreach ($cart as $item) {
      $thanhtien = $item['price'] * $item['soluong'];
      $sql = "INSERT INTO cart (price, name, img, soluong, thanhtien, idbill) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$item['price'], $item['name'], $item['img'], $item['soluong'], $thanhtien, $idbill]);
   }
}
function get_cart_items_by_idbill($idbill)
{
   $sql = "SELECT * FROM cart WHERE idbill = ?";
   return pdo_query($sql, $idbill);
}
