<?php
    include 'inc/header.php';
?>

<?php
	if(!isset($_GET['idProduct']) || $_GET['idProduct']==NULL){
        echo "<script>window.location ='error404.php'</script>";
    }else{
        $idProduct = $_GET['idProduct'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buynow'])){
        $login_check = Session::get('customer_login');
        if($login_check == false){
            header('Location: login.php');
        }else {
            $QuantityBuy = $_POST['QuantityBuy'];
            $AddtoCart = $ct->add_to_cart_buy($QuantityBuy, $idProduct);
        }
	}

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])){
        $login_check = Session::get('customer_login');
        if($login_check == false){
            header('Location: login.php');
        }else {
            $QuantityBuy = $_POST['QuantityBuy'];
            $AddtoCart = $ct->add_to_cart_add($QuantityBuy, $idProduct);
        }
	}
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/pexels-karolina-grabowska-4202326.jpg
);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Chi tiết sản phẩm</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <!-- <li class="breadcrumb-item"><a href="shop-grid-left-sidebar.php">Shop</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<?php
    $pdlist = $pd->getproductbyId($idProduct);
    if($pdlist) {
        while($result = $pdlist->fetch_assoc()) {
?>
<!--Shop Single Start-->
<div class="shop-single-page section-padding-4">
    <div class="container">
        <!--Shop Single Start-->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="shop-image">
                    <div class="shop-single-preview-image">
                        <?php
                            $img_pd = $pd->show_image_pd($idProduct);
                            if($img_pd) {
                                while($result_image = $img_pd->fetch_assoc()) {
                        ?>
                        <img class="product-zoom" src="../kngu/AuraDash/assets/images/product/<?php echo $result_image['ImageName']?>" alt="">
                        <?php
                                }
                            }
                        ?>
                        <?php
                            $get_time_sale = $pd->get_time_sale($idProduct);
                            $Discount = 0;
                            if($get_time_sale) {
                                while($result_time_sale = $get_time_sale->fetch_assoc()) {
                                    $Discount = $result_time_sale['Discount'];
                                    $SalePrice = $result['Price'] - ($result['Price']/100)*$Discount;
                        ?>
                        <span class="sticker-new label-sale">-<?php echo $Discount;?>%</span>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <div id="gallery_01" class="shop-single-thumb-image shop-thumb-active swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                                $imglist_slide = $pd->show_list_image_pd($idProduct);
                                if($imglist_slide) {
                                    while($result_image_slide = $imglist_slide->fetch_assoc()) {
                            ?>
                            <div class="swiper-slide single-product-thumb">
                                <a class="active" href="#" data-image="../kngu/AuraDash/assets/images/product/<?php echo $result_image_slide['ImageName']?>">
                                    <img src="../kngu/AuraDash/assets/images/product/<?php echo $result_image_slide['ImageName']?>" alt="">
                                </a>
                            </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>

                        <!-- Add Arrows -->
                        <div class="swiper-thumb-next"><i class="fa fa-angle-right"></i></div>
                        <div class="swiper-thumb-prev"><i class="fa fa-angle-left"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shop-single-content">
                    <h3 class="title"><?php echo $result['ProductName']?></h3>
                    <span class="product-sku">
                        <span>Mã sản phẩm: <?php echo $result['idProduct']?></span>    
                        <span class="text-primary ml-10">Đã bán: <?php echo $result['Sold']?></span>
                        <?php
                            $total_wish_product = $wishlist->total_wish_product($idProduct);
                            if($total_wish_product) {
                                while($result_total = $total_wish_product->fetch_assoc()) {
                        ?>
                        <span class="text-primary ml-10">Số người yêu thích: <?php echo $result_total['total_wish']?></span>  
                        <?php
                                }
                            }
                        ?>  
                    </span>
                    <!-- <div class="product-rating">
                        <ul class="rating-star">
                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div> -->
                    <div>
                        <?php
                            if($result['Quantity'] == '0')
                                echo '<span class="product-sku text-primary" style="font-weight:600; font-size: 22px;">HẾT HÀNG</span>';
                            else{
                        ?>
                        <span class="product-sku text-primary">Số lượng còn lại: <?php echo $result['Quantity']?></span>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="thumb-price">
                        <?php
                            if($Discount){
                        ?>
                            <span class="old-price"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                            <span class="current-price"><?php echo $fm->adddotstring(round($SalePrice,-3))?>đ</span>
                            <span class="discount"><?php echo $Discount?>%</span>
                        <?php
                            }else{
                        ?>
                            <span class="current-price"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="shortdes_pro"><?php echo $result['ShortDes_Pro']?></div>

                    <!-- <ul class="product-additional-information">
                        <li><button><i class="ti-ruler-pencil"></i> Size Guide</button></li>
                        <li><button><i class="fa fa-truck"></i> Shipping</button></li>
                        <li><button><i class="ti-email"></i> Ask About This product </button></li>
                    </ul> -->
                    <form action="" method="POST">
                    <div class="product-quantity d-flex flex-wrap align-items-center">
                        <span class="quantity-title">Số lượng: </span>
                            <div class="quantity d-flex">
                                <button type="button" class="sub"><i class="ti-minus"></i></button>
                                <input type="number" value="1" min="1" max="<?php echo $result['Quantity']?>" name="QuantityBuy" class="qty_input" required/>
                                <button type="button" class="add"><i class="ti-plus"></i></button>
                            </div>
                    </div>

                    <div class="product-action d-flex flex-wrap">
                        <div class="action">
                            <?php
                                if($result['Quantity'] == '0')
                                    echo '<button type="submit" name="add" class="btn btn-primary" style="pointer-events:none; cursor: not-allowed; opacity:0.6;">Thêm vào giỏ hàng</button>';
                                else
                                    echo '<button type="submit" name="add" class="btn btn-primary">Thêm vào giỏ hàng</button>';
                            ?>
                        </div>
                        <div class="action">
                            <a href="wishlist.php?idProduct=<?php echo $result['idProduct']?>"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>

                    <?php
                        if(isset($AddtoCart)){
                            echo $AddtoCart;
                        }
                    ?>

                    <div class="dynamic-checkout-button">
                        <div class="checkout-btn">
                            <?php
                                if($result['Quantity'] == '0')
                                    echo '<button type="submit" name="buynow" class="btn btn-primary" style="pointer-events:none; cursor: not-allowed; opacity:0.6;">Mua ngay</button>';
                                else
                                    echo '<button type="submit" name="buynow" class="btn btn-primary">Mua ngay</button>';
                            ?>
                        </div>
                    </div>
                    </form>

                    <div class="custom-payment-options">
                        <p>Phương thức thanh toán</p>

                        <ul class="payment-options">
                            <li><img style="height: 38px;width:38px;" src="assets/images/payment-icon/payment-1.png" alt=""></li>
                            <li><img style="height:38px;width:38px;" src="assets/images/payment-icon/payment-2.png" alt=""></li>
                        </ul>
                    </div>

                    <div class="social-share">
                        <span class="share-title">Chia sẻ:</span>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--Shop Single End-->



        <!--Shop Single info Start-->
        <div class="shop-single-info">
            <div class="shop-info-tab">
                <ul class="nav justify-content-center" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Mô tả sản phẩm</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Nhận xét</a></li> -->
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                    <div class="description">
                        <p><?php echo $result['DesProduct']?></p>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel">
                    <div class="reviews">
                        <h3 class="review-title">Nhận xét của khách hàng</h3>

                        <ul class="reviews-items">
                            <li>
                                <div class="single-review">
                                    <h6 class="name">Rosie Silva</h6>
                                    <div class="rating-date">
                                        <ul class="rating">
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span class="date">Oct 20, 2020</span>
                                    </div>

                                    <p>Proin bibendum dolor vitae neque ornare, vel mollis est venenatis. Orci varius natoque penatibus et magnis dis parturient montes, nascet</p>
                                </div>
                            </li>
                            <li>
                                <div class="single-review">
                                    <h6 class="name">Rosie Silva</h6>
                                    <div class="rating-date">
                                        <ul class="rating">
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span class="date">Oct 20, 2020</span>
                                    </div>

                                    <p>Proin bibendum dolor vitae neque ornare, vel mollis est venenatis. Orci varius natoque penatibus et magnis dis parturient montes, nascet</p>
                                </div>
                            </li>
                            <li>
                                <div class="single-review">
                                    <h6 class="name">Rosie Silva</h6>
                                    <div class="rating-date">
                                        <ul class="rating">
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                            <li class="rating-on"><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span class="date">Oct 20, 2020</span>
                                    </div>

                                    <p>Proin bibendum dolor vitae neque ornare, vel mollis est venenatis. Orci varius natoque penatibus et magnis dis parturient montes, nascet</p>
                                </div>
                            </li>
                        </ul>

                        <div class="reviews-form">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <label>Name</label>
                                            <input type="text" placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <label>Email</label>
                                            <input type="text" placeholder="john.smith@example.com">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="reviews-rating">
                                            <label>Rating</label>
                                            <ul id="rating" class="rating">
                                                <li class="star" title='Poor' data-value='1'><i class="fa fa-star-o"></i></li>
                                                <li class="star" title='Poor' data-value='2'><i class="fa fa-star-o"></i></li>
                                                <li class="star" title='Poor' data-value='3'><i class="fa fa-star-o"></i></li>
                                                <li class="star" title='Poor' data-value='4'><i class="fa fa-star-o"></i></li>
                                                <li class="star" title='Poor' data-value='5'><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <label>Body of Review (1500)</label>
                                            <textarea placeholder="Write your comments here"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <button class="btn btn-dark">Submit Review</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Shop Single info End-->
    </div>
</div>
<!--Shop Single End-->
<?php
        }
    }
?>


<!--New Product Start-->
<div class="new-product-area section-padding-2 mb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Sản phẩm liên quan</h2>
                    <!-- <p>A perfect blend of creativity, energy, communication, happiness and love. Let us arrange a smile for you.</p> -->
                </div>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="swiper-container product-active">
                <div class="swiper-wrapper">
                    <?php
                        $list_related_pd = $pd->show_product_related($idProduct);
                        if($list_related_pd) {
                            while($result = $list_related_pd->fetch_assoc()) {
                    ?>
                    <div class="swiper-slide">
                        <div class="single-product">
                            <div class="product-image">
                                <?php
                                    $idpd = $result['idProduct'];
                                    $imglist = $pd->show_image_pd($idpd);
                                    if($imglist) {
                                        while($result_image = $imglist->fetch_assoc()) {
                                ?>
                                <a href="shop-single.php?idProduct=<?php echo $result_image['idProduct']?>">
                                    <img src="../kngu/AuraDash/assets/images/product/<?php echo $result_image['ImageName']?>" alt="">
                                </a>
                                <?php
                                        }
                                    }
                                ?>

                                <?php
                                    $get_time_sale = $pd->get_time_sale($idpd);
                                    $SalePrice = 0;
                                    if($get_time_sale) {
                                        while($result_time_sale = $get_time_sale->fetch_assoc()) {
                                            $SalePrice = $result['Price'] - ($result['Price']/100)*$result_time_sale['Discount'];
                                ?>
                                    <div class="product-countdown">
                                        <div data-countdown="<?php echo $result_time_sale['SaleEnd']?>"></div>
                                    </div>
                                    <?php
                                        if($result['Quantity'] == '0')
                                            echo '<span class="sticker-new soldout-title">Hết hàng</span>';
                                        else{
                                    ?>
                                    <span class="sticker-new label-sale">-<?php echo $result_time_sale['Discount'];?>%</span>
                                    <?php
                                        }
                                    ?>
                                <?php
                                        }
                                    }else if($result['Quantity'] == '0') echo '<span class="sticker-new soldout-title">Hết hàng</span>';
                                ?>

                                <div class="action-links">
                                    <ul>
                                        <!-- <li><a href="cart.php" data-tooltip="tooltip" data-placement="left" title="Add to cart"><i class="icon-shopping-bag"></i></a></li> -->
                                        <li><a class="addtoCmp"  id="<?php echo $result['idProduct'] ?>" data-toggle="modal" data-target="#select-products" data-tooltip="tooltip" data-placement="left" title="So sánh"><i class="icon-sliders"></i></a></li>
                                        <li><a href="wishlist.php?idProduct=<?php echo $result['idProduct']?>" data-tooltip="tooltip" data-placement="left" title="Thêm vào danh sách yêu thích"><i class="icon-heart"></i></a></li>
                                        <!-- <li><a href="javascript:void(0);" data-tooltip="tooltip" data-placement="left" title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-eye"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <!-- <ul class="rating">
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                </ul> -->
                                <h4 class="product-name"><a href="shop-single.php?idProduct=<?php echo $result['idProduct']?>"><?php echo $result['ProductName']?></a></h4>
                                <div class="price-box">
                                    <?php
                                        if($SalePrice != '0'){
                                    ?>
                                        <span class="old-price"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                                        <span class="current-price"><?php echo $fm->adddotstring(round($SalePrice,-3))?>đ</span>
                                    <?php
                                        }else{
                                    ?>
                                        <span class="current-price"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>

                <!-- Add Arrows -->
                <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
                <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>
            </div>
        </div>
    </div>
</div>
<!--New Product End-->



<!--Brand Start-->
<!-- <div class="brand-area">
    <div class="container">
        <div class="expert-wrapper">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <a href="brand.php?idBrand=7">
                    <div class="single-expert text-center">
                        <div class="expert-image" style="width:250px;height:250px;">
                            <img src="assets/images/experts/e72dce47b1736c87be7c12927b978a6f.jpg" alt="">
                        </div>
                        <div class="expert-content">
                            <h4 class="name">Vichy</h4>
                            <p>Pháp</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="brand.php?idBrand=11">
                    <div class="single-expert text-center">
                        <div class="expert-image" style="width:250px;height:250px;">
                            <img src="assets/images/experts/la-roche-posay.jpg" alt="">
                        </div>
                        <div class="expert-content">
                            <h4 class="name">La Roche Posay</h4>
                            <p>Pháp</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="brand.php?idBrand=12">
                    <div class="single-expert text-center">
                        <div class="expert-image" style="width:250px;height:250px;">
                            <img src="assets/images/experts/images.png" alt="">
                        </div>
                        <div class="expert-content">
                            <h4 class="name">Estee Lauder</h4>
                            <p>Mỹ</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="brand.php?idBrand=13">
                    <div class="single-expert text-center">
                        <div class="expert-image" style="width:250px;height:250px;">
                            <img src="assets/images/experts/4bd03138320895.575fe001f10a2.jpg" alt="">
                        </div>
                        <div class="expert-content">
                            <h4 class="name">Lancome</h4>
                            <p>Pháp</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!--Brand End-->

<?php
    include 'inc/footer.php';
?>