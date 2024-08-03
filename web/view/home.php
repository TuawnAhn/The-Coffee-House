<?php
$html_dssp_new = showsp($dssp_new);
$html_dssp_best = showsp($dssp_best);
$html_dssp_view = showsp($dssp_view);
?>
<div class="containerfull">
    <img src="layout/images/bannercoffee.webp" alt="">
</div>

<section class="containerfull">
    <div class="container">
        <h1>SẢN PHẨM HOT</h1><br>
        <div class="containerfull">
            <div class="box50 mr15">
                <img src="layout/images/banner2.webp" alt="">
            </div>
            <?= $html_dssp_best ?>
        </div>

        <div class="containerfull mr30">
            <h1>SẢN PHẨM MỚI</h1><br>
            <?= $html_dssp_new; ?>
        </div>

        <div class="containerfull mr30">
            <h1>SẢN PHẨM NHIỀU NGƯỜI XEM</h1><br>
            <?= $html_dssp_view ?>
        </div>

    </div>
</section>


<section class="containerfull bg1 padd50">
    <div class="container">
        <h1>DANH MỤC SẢN PHẨM HOT</h1>
        <div class="row">
            <h2>Cà phê</h2>
        </div>
        <div class="row">
            <div class="box25 mr15">
                <img src="layout/images/sp1.webp" alt="">
                <div style="text-align:center">
                    <span class="name" style="font-weight:bold; font-size: 13pt">Hi-Tea Vải</span>
                </div>
                <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">25.000đ</span>
                <form action="index.php?pg=addcart" method="post">
                    <input type="hidden" name="name" value="Hi-Tea Vải">
                    <input type="hidden" name="img" value="sp1.webp">
                    <input type="hidden" name="price" value="25000">
                    <input type="hidden" name="soluong" value="1">
                    <button type="submit" name="addcart">Đặt hàng</button>
                </form>
            </div>
            <div class="box25 mr15">
                <img src="layout/images/sp2.webp" alt="">
                <div style="text-align:center">
                    <span class="name" style="font-weight:bold; font-size: 13pt">Cà phê sữa đá</span>
                </div>
                <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">20.000đ</span>
                <form action="index.php?pg=addcart" method="post">
                    <input type="hidden" name="name" value="Cà phê sữa đá">
                    <input type="hidden" name="img" value="sp2.webp">
                    <input type="hidden" name="price" value="20">
                    <input type="hidden" name="soluong" value="1">
                    <button type="submit" name="addcart">Đặt hàng</button>
                </form>
            </div>
            <div class="box25 mr15">
                <img src="layout/images/sp3.webp" alt="">
                <div style="text-align:center">
                    <span class="name" style="font-weight:bold; font-size: 13pt">Mochi Kem Chocolate</span>
                </div>
                <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">30.000đ</span>
                <form action="index.php?pg=addcart" method="post">
                    <input type="hidden" name="name" value="Bạc xỉu đá">
                    <input type="hidden" name="img" value="sp3.webp">
                    <input type="hidden" name="price" value="30">
                    <input type="hidden" name="soluong" value="1">
                    <button type="submit" name="addcart">Đặt hàng</button>
                </form>
            </div>
            <div class="box25 mr15">
                <img src="layout/images/sp4.webp" alt="">
                <div style="text-align:center">
                    <span class="name" style="font-weight:bold; font-size: 13pt">Cà phê đen nóng</span>
                </div>
                <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">15.000đ</span>
                <form action="index.php?pg=addcart" method="post">
                    <input type="hidden" name="name" value="Cà phê đen đá">
                    <input type="hidden" name="img" value="sp4.webp">
                    <input type="hidden" name="price" value="15">
                    <input type="hidden" name="soluong" value="1">
                    <button type="submit" name="addcart">Đặt hàng</button>
                </form>
            </div>
        </div>
        <div class="row">
            <h2>Trà</h2>
        </div>
        <div class="row">
            <div class="box25 mr15">
                <img src="layout/images/sp5.webp" alt="">
                <div style="text-align:center">
                    <span class="name" style="font-weight:bold; font-size: 13pt">Cà Phê Sữa Đá Hòa Tan Túi</span>
                </div>
                <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">35.000đ</span>
                <form action="index.php?pg=addcart" method="post">
                    <input type="hidden" name="name" value="Trà đào cam sả">
                    <input type="hidden" name="img" value="sp5.webp">
                    <input type="hidden" name="price" value="35">
                    <input type="hidden" name="soluong" value="1">
                    <button type="submit" name="addcart">Đặt hàng</button>
                </form>
            </div>
            <div class="box25 mr15">
                <img src="layout/images/sp6.webp" alt="">
                <div style="text-align:center">
                    <span class="name" style="font-weight:bold; font-size: 13pt">Cà phê sữa đá</span>
                </div>
                <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">40.000đ</span>
                <form action="index.php?pg=addcart" method="post">
                    <input type="hidden" name="name" value="Trà dâu tằm">
                    <input type="hidden" name="img" value="sp6.webp">
                    <input type="hidden" name="price" value="40">
                    <input type="hidden" name="soluong" value="1">
                    <button type="submit" name="addcart">Đặt hàng</button>
                </form>
            </div>
            <div class="box25 mr15">
                <img src="layout/images/sp7.webp" alt="">
                <div style="text-align:center">
                    <span class="name" style="font-weight:bold; font-size: 13pt">Bạc xỉu</span>
                </div>
                <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">45.000đ</span>
                <form action="index.php?pg=addcart" method="post">
                    <input type="hidden" name="name" value="Trà sữa trân châu đường đen">
                    <input type="hidden" name="img" value="sp7.webp">
                    <input type="hidden" name="price" value="45">
                    <input type="hidden" name="soluong" value="1">
                    <button type="submit" name="addcart">Đặt hàng</button>
                </form>
            </div>
            <div class="box25 mr15">
                <img src="layout/images/sp8.webp" alt="">
                <div style="text-align:center">
                    <span class="name" style="font-weight:bold; font-size: 13pt">Cà Phê Sữa Nóng</span>
                </div>
                <span class="price" style="margin: 5px 0 0; font-size: 13pt;color:#666">38.000đ</span>
                <form action="index.php?pg=addcart" method="post">
                    <input type="hidden" name="name" value="Trà sen vàng">
                    <input type="hidden" name="img" value="sp8.webp">
                    <input type="hidden" name="price" value="38">
                    <input type="hidden" name="soluong" value="1">
                    <button type="submit" name="addcart">Đặt hàng</button>
                </form>
            </div>
        </div>
    </div>
</section>