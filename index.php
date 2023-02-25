<?php
    include 'inc/header.php';
?>

<!--Slider Start-->
<div class="slider-area">
    <div class="swiper-container slider-active">
        <div class="swiper-wrapper">
            <!--Single Slider Start-->
            <div class="single-slider swiper-slide animation-style-01" style="background-image: url(assets/images/slider/AURAbanner.png);">
                <div class="container">
                    <div class="slider-content">
                        <h5 class="sub-title">Giảm 20% cho  <br> Thành viên mới </h5>
                        <h2 class="main-title">Vẻ đẹp vượt qua mọi ước mơ</h2>
                        <p>Từ Điểm Bắt Đầu Đến Đích Đến Là Làn Da Khỏe Mạnh</p>

                        <ul class="slider-btn">
                            <li><a href="product.php" class="btn btn-round btn-primary">Bắt đầu mua sắm </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Single Slider End-->

            <!--Single Slider Start-->
            <div class="single-slider swiper-slide animation-style-01" style="background-image: url(assets/images/slider/AURAbanner.png);">
                <div class="container">
                     <div class="slider-content">
                        <h5 class="sub-title">Giảm 20% cho  <br> Thành viên mới </h5>
                        <h2 class="main-title">Vẻ đẹp vượt qua mọi ước mơ</h2>
                        <p>Từ Điểm Bắt Đầu Đến Đích Đến Là Làn Da Khỏe Mạnh</p>

                        <ul class="slider-btn">
                            <li><a href="product.php" class="btn btn-round btn-primary">Bắt đầu mua sắm</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Single Slider End-->
        </div>
        <!--Swiper Wrapper End-->

        <!-- Add Arrows -->
        <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
        <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>

        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>

    </div>
    <!--Swiper Container End-->
</div>
<!--Slider End-->



<!--Shipping Start-->
<div class="shipping-area section-padding-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="assets/images/shipping-icon/Free-Delivery.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Miễn phí vận chuyển </h5>
                        <p>Giao hàng miễn phí cho tất cả các đơn đặt hàng trên 1.000.000</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="assets/images/shipping-icon/Online-Order.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Đặt hàng online</h5>
                        <p>Đừng lo lắng, bạn có thể đặt hàng Trực tuyến trên Trang web của chúng tôi.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="assets/images/shipping-icon/Freshness.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Hiện đại </h5>
                        <p>Cập nhật những sản phẩm mới nhất </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-shipping">
                    <div class="shipping-icon">
                        <img src="assets/images/shipping-icon/Made-By-Artists.png" alt="">
                    </div>
                    <div class="shipping-content">
                        <h5 class="title">Hỗ trợ 24/7</h5>
                        <p>Đội ngũ hỗ trợ trưc tuyến chuyên nghiệp</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Shipping End-->



<!--New Product Start-->
<div class="new-product-area section-padding-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Sản phẩm mới</h2>
                    <p>Một sự pha trộn hoàn hảo giữa sáng tạo, năng lượng, giao tiếp, hạnh phúc và tình yêu. Hãy để chúng tôi sắp xếp nụ cười cho bạn.</p>
                </div>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="swiper-container product-active">
                <div class="swiper-wrapper">
                    <?php
                        $pdlist = $pd->show_new_pd();
                        if($pdlist) {
                            while($result = $pdlist->fetch_assoc()) {
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



<!--About Start-->
<div class="about-area section-padding-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="assets/images/about/FREESHIP.PNG" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <h2 class="title">Đại tiệc giảm giá sữa rửa mặt và tẩy trang</h2>
                    <p>Với hóa đơn trên 1.000.000đ quý khách hàng sẽ được freeship. Chương trình áp dụng khi giỏ hàng của quý khách có các sản phẩm sau đây:  </p>
                    <ul>
                        <li> La Roche Possay</li>
                        <li> Bioderma </li>
                        <li> Vichy </li>
                    </ul>
                    <div class="about-btn">
                        <a href="blog.php" class="btn btn-primary btn-round">Thêm chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--About End-->



<!--New Product Start-->
<div class="features-product-area section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Sản phẩm</h2>
                    <p>Một sự pha trộn hoàn hảo giữa sáng tạo, năng lượng, giao tiếp, hạnh phúc và tình yêu. Hãy để chúng tôi sắp xếp nụ cười cho bạn.</p>
                </div>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="product-tab-menu">
                <ul class="nav justify-content-center" role="tablist">
                    <li>
                        <a class="active" data-toggle="tab" href="#tab1" role="tab">Nổi bật</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab2" role="tab">Bán chạy</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab3" role="tab">Đang SALE</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content product-items-tab">
                <div class="tab-pane fade" id="tab3" role="tabpanel">
                    <div class="swiper-container product-active">
                        <div class="swiper-wrapper">
                            <?php
                                $pdlist = $pd->show_sale_pd();
                                if($pdlist) {
                                    while($result = $pdlist->fetch_assoc()) {
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
                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                    <div class="swiper-container product-active">
                        <div class="swiper-wrapper">
                            <?php
                                $list_featured_pd = $pd->show_product_featured();
                                if($list_featured_pd) {
                                    while($result = $list_featured_pd->fetch_assoc()) {
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
                <div class="tab-pane fade" id="tab2" role="tabpanel">
                    <div class="swiper-container product-active">
                        <div class="swiper-wrapper">
                            <?php
                                $list_best_sellers_pd = $pd->show_product_best_sell();
                                if($list_best_sellers_pd) {
                                    while($result = $list_best_sellers_pd->fetch_assoc()) {
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
    </div>
</div>
<!--New Product End-->



<!--Testimonial Start-->
<div class="testimonial-area" style="background-image: url(assets/images/bn.png);">
    <div class="container">
        <div class="swiper-container testimonial-active">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="single-testimonial text-center">
                        <p>Phụ nữ giống như một cuốn sách đối với đàn ông. Nếu bìa không đẹp họ chẳng thèm lật xem nội dung bên trong. Trở thành người đẹp ngay hôm nay với AURA Cosmetics.</p>

                        <div class="testimonial-author">
                            <img src="assets/images/logo.png" alt="">
                            <!--<span class="author-name">AURA Cosmetics</span>-->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="single-testimonial text-center">
                        <p>Phải đợi đến hoàng hôn thì mới biết vẻ đẹp của bình minh thơ mộng. Và phải đợi tới tuổi xế chiều thì mới hiểu rõ như thế nào là người phụ nữ đẹp.</p>

                        <div class="testimonial-author">
                            <img src="assets/images/logo.png" alt="">
                            <!-- <span class="author-name">Xuan/ Hy/ Pham </span> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Arrows -->
            <div class="swiper-next"><i class="fa fa-angle-right"></i></div>
            <div class="swiper-prev"><i class="fa fa-angle-left"></i></div>
        </div>
    </div>
</div>
<!--Testimonial End-->



<!--Experts Start-->
<div class="experts-area section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Thương Hiệu Nổi Bật </h2>
                    <p>AURA Cosmetics giới thiệu đến bạn Top 4 thương hiệu mỹ phẩm nổi tiếng trên thế giới.</p>
                </div>
            </div>
        </div>
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
</div>
<!--Experts End-->



<!--Blog Start-->
<div class="blog-area blog-bg section-padding-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-9 col-sm-11">
                <div class="section-title text-center">
                    <h2 class="title">Bài viết của chúng tôi</h2>
                    <p>Bậc dậy săn sale cùng AURA Cosmetics.</p>
                </div>
            </div>
        </div>
        <div class="blog-wrapper">
            <div class="swiper-container blog-active">
                <div class="swiper-wrapper">
                    <?php
                $bloglist = $blog->get_blog();
                                            if($bloglist) {
                                                while($result_blog = $bloglist->fetch_assoc()) {
                                                    $date = date_create($result_blog['Date'])
                                        ?>
                    <div class="swiper-slide">
                        <div class="single-blog">
                            <div class="blog-image">
                                <a href="desc-blog.php?idBlog=<?php echo $result_blog['idBlog'];?>"><img style="width: 372px;;height: 211px;;" src="./AuraDash/assets/images/<?php echo $result_blog['BlogImage'];?>" alt=""></a>
                            </div>
                            <div class="blog-content">
                                <h4 class="title"><a href="desc-blog.php?idBlog=<?php echo $result_blog['idBlog'];?>"><?php echo $result_blog['BlogTitle'];?></a></h4>
                                <div class="articles-date">

                                    <p>By <span>Thanh Xuan /  <?php echo date_format($date, "d-m-Y");?></span></p>
                                </div>
                                <div class="text-limit-news" ><?php echo $result_blog['BlogDesc'];?></div>

                                <div class="blog-footer">
                                    <a class="more" href="desc-blog.php?idBlog=<?php echo $result_blog['idBlog'];?>">Tìm hiểu thêm</a>
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
<!--Blog End-->



<!--Newsletter Start-->
<!-- <div class="newsletter-area section-padding-5">
    <div class="container">
        <div class="newsletter-form">
            <div class="section-title text-center">
                <h2 class="title">Kết nối với chúng tôi!</h2>
            </div>
            <div class="form-wrapper">
                <input type="text" placeholder="Email">
                <button>Đăng ký</button>
                <i class="icon-mail"></i>
            </div>
        </div>
    </div>
</div> -->
<!--Newsletter End-->

<?php
    include 'inc/footer.php';
?>