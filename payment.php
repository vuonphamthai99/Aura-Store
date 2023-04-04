<?php
    include 'inc/header.php';
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order'])){
        if(!empty($_POST['address_rdo'])){
            $customer_id = Session::get('customer_id');
            $insertOrder = $ct->insertOrder($_POST, $customer_id);
            $delcart = $ct->del_all_data_cart($customer_id);
        }else {
            echo '<div style="width:100%; color: var(--primary-color); font-size:1.8rem; background-color:#f5f5f5; padding-left:192px; padding-top:20px;">
                    Vui lòng chọn địa chỉ nhận hàng hoặc cập nhật thông tin địa chỉ vào tài khoản!
                </div>';
        }
    }
?>

<?php
    $pd_cart = $ct->get_product_cart();
    if($pd_cart) {
        $total = 0;
?>
<form method="POST" id="checkout-form">
<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Thanh toán</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
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
                            $adlist = $ad->show_address();
                            if($adlist) {
                                while($result = $adlist->fetch_assoc()) {
                    ?>
                    <li class="cus-radio">
                        <input type="radio" name="address_rdo" value="<?php echo $result['idAddress']?>" id="radio<?php echo $result['idAddress']?>" checked>
                        <label for="radio<?php echo $result['idAddress']?>">
                            <span><?php echo $result['CustomerName']?></span>
                            <span><?php echo $result['PhoneNumber']?></span>
                            <span><?php echo $result['Address']?></span>
                        </label>
                    </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>

        <?php
            if(isset($insertOrder)){
                echo $insertOrder;
            }
        ?>
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
                        while($result = $pd_cart->fetch_assoc()) {
                            $total += $result['Total'];
                    ?>
                    <tr>
                        <?php
                            $img_pd_cart = $pd->show_image_pd($result['idProduct']);
                            if($img_pd_cart) {
                                while($result_img = $img_pd_cart->fetch_assoc()) {
                        ?>
                        <td class="image">
                            <a href="shop-single.php?idProduct=<?php echo $result['idProduct']?>"><img src="../Aura-Store/AuraDash/assets/images/product/<?php echo $result_img['ImageName']?>" alt=""></a>
                        </td>
                        <?php
                                }
                            }
                        ?>
                        <td class="product">
                            <a href="shop-single.php"><?php echo $result['ProductName']?></a>
                            <span>Mã sản phẩm: <?php echo $result['idProduct']?></span>
                        </td>
                        <td class="price">
                            <span class="amount"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                        </td>
                        <td class="quantity"><?php echo $result['QuantityBuy']?></td>
                        <td class="total">
                            <span class="total-amount"><?php echo $fm->adddotstring($result['Total']) ?>đ</span>
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
                <div class="cart-totals shop-single-content">
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
                                        <p class="price"><?php echo $fm->adddotstring($total)?>đ</p>
                                    </td>
                                </tr>
                                <?php
                                    if($total < 1000000){
                                        $ship = '30000';
                                        $total_bill = $total + '30000';
                                    }else{
                                        $ship = 'Miễn phí';
                                        $total_bill = $total;
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
                                        <p class="price"><?php echo $fm->adddotstring($total_bill)?>đ</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="container__address-content ">
                    <div class="container__address-content-hd">
                    <i class="container__address-content-hd-icon fa fa-money"></i>
                    <div>Phương thức thanh toán</div>
                    </div>
                    <ul class="shipping-list checkout-payment">
                    <li class="cus-radio">
                        <input type="radio" name="checkout" value="cash" onclick="removeDiv()" id="cash" checked>
                        <label for="cash">
                            <span>Thanh toán khi nhận hàng</span>
                        </label>
                    </li>
                    <li class="cus-radio payment-radio">
                        <input type="radio" name="checkout" onclick="showMomoModal()" value="momo" id="momo" >
                        <label for="momo">
                            <span>Momo</span>
                        </label>
                    </li>
                    <li class="cus-radio payment-radio">
                        <input type="radio" name="checkout" onclick="showZaloModal()" value="zalo" id="zalo" >
                        <label for="zalo">
                            <span>Zalo Pay</span>
                        </label>
                    </li>
                    

                </ul>                   
                    </div>
                    <div class="dynamic-checkout-button disabled ">
                        <div class="checkout-checkbox">
                            <input type="checkbox" id="disabled">
                            <label for="disabled"><span></span> Tôi đồng ý với các điều khoản và điều kiện </label>

                        </div>
                        
                        
                        <div class="cart-total-btn checkout-btn">
                            <button name="order" type="submit" class="btn btn-primary btn-block btnorder" style="max-width:100%;">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Cart End-->
</form>

<?php
    }
?>

<?php
    include 'inc/footer.php';
?>
