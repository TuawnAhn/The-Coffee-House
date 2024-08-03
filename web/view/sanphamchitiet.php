<?php
$html_dm = showdm($dsdm);
$html_sp_lienquan = showsp($dssp_lienquan);
extract($spchitiet);
?>
<div class="containerfull">
    <div class="bgbanner">SẢN PHẨM</div>
</div>

<section class="containerfull">
    <div class="container">
        <div class="boxleft mr2pt menutrai">
            <h1>DANH MỤC</h1><br><br>
            <?= $html_dm ?>
        </div>
        <div class="boxright">
            <h1>SẢN PHẨM CHI TIỂT</h1><br>
            <div class="containerfull mr30">
                <div class="col6 imgchitiet">
                    <img src="layout/images/<?= $img ?>" alt="">
                </div>
                <div class="col6 textchitiet">
                    <h2><?= $name ?></h2>
                    <p style="font-size: 13pt;">Thành tiền: <?= $price ?>.000đ</p>


                    <form action="index.php?pg=addcart" method="post">
                        <input type="hidden" name="name" value="<?= $name ?>">
                        <input type="hidden" name="img" value="<?= $img ?>">
                        <input type="hidden" name="price" value="<?= $price ?>">
                        <input type="number" name="soluong" id="" min="1" value="1" max="10" style="margin-bottom: 15px;padding: 10px;border: 2px solid #ccc;border-radius: 5px;font-size: 16px;width: 100px;">
                        <button type="submit" name="addcart" style="background-color: rgb(229, 121, 5); color:white;">
                            <div class><svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 0C14.5523 0 15 0.447715 15 1V1.999L20 2V8L17.98 7.999L20.7467 15.5953C20.9105 16.032 21 16.5051 21 16.999C21 19.2082 19.2091 20.999 17 20.999C15.1368 20.999 13.5711 19.7251 13.1265 18.0008L8.87379 18.0008C8.42948 19.7256 6.86357 21 5 21C3.05513 21 1.43445 19.612 1.07453 17.7725C0.435576 17.439 0 16.7704 0 16V3C0 2.44772 0.447715 2 1 2H8C8.55228 2 9 2.44772 9 3V11C9 11.5128 9.38604 11.9355 9.88338 11.9933L10 12H12C12.5128 12 12.9355 11.614 12.9933 11.1166L13 11V2H10V0H14ZM5 15C3.89543 15 3 15.8954 3 17C3 18.1046 3.89543 19 5 19C6.10457 19 7 18.1046 7 17C7 15.8954 6.10457 15 5 15ZM17 14.999C15.8954 14.999 15 15.8944 15 16.999C15 18.1036 15.8954 18.999 17 18.999C18.1046 18.999 19 18.1036 19 16.999C19 15.8944 18.1046 14.999 17 14.999ZM15.852 7.999H15V11C15 12.6569 13.6569 14 12 14H10C8.69412 14 7.58312 13.1656 7.17102 12.0009L1.99994 12V14.3542C2.73289 13.5238 3.80528 13 5 13C6.86393 13 8.43009 14.2749 8.87405 16.0003H13.1257C13.5693 14.2744 15.1357 12.999 17 12.999C17.2373 12.999 17.4697 13.0197 17.6957 13.0593L15.852 7.999ZM7 7H2V10H7V7ZM18 4H15V6H18V4ZM7 4H2V5H7V4Z" fill="white" fill-opacity="0.6"></path>
                                </svg> Đặt giao tận nơi</div>
                        </button>
                    </form>
                </div>

            </div>
            <hr>
            <h1>SẢN PHẨM LIÊN QUAN</h1>
            <div class="containerfull mr30">
                <?= $html_sp_lienquan; ?>

            </div>
        </div>


    </div>
</section>