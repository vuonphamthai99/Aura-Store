<?php
    include 'inc/header.php';
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Thanh toán</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Empty Cart Start-->
<div class="empty-cart-page section-padding-5">
    <div class="container">
        <div class="empty-cart-content text-center">
            <h2 class="empty-cart-title text-primary">Đặt hàng thành công!</h2>
            <div class="empty-cart-img">
                <img src="assets/images/cart.png" alt="">
            </div>
            <a href="order.php" class="btn btn-primary">Xem chi tiết đơn hàng</a>
        </div>
    </div>
</div>
<!--Empty Cart End-->

<?php
    include 'inc/footer.php';
?>