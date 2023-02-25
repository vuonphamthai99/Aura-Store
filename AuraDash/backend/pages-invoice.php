<?php
    include '../inc/header.php';
?>

<?php
    if(!isset($_GET['idBill']) || $_GET['idBill']==NULL || !isset($_GET['idCustomer']) || $_GET['idCustomer']==NULL){
        echo "<script>window.location ='error404.php'</script>";
    }else{
        $idBill = $_GET['idBill'];
        $idCustomer = $_GET['idCustomer'];
    }
?>


<?php
    $get_billinfo_cus = $ct->get_billinfo_cus($idBill);
    if($get_billinfo_cus) {
?>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">                  
        <div class="col-lg-12">
            <div class="card card-block card-stretch card-height print rounded">
                <?php
                    $get_address = $ct->get_address_billinfo($idBill, $idCustomer);
                    while($result_address = $get_address->fetch_assoc()) {
                ?>
                <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                    <div class="iq-header-title">
                        <h4 class="card-title mb-0">Đơn hàng #<?php echo $result_address['idBill']?></h4>
                    </div>
                    <!-- <div class="invoice-btn">
                        <button type="button" class="btn btn-primary-dark mr-2"><i class="las la-print"></i> Print
                            Print</button>
                        <button type="button" class="btn btn-primary-dark"><i class="las la-file-download"></i>PDF</button>
                    </div> -->
                </div>
                <div class="card-body">
                    <!-- <div class="row">
                        <div class="col-sm-12">                                  
                            <img src="../assets/images/logo.png" class="logo-invoice img-fluid mb-3">
                            <h5 class="mb-0">Hello, Barry Techs</h5>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                                its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                                opposed to using 'Content here, content here', making it look like readable English.</p>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Họ và tên người nhận</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Địa chỉ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding-left:12px !important;"><?php echo $result_address['CustomerName']?></td>
                                            <td style="padding-left:12px !important;"><?php echo $result_address['PhoneNumber']?></td>
                                            <td style="padding-left:12px !important;"><?php echo $result_address['Address']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="mb-3">Chi tiết đơn hàng</h5>
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">STT</th>
                                            <th scope="col">Sản phẩm</th>
                                            <th class="text-center" scope="col">Giá</th>
                                            <th class="text-center" scope="col">Số lượng</th>
                                            <th class="text-center" scope="col">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $Total_pd = 0;
                                            $SubTotal = 0;
                                            $i = 0;
                                            while($result = $get_billinfo_cus->fetch_assoc()) {
                                                $i++;
                                                $Total_pd = $result['Pricee']*$result['QuantityBuy'];
                                                $SubTotal += $Total_pd;
                                        ?>
                                        <tr>
                                            <th class="text-center" scope="row"><?php echo $i; ?></th>
                                            <td class="row" style="border-bottom:0;">
                                                <?php
                                                    $img_pd_cart = $pd->show_image_pd($result['idProduct']);
                                                    if($img_pd_cart) {
                                                        while($result_img = $img_pd_cart->fetch_assoc()) {
                                                ?>
                                                <img class="avatar-70 rounded" src="../assets/images/product/<?php echo $result_img['ImageName']?>" alt="">
                                                <?php
                                                        }
                                                    }
                                                ?>
                                                <div class="ml-2" style="flex:1;">
                                                    <h6 class="mb-0"><?php echo $result['ProductName']?></h6>
                                                    <p class="mb-0">Mã sản phẩm: <?php echo $result['idProduct']?></p>
                                                </div>
                                            </td>
                                            <td class="text-center" style="border-bottom:0;"><?php echo $fm->adddotstring($result['Pricee'])?>đ</td>
                                            <td class="text-center" style="border-bottom:0;"><?php echo $result['QuantityBuy']?></td>
                                            <td class="text-center" style="border-bottom:0;"><b><?php echo $fm->adddotstring($Total_pd)?>đ</b></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                              
                    </div>
                    <div class="row">
                        <!-- <div class="col-sm-12">
                            <b class="text-danger">Notes:</b>
                            <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page
                                when looking
                                at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                                as opposed to using 'Content here, content here', making it look like readable English.</p>
                        </div> -->
                    </div>
                    <div class="row mt-4 mb-3">
                        <div class="col-lg-12">
                            <div class="or-detail rounded">
                                <div class="p-3 row">
                                    <h5 class="mb-3 col-lg-12">Order Details</h5>
                                    <div class="mb-2 col-lg-10">
                                        <h6>Tổng tiền hàng:</h6>
                                    </div>
                                    <div class="mb-2 col-lg-2 text-right">
                                        <h6><?php echo $fm->adddotstring($SubTotal)?>đ</h6>
                                    </div>
                                    <div class="mb-2 col-lg-10">
                                        <h6>Phí vận chuyển (Miễn phí vận chuyển cho đơn hàng trên 1.000.000đ)</h6>
                                    </div>
                                    <?php
                                        if($SubTotal < 1000000){
                                            $ship = '30000';
                                            $Total_Bill = $SubTotal + '30000';
                                        }else{
                                            $ship = 'Miễn phí';
                                            $Total_Bill = $SubTotal;
                                        }       
                                    ?>
                                    <div class="mb-2 col-lg-2 text-right">
                                        <h6>
                                            <?php
                                                if($ship > 0){
                                                    echo $fm->adddotstring($ship);
                                            ?>đ
                                            <?php
                                                }else echo $ship; 
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                    <h6>Thành tiền</h6>
                                    <h3 class="text-primary font-weight-700"><?php echo $fm->adddotstring($Total_Bill)?>đ</h3>
                                </div>
                            </div>
                        </div>
                    </div>                            
                </div>
            </div>
        </div>                                    
        </div>
    </div>
    </div>
</div>
<!-- Wrapper End-->

<?php
    }
?>

<?php
    include '../inc/footer.php';
?>