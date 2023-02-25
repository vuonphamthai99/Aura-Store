<?php
    include 'inc/header.php';
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/we.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Đăng Nhập</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đăng Nhập</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Login Start-->
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
        $login_Customers = $cs->login_customers($_POST);
    }
?>
<div class="login-page section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-register-content">
                    <h4 class="title">Đăng Nhập Vào Tài Khoản</h4>
                    <div class="login-register-form">
                        <form method="POST">
                            <?php
                                if(isset($login_Customers)){
                                    echo $login_Customers;
                                }
                            ?>
                            <div class="single-form">
                                <label>Tên tài khoản</label>
                                <input type="text" name="username">
                            </div>
                            <div class="single-form">
                                <label>Mật khẩu</label>
                                <input type="password" name="password">
                            </div>
                            <div class="single-form">
                                <input type="submit" name="login" class="btn btn-primary btn-block" value="Đăng nhập"/>
                            </div>
                            <div class="single-form">
                                <label>Bạn chưa có tài khoản?</label>
                                <a href="register.php" class="btn btn-dark btn-block">Đăng ký ngay</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Login End-->

<?php
    include 'inc/footer.php';
?>