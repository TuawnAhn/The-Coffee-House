<?php
session_start();
ob_start();
if (!isset($_SESSION["giohang"])) {
    $_SESSION["giohang"] = [];
}
//kết nối csdl
include "dao/pdo.php";
include "dao/user.php";
include "dao/danhmuc.php";
include "dao/sanpham.php";
include "dao/giohang.php";

include "view/header.php";

//data dành cho trang chủ
$dssp_new = get_dssp_new(4);
$dssp_best = get_dssp_best(2);
$dssp_view = get_dssp_view(4);


if (!isset($_GET['pg'])) {

    include "view/home.php";
} else {
    switch ($_GET['pg']) {
        case 'sanpham':
            $dsdm = danhmuc_all();

            $kyw = "";
            $titlepage = "";

            if (!isset($_GET['iddm'])) {
                $iddm = 0;
            } else {
                $iddm = $_GET['iddm'];
                $titlepage = get_name_dm($iddm);
            }

            // kiểm tra có phải form search không?
            if (isset($_POST["timkiem"]) && ($_POST["timkiem"])) {
                $kyw = $_POST["kyw"];
                $titlepage = "Kết quả tìm kiếm với từ khóa: <span>" . $kyw . "</span>";
            }

            $dssp = get_dssp($kyw, $iddm, 12);

            include "view/sanpham.php";
            break;
        case 'sanphamchitiet':
            $dsdm = danhmuc_all();
            if (isset($_GET["id"]) && ($_GET["id"] > 0)) {
                $id = $_GET["id"];
                $iddm = get_iddm($id);
                $dssp_lienquan = get_dssp_lienquan($iddm, $id, 4);
                $spchitiet = get_sanphamchitiet($id);
                include "view/sanphamchitiet.php";
            } else {
                include "view/home.php";
            }



            break;
        case 'addcart':
            if (isset($_POST["addcart"])) {
                $name = $_POST["name"];
                $img = $_POST["img"];
                $price = $_POST["price"];
                $soluong = $_POST["soluong"];
                $sp = array("name" => $name, "img" => $img, "price" => $price, "soluong" => $soluong);
                array_push($_SESSION["giohang"], $sp);
                header('location: index.php?pg=viewcart');
            }

            // include "view/gioithieu.php"; 
            break;
        case 'viewcart':
            if (isset($_GET['del']) && ($_GET['del'] == 1)) {
                unset($_SESSION["giohang"]);
                // $_SESSION["giohang"]=[];
                header('location: index.php');
            } else {
                $tongdonhang = 0;
                $giatrivoucher = 0;
                if (isset($_SESSION["giohang"])) {
                    $tongdonhang = get_tongdonhang();
                }
                if (isset($_GET['voucher']) && ($_GET['voucher'] == 1)) {
                    $tongdonhang = $_POST['tongdonhang'];
                    $mavoucher = $_POST['mavoucher'];

                    if ($mavoucher == 'anhntph') {
                        $giatrivoucher = 50;
                    }
                }
                $thanhtoan = $tongdonhang - $giatrivoucher;
                include "view/viewcart.php";
            }

            break;

        case 'login':
            // input
            if (isset($_POST["dangnhap"]) && ($_POST["dangnhap"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];

                //xl: kiem tra
                $kq = checkuser($username, $password);
                if (is_array($kq) && (count($kq))) {
                    $_SESSION['s_user'] = $kq;
                    header('location: index.php');
                } else {
                    $tb = "Tài khoản không tồn tại hoặc thông tin đăng nhập sai! ";
                    $_SESSION['tb_dangnhap'] = $tb;
                    header('location: index.php?pg=dangnhap');
                }


                //out

            }
            break;
        case 'dangnhap':

            include "view/dangnhap.php";
            break;
        case 'myaccount':
            if (isset($_SESSION['s_user']) && (count($_SESSION['s_user']) > 0)) {

                include "view/myaccount.php";
            }

            break;
        case 'logout':
            if (isset($_SESSION['s_user']) && (count($_SESSION['s_user']) > 0)) {
                unset($_SESSION['s_user']);
            }
            header('location: index.php');
            break;
        case 'adduser':
            // xác định giá trị input
            if (isset($_POST["dangky"]) && ($_POST["dangky"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $email = $_POST["email"];
                // xử lý
                user_insert($username, $password, $email);
            }

            // 
            include "view/dangnhap.php";
            break;
        case 'updateuser':
            // xác định giá trị input
            if (isset($_POST["capnhat"]) && ($_POST["capnhat"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $email = $_POST["email"];
                $diachi = $_POST["diachi"];
                $dienthoai = $_POST["dienthoai"];
                $id = $_POST["id"];
                $role = 0;
                // xử lý
                user_update($username, $password, $email, $diachi, $dienthoai, $role, $id);
                include "view/myaccount_confirm.php";
            }

            // 

            break;
        case 'dangky':
            include "view/dangky.php";
            break;
        case 'gioithieu':
            include "view/gioithieu.php";
            break;
        case 'donhang':
            include "view/donhang.php";
            break;
        case 'donhangconfirm':
            include "view/donhangconfirm.php";
            break;
        case 'donhangbill':
            if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                // Thông tin người dùng và đơn hàng
                $madh = "DH" . date("YmdHis"); // Tạo mã đơn hàng mới
                $iduser = isset($_SESSION['s_user']['id']) ? $_SESSION['s_user']['id'] : 0; // ID của người dùng đã đăng nhập
                $nguoidat_ten = isset($_POST['nguoidat_ten']) ? $_POST['nguoidat_ten'] : '';
                $nguoidat_email = isset($_POST['nguoidat_email']) ? $_POST['nguoidat_email'] : '';
                $nguoidat_tel = isset($_POST['nguoidat_tel']) ? $_POST['nguoidat_tel'] : '';
                $nguoidat_diachi = isset($_POST['nguoidat_diachi']) ? $_POST['nguoidat_diachi'] : '';
                $nguoinhan_ten = isset($_POST['nguoinhan_ten']) ? $_POST['nguoinhan_ten'] : '';
                $nguoinhan_diachi = isset($_POST['nguoinhan_diachi']) ? $_POST['nguoinhan_diachi'] : '';
                $nguoinhan_tel = isset($_POST['nguoinhan_tel']) ? $_POST['nguoinhan_tel'] : '';
                $total = isset($_POST['total']) ? $_POST['total'] : 0;
                $ship = isset($_POST['ship']) ? $_POST['ship'] : 0; // Ví dụ: Phí ship
                $voucher = isset($_POST['voucher']) ? $_POST['voucher'] : 0; // Ví dụ: Giá trị voucher
                $tongthanhtoan = isset($_POST['tongthanhtoan']) ? $_POST['tongthanhtoan'] : 0; // Tính tổng thanh toán
                $pttt = isset($_POST['pttt']) ? $_POST['pttt'] : 0; // Phương thức thanh toán, 0: COD, 1: ck, 2: ví điện tử

                // Lưu thông tin hóa đơn vào bảng bill
                $idbill = save_bill($madh, $iduser, $nguoidat_ten, $nguoidat_email, $nguoidat_tel, $nguoidat_diachi, $nguoinhan_ten, $nguoinhan_diachi, $nguoinhan_tel, $total, $ship, $voucher, $tongthanhtoan, $pttt);

                // Lưu thông tin giỏ hàng vào bảng cart
                save_cart($_SESSION['giohang'], $idbill);

                // Xóa giỏ hàng sau khi đặt hàng thành công
                unset($_SESSION['giohang']);

                // Chuyển hướng đến trang xác nhận đơn hàng
                header('Location: index.php?pg=donhangconfirm');
                exit();
            } else {
                header('Location: index.php');
                exit();
            }
            break;


        case 'edit_user':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $user = user_get_by_id($id);
                if ($user) {
                    echo '<h2>Sửa Người Dùng</h2>';
                    echo '<form method="post">
                                <label for="username">Tên Đăng Nhập:</label>
                                <input type="text" id="username" name="username" value="' . htmlspecialchars($user['username']) . '" required>
                                <br>
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="' . htmlspecialchars($user['email']) . '" required>
                                <br>
                                <label for="role">Vai Trò:</label>
                                <select id="role" name="role">
                                    <option value="1"' . ($user['role'] == 1 ? ' selected' : '') . '>Admin</option>
                                    <option value="0"' . ($user['role'] == 0 ? ' selected' : '') . '>Người Dùng</option>
                                </select>
                                <br>
                                <button type="submit" class="btn">Cập Nhật</button>
                              </form>';
                } else {
                    echo '<p>Người dùng không tồn tại.</p>';
                }
            }
            break;

        default:

            include "view/home.php";
            break;
    }
}


include "view/footer.php";
