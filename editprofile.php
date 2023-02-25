<?php
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
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])){
        $UpdateCustomers = $cs->update_customers($_POST, $_FILES, $id);
    }
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
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
                                    <h4 class="account-title" style="margin-bottom: 0;">Chỉnh Sửa Hồ Sơ</h4>
                                    <h5 style="color: #666;">Quản lý thông tin hồ sơ để bảo mật tài khoản</h5>
                                </div>
                                <?php
                                    if(isset($UpdateCustomers)){
                                        echo $UpdateCustomers;
                                    }
                                ?>
                                <form method="POST" style="display:flex; padding: 0;" enctype="multipart/form-data">
                                    <?php
                                        $id = Session::get('customer_id');
                                        $get_customers = $cs->show_customers($id);
                                        if($get_customers){
                                            while($result = $get_customers->fetch_assoc()){
                                    ?>
                                    <div class="col-md-8 mt-10">
                                        <div class="account-address">
                                            <div class="profile__info-body-left-item">
                                                <span class="profile__info-body-left-item-title">Tên Đăng Nhập</span>
                                                <span class="profile__info-body-left-item-text"><?php echo $result['username']?></span>
                                            </div>
                                            <div class="profile__info-body-left-item">
                                                <span class="profile__info-body-left-item-title">Họ Và Tên</span>
                                                <div class="profile__info-body-left-item-input-validator">
                                                    <input class="profile__info-body-left-item-input" name="CustomerName" type="text" value="<?php echo $result['CustomerName']?>"/>
                                                </div>
                                            </div>
                                            <div class="profile__info-body-left-item">
                                                <span class="profile__info-body-left-item-title">Số Điện Thoại</span>
                                                <div class="profile__info-body-left-item-input-validator">
                                                    <input class="profile__info-body-left-item-input" name="PhoneNumber" type="text" value="<?php echo $result['PhoneNumber']?>"/>
                                                </div>
                                            </div>
                                            <input type="submit" name="save" class="btn btn-primary" style="float: right;" value = "Lưu"/>
                                            <a class="btn hover-btn" href="my-account.php" style="float: right; margin-right: 10px;">Trở Lại</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-10" style="border-left: solid 1px #efefef; margin: 0 12px;">
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
                                            <label class="profile__info-body-right-avatar-btn btn">Chọn Ảnh
                                                <input type="file" name="Avatar" style="display: none;"/>
                                            </label>
                                            <div class="profile__info-body-right-avatar-condition">
                                                <span class="profile__info-body-right-avatar-condition-item">Dung lượng file tối đa 2MB</span>
                                                <span class="profile__info-body-right-avatar-condition-item">Định dạng: .JPEG, .PNG</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                        }
                                    ?>
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