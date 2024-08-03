<?php

?>
<div class="containerfull">
   <div class="bgbanner">ĐĂNG NHẬP</div>
</div>

<section class="containerfull">
   <div class="container">
      <div class="boxleft mr2pt menutrai">
         <h1>DÀNH CHO BẠN</h1><br><br>
         <a href="index.php?pg=dangky">Cập nhật thông tin</a>
         <a href="index.php?pg=lichsumuahang">Lịch sử mua hàng</a>
         <a href="index.php?pg=logout">Thoát hệ thống</a>
      </div>
      <div class="boxright">
         <h1>ĐĂNG NHẬP</h1><br>
         <div class="containerfull mr30">
            <h2 style="color:red">
               <?php
               if (isset($_SESSION['tb_dangnhap']) && ($_SESSION['tb_dangnhap'] != "")) {
                  echo $_SESSION['tb_dangnhap'];
                  unset($_SESSION['tb_dangnhap']);
               }

               ?>
            </h2>
            <form action="index.php?pg=login" method="post">
               <div class="row">
                  <div class="col-25">
                     <label for="username">Tên đăng nhập</label>
                  </div>
                  <div class="col-75">
                     <input type="text" id="username" name="username" placeholder="Nhập tên đi">
                  </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <label for="password">Mật khẩu</label>
                  </div>
                  <div class="col-75">
                     <input type="password" id="password" name="password" placeholder="Nhập mật khẩu..">
                  </div>
               </div>



               <br>
               <div class="row">

                  <input type="submit" name="dangnhap" value="Đăng nhập">
               </div>
            </form>

         </div>
      </div>


   </div>
</section>