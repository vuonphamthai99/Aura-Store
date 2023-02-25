<?php
    include 'inc/header.php';
?>

<?php
    $idCustomer = Session::get('customer_id');
    if(!isset($_GET['idBill']) || $_GET['idBill']==NULL){
        echo "<script>window.location ='error404.php'</script>";
    }else{
        $idBill = $_GET['idBill'];
    }
?>

<?php
    $get_billinfo_cus = $ct->get_billinfo_cus($idBill);
    if($get_billinfo_cus) {
?>
<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Chi tiết đơn hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đơn mua</li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Cart Start-->
<div class="cart-page section-padding-5">
    <div class="container">

        <div class="container__address">
            <div class="container__address-css"></div>
            <div class="container__address-content">
                <div class="container__address-content-hd">
                    <i class="container__address-content-hd-icon fa fa-map-marker"></i>
                    <div>Địa Chỉ Nhận Hàng</div>
                </div>
                <ul class="shipping-list">
                    <?php
                        $get_cart = $ct->get_address_billinfo($idBill, $idCustomer);
                        while($result_address = $get_cart->fetch_assoc()) {
                    ?>
                    <li>
                        <label style="font-size: 20px;">
                            <span class="mr-10"><?php echo $result_address['CustomerName']?></span>
                            <span class="mr-10"><?php echo $result_address['PhoneNumber']?></span>
                            <span><?php echo $result_address['Address']?></span>
                        </label>
                    </li>
                    <?php
                            }
                    ?>
                </ul>
            </div>
        </div>

        <div class="cart-table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="image">Hình Ảnh</th>
                        <th class="product">Sản Phẩm</th>
                        <th class="price">Giá</th>
                        <th class="quantity">Số Lượng</th>
                        <th class="total">Tổng Giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $Total_pd = 0;
                        $SubTotal = 0;
                        while($result = $get_billinfo_cus->fetch_assoc()) {
                            $Total_pd = $result['Pricee']*$result['QuantityBuy'];
                            $SubTotal += $Total_pd;
                    ?>
                    <tr>
                        <?php
                            $img_pd_cart = $pd->show_image_pd($result['idProduct']);
                            if($img_pd_cart) {
                                while($result_img = $img_pd_cart->fetch_assoc()) {
                        ?>
                        <td class="image">
                            <a href="shop-single.php?idProduct=<?php echo $result['idProduct']?>"><img src="../kngu/AuraDash/assets/images/product/<?php echo $result_img['ImageName']?>" alt=""></a>
                        </td>
                        <?php
                                }
                            }
                        ?>
                        <td class="product">
                            <a href="shop-single.php?idProduct=<?php echo $result['idProduct']?>"><?php echo $result['ProductName']?></a>
                            <span>Mã sản phẩm: <?php echo $result['idProduct']?></span>
                        </td>
                        <td class="price">
                            <span class="amount"><?php echo $fm->adddotstring($result['Pricee'])?>đ</span>
                        </td>
                        <td class="quantity"><?php echo $result['QuantityBuy']?></td>
                        <td class="total">
                            <span class="total-amount"><?php echo $fm->adddotstring($Total_pd)?>đ</span>
                        </td>
                    </tr>
                    <?php
                            }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="cart-totals">
                    <div class="cart-title">
                        <h4 class="title">Tổng giỏ hàng</h4>
                    </div>
                    <div class="cart-total-table mt-25">
                        <table class="table">
                            <tbody>
                                <!-- <tr>
                                    <td>
                                        <p class="value">Subtotal</p>
                                    </td>
                                    <td>
                                        <p class="price">£600.00</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="value">Shipping</p>
                                    </td>
                                    <td>
                                        <ul class="shipping-list">
                                            <li class="cus-radio">
                                                <input type="radio" name="shipping" id="radio1" checked="">
                                                <label for="radio1"><span></span> Flat Rate</label>
                                            </li>
                                            <li class="cus-radio">
                                                <input type="radio" name="shipping" id="radio2">
                                                <label for="radio2"><span></span> Free Shipping</label>
                                            </li>
                                            <li class="cus-radio">
                                                <input type="radio" name="shipping" id="radio3">
                                                <label for="radio3"><span></span> Local Pickup</label>
                                            </li>
                                        </ul>
                                    </td>
                                </tr> -->

                                <tr>
                                    <td>
                                        <p class="value">Tổng tiền hàng</p>
                                    </td>
                                    <td>
                                        <p class="price"><?php echo $fm->adddotstring($SubTotal)?>đ</p>
                                    </td>
                                </tr>
                                <?php
                                    if($SubTotal < 1000000){
                                        $ship = '30000';
                                        $Total_Bill = $SubTotal + '30000';
                                    }else{
                                        $ship = 'Miễn phí';
                                        $Total_Bill = $SubTotal;
                                    }       
                                ?>
                                <tr>
                                    <td>
                                        <p class="value">Phí vận chuyển (Miễn phí vận chuyển cho đơn hàng trên 1.000.000đ)</p>
                                    </td>
                                    <td>
                                        <p class="price">
                                            <?php
                                                if($ship > 0){
                                                    echo $fm->adddotstring($ship);
                                            ?>đ
                                            <?php
                                                }else echo $ship; 
                                            ?>
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="value">Thành tiền</p>
                                    </td>
                                    <td>
                                        <p class="price"><?php echo $fm->adddotstring($Total_Bill)?>đ</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Cart End-->

<?php
    }
?>

<?php
    include 'inc/footer.php';
?>