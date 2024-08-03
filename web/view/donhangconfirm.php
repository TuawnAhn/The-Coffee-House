<?php
$idbill = isset($_GET['idbill']) ? intval($_GET['idbill']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Hàng Xác Nhận</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="containerfull">
        <div class="bgbanner">ĐƠN HÀNG ĐÃ ĐẶT THÀNH CÔNG</div>
    </div>

    <section class="containerfull">
        <div class="container">
            <h2>Cảm ơn quý khách. Đơn hàng đã đặt thành công. <br>
                Quý khách có thể theo dõi đơn hàng <a href="index.php?pg=donha">tại đây</a>!
            </h2>
        </div>
    </section>
</body>

</html>