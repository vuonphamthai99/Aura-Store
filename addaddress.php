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
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addaddress'])){
		$insertAddress = $ad->insert_address($_POST);
	}
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Địa Chỉ Nhận Hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Tài Khoản Của Tôi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Địa Chỉ Nhận Hàng</li>
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
                            <a href="address.php" class="active"><i class="fa fa-map-marker"></i> Địa Chỉ Nhận Hàng</a>
                        </li>
                        <li>
                            <a href="changepassword.php"><i class="fa fa-key"></i> Đổi Mật Khẩu</a>
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
                                    <h4 class="account-title" style="margin-bottom: 0;">Thêm Địa Chỉ Mới</h4>
                                    <h5 style="color: #666;">Quản lý thông tin hồ sơ để bảo mật tài khoản</h5>
                                </div>
                                <?php
                                    if(isset($insertAddress)) {
                                        echo $insertAddress;
                                    }
                                ?> 
                                <form method="POST">
                                <div class="col-md-12">
                                    <div class="account-address mt-30">
                                        <div class="profile__info-body-left-item">
                                            <span class="profile__info-body-left-item-title" style="width: 20%">Họ Và Tên</span>
                                            <div class="profile__info-body-left-item-input-validator">
                                                <input class="profile__info-body-left-item-input" name="CustomerName" type="text" placeholder="Nguyễn Hồng Ngọc"/>
                                            </div>
                                        </div>
                                        <div class="profile__info-body-left-item">
                                            <span class="profile__info-body-left-item-title" style="width: 20%">Số Điện Thoại</span>
                                            <div class="profile__info-body-left-item-input-validator">
                                                <input class="profile__info-body-left-item-input" name="PhoneNumber" type="text" placeholder="0913786512"/>
                                            </div>
                                        </div>
                                        <div class="profile__info-body-left-item">
                                            <span class="profile__info-body-left-item-title" style="width: 20%">Địa Chỉ</span>
                                            <div class="profile__info-body-left-item-input-validator">
                                                <input class="profile__info-body-left-item-input" name="Address" type="text" placeholder="Tỉnh/Thành phố, Quận/Huyện, Phường/Xã"/>
                                            </div>
                                        </div>
                                        <input type="submit" name="addaddress" class="btn btn-primary" style="float: right;" value="Thêm Mới"/>
                                        <a class="btn hover-btn" href="address.php" style="float: right; margin-right: 10px;">Trở Lại</a>
                                    </div>
                                </div>
                                </form>
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