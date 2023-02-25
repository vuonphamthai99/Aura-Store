<?php
    include 'inc/header.php';
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/we.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Đăng Ký Tài Khoản</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đăng Ký Tài Khoản</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Register Start-->
<div class="register-page section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-register-content">
                    <h4 class="title">Tạo Tài Khoản Mới</h4>

                    <?php
                        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitdk'])){
                            $insertCustomers = $cs->insert_customers($_POST);
                        }
                    ?>
                    <div class="login-register-form">
                        <form method="POST">
                            <?php
                                if(isset($insertCustomers)){
                                    echo $insertCustomers;
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
                                <label>Xác nhận mật khẩu</label>
                                <input type="password" name="repassword">
                            </div>
                            <div class="single-form">
                                <input name="submitdk" type="submit" class="btn btn-primary btn-block"  value="Đăng ký"/>
                            </div>
                            <div class="single-form">
                                <label>Bạn đã có tài khoản?</label>
                                <a href="login.php" class="btn btn-dark btn-block">Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Register End-->

<?php
    include 'inc/footer.php';
?>