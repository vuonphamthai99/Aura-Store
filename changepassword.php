<?php
    ob_start();
    include 'inc/header.php';
?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:index.php');
    }
?>

<?php
    $id = Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['savepassword'])){
		$ChangePassword = $cs->change_password($_POST, $id);
	}
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Đổi Mật Khẩu</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Tài Khoản Của Tôi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đổi Mật Khẩu</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--My Account Start-->
<div class="register-page section-padding-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-4">
                <div class="my-account-menu mt-30">
                    <ul class="nav account-menu-list flex-column">
                        <li>
                            <a href="my-account.php"><i class="fa fa-user"></i> Hồ Sơ</a>
                        </li>
                        <li>
                            <a href="address.php"><i class="fa fa-map-marker"></i> Địa Chỉ Nhận Hàng</a>
                        </li>
                        <li>
                            <a href="changepassword.php" class="active"><i class="fa fa-key"></i> Đổi Mật Khẩu</a>
                        </li>
                        <!-- <li>
                            <a href="login.php"><i class="fa fa-sign-out"></i> Logout</a>
                        </li> -->
                        <li>
                            <a href="order.php"><i class="fa fa-shopping-cart"></i> Đơn Đặt Hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-8 col-md-8">
                <div class="tab-content my-account-tab mt-30" id="pills-tabContent">
                    <div class="tab-pane fade active show">
                        <div class="my-account-address account-wrapper">
                            <div class="row">
                                <div class="col-md-12" style="border-bottom: solid 1px #efefef;">
                                    <h4 class="account-title" style="margin-bottom: 0;">Đổi Mật Khẩu</h4>
                                    <h5 style="color: #666;">Quản lý thông tin hồ sơ để bảo mật tài khoản</h5>
                                </div>
                                <?php
                                    if(isset($ChangePassword)){
                                        echo $ChangePassword;
                                    }
                                ?>
                                <?php
                                    $get_customer_by_id = $cs->show_customers($id);
                                        if($get_customer_by_id){
                                            while($result = $get_customer_by_id->fetch_assoc()){
                                ?>
                                <form method="POST">
                                <div class="col-md-12">
                                    <div class="account-address mt-30">
                                        <div class="profile__info-body-left-item">
                                            <span class="profile__info-body-left-item-title" style="width: 20%">Mật Khẩu Cũ</span>
                                            <div class="profile__info-body-left-item-input-validator">
                                                <input class="profile__info-body-left-item-input" name="password" type="password"/>
                                            </div>
                                        </div>
                                        <div class="profile__info-body-left-item">
                                            <span class="profile__info-body-left-item-title" style="width: 20%">Mật Khẩu Mới</span>
                                            <div class="profile__info-body-left-item-input-validator">
                                                <input class="profile__info-body-left-item-input" name="newpassword" type="password"/>
                                            </div>
                                        </div>
                                        <div class="profile__info-body-left-item">
                                            <span class="profile__info-body-left-item-title" style="width: 20%">Nhập Lại Mật Khẩu</span>
                                            <div class="profile__info-body-left-item-input-validator">
                                                <input class="profile__info-body-left-item-input" name="renewpassword" type="password"/>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary" type="submit" name="savepassword" style="float: right;" value="Lưu"/>
                                    </div>
                                </div>
                                </form>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--My Account End-->

<?php
    include 'inc/footer.php';
?>