<?php
    include 'inc/header.php';
?>

<?php
    $idCustomer = Session::get('customer_id');
    if(isset($_GET['idCustomer'])){
        $del_all_cart = $ct->del_all_data_cart($idCustomer);
    }

    if(isset($_GET['idCart'])){
        $idCart = $_GET['idCart'];
        $delcart = $ct->del_product_cart($idCart);
    }

//     if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatecart'])){
// 		$updateCart = $ct->update_cart($_POST,  $idCustomer);
// 	}

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_qty'])){
        $update_quantity_cart = $ct->update_quantity_cart($_POST);
	}
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/pexels-karolina-grabowska-4202326.jpg
);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Giỏ hàng</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<?php
    $pd_cart = $ct->get_product_cart();
    if($pd_cart) {
        $total = 0;
?>
<!--Cart Start-->
<div class="cart-page section-padding-5">
    <div class="container">
        <?php
            if(isset($updateCart)){
                echo $updateCart;
            }
        ?>
        <form action="" method="POST">
        <div class="cart-table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="image">Hình Ảnh</th>
                        <th class="product">Sản Phẩm</th>
                        <th class="price">Giá</th>
                        <th class="quantity">Số Lượng</th>
                        <th class="total">Tổng Giá</th>
                        <th class="remove">Xóa</th>
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
                        <form method="POST">
                        <td class="quantity">
                            <div class="quantity d-inline-flex">
                                <button type="submit" name="update_qty" class="sub"><i class="ti-minus"></i></button>
                                <input type="number" name="QuantityBuy[<?php echo $result['idCart']?>]" min="1" max="<?php echo $result['Quantity']?>" value="<?php echo $result['QuantityBuy']?>" class="qty_input" style="margin:0;" required/>
                                 <!--<input type="number" name="QuantityBuy[<?php echo $result['idProduct']?>]" min="1" max="<?php echo $result['Quantity']?>" value="<?php echo $result['QuantityBuy']?>" class="qty_input" required/> -->
                                <button type="submit" name="update_qty" class="add"><i class="ti-plus"></i></button>
                            </div>
                        </td>
                        </form>
                        <td class="total">
                            <span class="total-amount"><?php echo $fm->adddotstring($result['Total']) ?>đ</span>
                        </td>
                        <td class="remove">
                            <a href="?idCart=<?php echo $result['idCart']?>" onclick="return confirm('Bạn có muốn xóa sản phẩm <?php echo $result['ProductName']?> không?');"><i class="ti-close"></i></a>
                        </td>
                    </tr>
                    <?php
                            }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="cart-btn">
            <div class="cart-btn-left">
                <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
            </div>
            <div class="cart-btn-right">
                <a href="?idCustomer=<?php echo $idCustomer?>" onclick="return confirm('Bạn có muốn xóa toàn bộ sản phẩm không?');" class="btn">Xóa giỏ hàng</a>
                 <!--<button type="submit" name="updatecart" class="btn">Cập nhật giỏ hàng</button> -->
            </div>
        </div>
        </form>

        <div class="row">
            <!-- <div class="col-lg-4">
                <div class="cart-shipping">
                    <div class="cart-title">
                        <h4 class="title">Calculate Shipping</h4>
                        <p>Estimate your shipping fee *</p>
                    </div>
                    <div class="cart-form mt-25">
                        <p>Calculate shipping</p>
                        <form action="#">
                            <div class="single-select2">
                                <div class="form-select2">
                                    <select class="select2">
                                        <option value="0">Select a country…</option>
                                        <option value="1">Bangladesh</option>
                                        <option value="2">Canada</option>
                                        <option value="3">Colombia</option>
                                        <option value="4">Indonesia</option>
                                        <option value="5">Italy</option>
                                        <option value="6">Pakistan</option>
                                        <option value="7">Turkey</option>
                                    </select>
                                </div>
                            </div>
                            <div class="single-select2">
                                <div class="form-select2">
                                    <select class="select2">
                                        <option value="">Select an option…</option>
                                        <option value="BAG">Bagerhat</option>
                                        <option value="BAN">Bandarban</option>
                                        <option value="BAR">Barguna</option>
                                        <option value="BARI">Barisal</option>
                                        <option value="BHO">Bhola</option>
                                        <option value="BOG">Bogra</option>
                                        <option value="BRA">Brahmanbaria</option>
                                        <option value="CHA">Chandpur</option>
                                        <option value="CHI">Chittagong</option>
                                        <option value="CHU">Chuadanga</option>
                                        <option value="COM">Comilla</option>
                                        <option value="COX">Cox's Bazar</option>
                                        <option value="DHA">Dhaka</option>
                                        <option value="DIN">Dinajpur</option>
                                        <option value="FAR">Faridpur </option>
                                        <option value="FEN">Feni</option>
                                        <option value="GAI">Gaibandha</option>
                                        <option value="GAZI">Gazipur</option>
                                        <option value="GOP">Gopalganj</option>
                                        <option value="HAB">Habiganj</option>
                                        <option value="JAM">Jamalpur</option>
                                        <option value="JES">Jessore</option>
                                        <option value="JHA">Jhalokati</option>
                                        <option value="JHE">Jhenaidah</option>
                                        <option value="JOY">Joypurhat</option>
                                        <option value="KHA">Khagrachhari</option>
                                        <option value="KHU">Khulna</option>
                                        <option value="KIS">Kishoreganj</option>
                                        <option value="KUR">Kurigram</option>
                                        <option value="KUS">Kushtia</option>
                                        <option value="LAK">Lakshmipur</option>
                                        <option value="LAL">Lalmonirhat</option>
                                        <option value="MAD">Madaripur</option>
                                        <option value="MAG">Magura</option>
                                        <option value="MAN">Manikganj </option>
                                        <option value="MEH">Meherpur</option>
                                        <option value="MOU">Moulvibazar</option>
                                        <option value="MUN">Munshiganj</option>
                                        <option value="MYM">Mymensingh</option>
                                        <option value="NAO">Naogaon</option>
                                        <option value="NAR">Narail</option>
                                        <option value="NARG">Narayanganj</option>
                                        <option value="NARD">Narsingdi</option>
                                        <option value="NAT">Natore</option>
                                        <option value="NAW">Nawabganj</option>
                                        <option value="NET">Netrakona</option>
                                        <option value="NIL">Nilphamari</option>
                                        <option value="NOA">Noakhali</option>
                                        <option value="PAB">Pabna</option>
                                        <option value="PAN">Panchagarh</option>
                                        <option value="PAT">Patuakhali</option>
                                        <option value="PIR">Pirojpur</option>
                                        <option value="RAJB">Rajbari</option>
                                        <option value="RAJ">Rajshahi</option>
                                        <option value="RAN">Rangamati</option>
                                        <option value="RANP">Rangpur</option>
                                        <option value="SAT">Satkhira</option>
                                        <option value="SHA">Shariatpur</option>
                                        <option value="SHE">Sherpur</option>
                                        <option value="SIR">Sirajganj</option>
                                        <option value="SUN">Sunamganj</option>
                                        <option value="SYL">Sylhet</option>
                                        <option value="TAN">Tangail</option>
                                        <option value="THA">Thakurgaon</option>
                                    </select>
                                </div>
                            </div>
                            <div class="single-form">
                                <input type="text" placeholder="Auratcode/ziip">
                            </div>
                            <div class="cart-form-btn">
                                <button class="btn btn-primary">Update totals</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-coupon">
                    <div class="cart-title">
                        <h4 class="title">Coupon Code</h4>
                        <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="cart-form mt-25">
                        <form action="#">
                            <div class="single-form">
                                <input type="text" placeholder="Enter your coupon code..">
                            </div>
                            <div class="cart-form-btn">
                                <button class="btn btn-primary">Apply Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
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
                                        <p class="value">Thành tiền</p>
                                    </td>
                                    <td>
                                        <p class="price"><?php echo $fm->adddotstring($total) ?>đ</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-total-btn">
                        <a href="payment.php" class="btn btn-primary btn-block">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Cart End-->

<?php
    }else{
?>

<!--Empty Cart Start-->
<div class="empty-cart-page section-padding-5">
    <div class="container">
        <div class="empty-cart-content text-center">
            <h2 class="empty-cart-title">Giỏ hàng</h2>
            <div class="empty-cart-img">
                <img src="assets/images/cart.png" alt="">
            </div>
            <p>Giỏ hàng của bạn chưa có sản phẩm!</p>
            <a href="product.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Tiếp tục mua sắm</a>
        </div>
    </div>
</div>
<!--Empty Cart End-->

<?php
    }
?>

<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
</script>

<?php
    include 'inc/footer.php';
?>