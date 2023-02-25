<?php
    include 'inc/header.php';
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Giỏ hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Empty Cart Start-->
<div class="empty-cart-page section-padding-5">
    <div class="container">
        <div class="empty-cart-content text-center">
            <h2 class="empty-cart-title">Giỏ hàng</h2>
            <div class="empty-cart-img">
                <img src="assets/images/cart.png" alt="">
            </div>
            <p>Giỏ hàng của bạn chưa có sản phẩm!</p>
            <a href="product.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Tiếp tục mua sắm</a>
        </div>
    </div>
</div>
<!--Empty Cart End-->

<?php
    include 'inc/footer.php';
?>