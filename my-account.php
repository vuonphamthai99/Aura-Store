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

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/oso.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Hồ Sơ Của Tôi</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Tài Khoản Của Tôi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hồ Sơ</li>
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
                            <a href="my-account.php" class="active"><i class="fa fa-user"></i> Hồ Sơ</a>
                        </li>
                        <li>
                            <a href="address.php"><i class="fa fa-map-marker"></i> Địa Chỉ Nhận Hàng</a>
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
                                    <h4 class="account-title" style="margin-bottom: 0;">Hồ Sơ Của Tôi</h4>
                                    <h5 style="color: #666;">Quản lý thông tin hồ sơ để bảo mật tài khoản</h5>
                                </div>
                                <?php
                                    $id = Session::get('customer_id');
                                    $get_customers = $cs->show_customers($id);
                                    if($get_customers){
                                        while($result = $get_customers->fetch_assoc()){
                                ?>
                                <div class="col-md-8">
                                    <div class="account-address mt-30">
                                        <div class="profile__info-body-left-item">
                                            <span class="profile__info-body-left-item-title">Tên Đăng Nhập</span>
                                            <span class="profile__info-body-left-item-text"><?php echo $result['username']?></span>
                                        </div>
                                        <div class="profile__info-body-left-item">
                                            <span class="profile__info-body-left-item-title">Họ Và Tên</span>
                                            <span class="profile__info-body-left-item-text"><?php echo $result['CustomerName']?></span>
                                        </div>
                                        <div class="profile__info-body-left-item">
                                            <span class="profile__info-body-left-item-title">Số Điện Thoại</span>
                                            <span class="profile__info-body-left-item-text"><?php echo $result['PhoneNumber']?></span>
                                        </div>
                                        <a class="btn btn-primary" href="editprofile.php" style="float: right;"><i class="fa fa-edit"></i> Sửa Hồ Sơ</a>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-30" style="border-left: solid 1px #efefef;">
                                    <div class="profile__info-body-right-avatar">
                                        <?php
                                            if($result['Avatar']){
                                        ?>
                                        <div class="profile__info-body-right-avatar-img" style="background-image: url('assets/images/customer/<?php echo $result['Avatar']?>');"></div>
                                        <?php
                                            }else{
                                                echo "<div class='profile__info-body-right-avatar-img' style='background-image: url(assets/images/customer/1.png);'></div>";
                                            }
                                        ?>
                                    </div>
                                </div>
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