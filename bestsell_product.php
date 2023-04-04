<?php
    include 'inc/header.php';
?>

<?php
    $product_all = $pd->show_product_best_sell();
    if($product_all){
        $product_count = mysqli_num_rows($product_all);
    }else{
        $product_count = 0;
    }
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Sản phẩm bán chạy</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm bán chạy</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Shop Start-->
<div class="shop-page section-padding-6">
    <div class="container">

        <!--Shop Top Bar Start-->
        <div class="shop-top-bar d-sm-flex align-items-center justify-content-between">
            <div class="top-bar-btn">
                <ul class="nav" role="tablist">
                    <li class="nav-item"><a class="nav-link grid active" data-toggle="tab" href="#grid" role="tab"></a></li>
                    <li class="nav-item"><a class="nav-link list" data-toggle="tab" href="#list" role="tab"></a></li>
                </ul>
            </div>
            <div class="top-bar-sorter">
                <div class="sorter-wrapper d-flex align-items-center">
                    <label>Sắp xếp theo:</label>
                    <div class="select-input">
                        <span class="select-input__price">Bán chạy</span>
                        <i class="select-input__icon fa fa-angle-down"></i>
                    </div>
                </div>
            </div>
            <div class="top-bar-page-amount">
                <p>Hiển thị 1 - 20 trong <?php echo $product_count?> sản phẩm</p>
            </div>
        </div>
        <!--Shop Top Bar End-->


        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="grid" role="tabpanel">
                <div class="row">
                    <?php
                        $list_best_sellers_pd = $pd->show_product_best_sell();
                        if($list_best_sellers_pd) {
                            while($result = $list_best_sellers_pd->fetch_assoc()) {
                    ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-product">
                            <div class="product-image">
                                <?php
                                    $idpd = $result['idProduct'];
                                    $imglist = $pd->show_image_pd($idpd);
                                    if($imglist) {
                                        while($result_image = $imglist->fetch_assoc()) {
                                ?>
                                <a href="shop-single.php?idProduct=<?php echo $result_image['idProduct']?>">
                                    <img src="../Aura-Store/AuraDash/assets/images/product/<?php echo $result_image['ImageName']?>" alt="">
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
            </div>
        </div>
    </div>
</div>
<!--Shop End-->

<?php
    include 'inc/footer.php';
?>
