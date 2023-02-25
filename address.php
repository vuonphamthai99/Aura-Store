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
	if(isset($_GET['idAddress'])){
        $idAddress = $_GET['idAddress'];
		$delad = $ad->del_address($idAddress);
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
                                <div class="col-md-12 title-address" style="border-bottom: solid 1px #efefef;">
                                    <h4 class="account-title" style="margin-bottom: 0;">Địa Chỉ Nhận Hàng</h4>
                                    <a class="btn btn-primary" href="addaddress.php" style="float: right;"><i class="fa fa-edit"></i> Thêm Địa Chỉ Mới</a>
                                </div>
                                <?php
                                    if(isset($delad)){
                                        echo $delad;
                                    }
                                ?>
                                <?php
                                    $adlist = $ad->show_address();
                                    if($adlist) {
                                        $i = 0;
                                        while($result = $adlist->fetch_assoc()) {
                                            $i++;
                                ?>
                                <div class="col-md-10 border-bottom">
                                    <div class="account-address mt-30">
                                        <div class="profile__info-bdaddress-left-item">
                                            <span class="profile__info-bdaddress-left-item-title">Họ Và Tên</span>
                                            <span class="profile__info-bdaddress-left-item-text text-css"><?php echo $result['CustomerName']?></span>
        
                                        </div>
                                        <div class="profile__info-bdaddress-left-item">
                                            <span class="profile__info-bdaddress-left-item-title">Số Điện Thoại</span>
                                            <span class="profile__info-bdaddress-left-item-text"><?php echo $result['PhoneNumber']?></span>
                                        </div>
                                        <div class="profile__info-bdaddress-left-item">
                                            <span class="profile__info-bdaddress-left-item-title align-items-start">Địa Chỉ Nhận Hàng</span>
                                            <div class="profile__info-bdaddress-left-item-text">
                                                <span class="profile__info-bdaddress-left-item-textaddress"><?php echo $result['Address']?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-30 border-bottom" style="display: flex; justify-content: space-between;">
                                    <a href="editaddress.php?idAddress=<?php echo $result['idAddress']?>" class="profile__info-bdaddress-right-controls-edit">Sửa</a>
                                    <a href="?idAddress=<?php echo $result['idAddress']?>" onclick="return confirm('Bạn có muốn xóa không?')" class="profile__info-bdaddress-right-controls-edit">Xóa</a>
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