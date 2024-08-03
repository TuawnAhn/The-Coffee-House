<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee House</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="containerfull">
        <div class="bgbanner">ĐƠN HÀNG</div>
    </div>

    <section class="containerfull">
        <div class="container">
            <form action="index.php?pg=donhangbill" method="post">
                <div class="col9 viewcart">
                    <div class="ttdathang">
                        <h2>Thông tin người đặt hàng</h2>
                        <label for="nguoidat_ten"><b>Họ và tên</b></label>
                        <input type="text" placeholder="Nhập họ tên đầy đủ" name="nguoidat_ten" id="nguoidat_ten" required>

                        <label for="nguoidat_diachi"><b>Địa chỉ</b></label>
                        <input type="text" placeholder="Nhập địa chỉ" name="nguoidat_diachi" id="nguoidat_diachi" required>

                        <label for="nguoidat_email"><b>Email</b></label>
                        <input type="text" placeholder="Nhập email" name="nguoidat_email" id="nguoidat_email" required>

                        <label for="nguoidat_tel"><b>Điện thoại</b></label>
                        <input type="text" placeholder="Nhập điện thoại" name="nguoidat_tel" id="nguoidat_tel" required>
                    </div>
                    <div class="ttdathang">
                        <a onclick="showttnhanhang()" style="cursor: pointer;">
                            &rArr; Thay đổi thông tin nhận hàng
                        </a>
                    </div>
                    <div class="ttdathang" id="ttnhanhang">
                        <h2>Thông tin người nhận hàng</h2>
                        <label for="nguoinhan_ten"><b>Họ và tên</b></label>
                        <input type="text" placeholder="Nhập họ tên đầy đủ" name="nguoinhan_ten" id="nguoinhan_ten">

                        <label for="nguoinhan_diachi"><b>Địa chỉ</b></label>
                        <input type="text" placeholder="Nhập địa chỉ" name="nguoinhan_diachi" id="nguoinhan_diachi">

                        <label for="nguoinhan_tel"><b>Điện thoại</b></label>
                        <input type="text" placeholder="Nhập điện thoại" name="nguoinhan_tel" id="nguoinhan_tel">
                    </div>
                </div>

                <div class="col3">
                    <h2>ĐƠN HÀNG</h2>
                    <div class="total">
                        <div class="boxcart">
                            <ul>
                                <?php echo viewcart_tt(); ?>
                            </ul>
                            <h3>Tổng: <?php echo number_format(get_tongdonhang()); ?>.000đ</h3>
                        </div>
                    </div>

                    <div class="coupon">
                        <div class="boxcart">
                            <h3>Voucher: <?php echo number_format(isset($giatrivoucher) ? $giatrivoucher : 0); ?>đ</h3>
                        </div>
                    </div>
                    <div class="total">
                        <div class="boxcart bggray">
                            <h3>Tổng thanh toán: <?php echo number_format(isset($thanhtoan) ? $thanhtoan : get_tongdonhang()); ?>.000đ</h3>
                        </div>
                    </div>
                    <div class="pttt">
                        <div class="boxcart">
                            <h3>Phương thức thanh toán: </h3>
                            <input type="radio" name="pttt" value="1" id="pttt1" checked> Tiền mặt<br>
                            <input type="radio" name="pttt" value="2" id="pttt2"> Ví điện tử<br>
                            <input type="radio" name="pttt" value="3" id="pttt3"> Chuyển khoản<br>
                            <input type="radio" name="pttt" value="4" id="pttt4"> Thanh toán online<br>
                        </div>
                    </div>
                    <button type="submit">Thanh toán</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        var ttnhanhang = document.getElementById("ttnhanhang");
        ttnhanhang.style.display = "none";

        function showttnhanhang() {
            if (ttnhanhang.style.display === "none") {
                ttnhanhang.style.display = "block";
            } else {
                ttnhanhang.style.display = "none";
            }
        }
    </script>

</body>

</html>