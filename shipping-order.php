<?php
    use PhpParser\Node\Stmt\Echo_;
    include 'inc/header.php';

    $id = Session::get('customer_id');
    if(isset($_GET['conf_receive_idBill'])){
        $idBill = $_GET['conf_receive_idBill'];
        $conf_receive = $sale->conf_receive_Bill($idBill);
    }

?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:index.php');
    }
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/pexels-karolina-grabowska-4202326.jpg
);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Đơn Đặt Hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="my-account.php">Tài Khoản Của Tôi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đơn Đặt Hàng</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

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
                            <a href="changepassword.php"><i class="fa fa-key"></i> Đổi Mật Khẩu</a>
                        </li>
                        <li>
                            <a href="order.php" class="active"><i class="fa fa-shopping-cart"></i> Đơn Đặt Hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-md-8">
                <div class="tab-content my-account-tab mt-30" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-order">
                        <div class="my-account-order account-wrapper">
                            <h4 class="account-title mb-15">Đơn Đặt Hàng</h4>
                            <div class="row pt-30 pb-30"style="border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5; justify-content: space-evenly;">
                                <a href="order.php" class="col-xl-2 col-md-2 text-center view-hover">
                                    <i class="fa fa-envelope" style="font-size:24px;"></i>
                                    <div>Tất cả</div>
                                </a>
                                <a href="waiting-order.php" class="col-xl-2 col-md-2 text-center view-hover">
                                    <i class="fa fa-inbox" style="font-size:24px;"></i>
                                    <div>Chờ xác nhận</div>
                                </a>
                                <a href="shipping-order.php" class="col-xl-2 col-md-2 text-center view-hover text-primary"> 
                                    <i class="fa fa-plane" style="font-size:24px;"></i>
                                    <div>Đang giao</div>
                                </a>
                                <a href="shipped-order.php" class="col-xl-2 col-md-2 text-center view-hover"> 
                                    <i class="fa fa-check-circle" style="font-size:24px;"></i>
                                    <div>Đã giao</div>
                                </a>
                                <a href="cancelled-order.php" class="col-xl-2 col-md-2 text-center view-hover">
                                    <i class="fa fa-times" style="font-size:24px;"></i>
                                    <div>Đã hủy</div>
                                </a>
                            </div>
                            <?php
                                if(isset($del_idBill)) echo "<div style='position:relative; left:-15px; bottom:-22px;'>$del_idBill</div>";
                            ?>
                            <div class="account-table text-center mt-25 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="no">STT</th>
                                            <th class="name">Họ và tên</th>
                                            <th class="date">Ngày đặt</th>
                                            <th class="total">Tổng tiền</th>
                                            <th class="action">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $get_cart = $ct->get_cart_shipping_ordered($id);
                                            if($get_cart){
                                                $i = 0;
                                                while($result = $get_cart->fetch_assoc()){
                                                    $i++;
                                        ?>
                                        
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $result['CustomerName']?></td>
                                            <td><?php echo $result['OrderDate']?></td>
                                            <td><?php echo $fm->adddotstring($result['TotalBill'])?>đ</td>
                                            <td style="display:flex; text-align:center">
                                                <a class="view-hover" style="flex:1;" href="bill-info.php?idBill=<?php echo $result['idBill']?>">Xem chi tiết</a>
                                                <a class="view-hover text-primary" style="width:60%;" href="order.php?conf_receive_idBill=<?php echo $result['idBill']?>">Xác nhận đã nhận hàng</a>;
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include 'inc/footer.php';
?>