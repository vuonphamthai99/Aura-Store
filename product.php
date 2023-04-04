<?php
    include 'inc/header.php';
?>

<?php
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $product_all = $pd->show_product();
    $product_count = mysqli_num_rows($product_all);
    $product_button = ceil($product_count/24);

    if(!isset($_GET['sort']) || $_GET['sort']==NULL) $sort = 0;
    else $sort = $_GET['sort'];
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/spbn.png);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Sản phẩm</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Shop Start-->
<div class="shop-page section-padding-6">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">

                <div class="shop-banner">
                    <a href="#"><img src="assets/images/estee.png" alt=""></a>
                </div>


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
                                <?php
                                    if($sort && $sort == "asc") echo '<span class="select-input__price">Giá: Thấp đến Cao</span>';
                                    else if($sort && $sort == "desc") echo '<span class="select-input__price">Giá: Cao đến Thấp</span>';
                                    else echo '<span class="select-input__price">Giá</span>';
                                ?>
                                <i class="select-input__icon fa fa-angle-down"></i>
                                <ul class="select-input__list">
                                    <li class="select-input__item"><a href="?sort=asc">Giá: Thấp đến Cao</a></li>
                                    <li class="select-input__item"><a href="?sort=desc">Giá: Cao đến Thấp</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="top-bar-page-amount">
                        <p>Hiển thị 1 - 24 trong <?php echo $product_count?> sản phẩm</p>
                    </div>
                </div>
                <!--Shop Top Bar End-->


                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="grid" role="tabpanel">
                        <div class="row">
                            <?php
                                $pdlist = $pd->getproduct_transpage();
                                if($sort && $sort == "asc"){
                                    $pdlist = $pd->getproduct_transpage_price_asc();
                                }else if($sort && $sort == "desc"){
                                    $pdlist = $pd->getproduct_transpage_price_desc();
                                }
                                if($pdlist) {
                                    while($result = $pdlist->fetch_assoc()) {
                            ?>
                            <div class="col-lg-4 col-sm-6">
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
                    <!-- <div class="tab-pane fade" id="list" role="tabpanel">
                        <div class="single-product product-list">
                            <div class="product-image">
                                <a href="shop-single.php">
                                    <img src="assets/images/product/product-4.jpg" alt="">
                                </a>

                                <div class="action-links">
                                    <ul>
                                        <li><a href="javascript:void(0);" data-tooltip="tooltip" data-placement="left" title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <ul class="rating">
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                    <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                </ul>
                                <h4 class="product-name"><a href="shop-single.php">Foxglove Flower</a></h4>
                                <div class="price-box">
                                    <span class="current-price">$79.00</span>
                                </div>
                                <p>we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of...</p>

                                <ul class="action-links">
                                    <li><a href="javascript:void(0);" class="add-cart" data-tooltip="tooltip" data-placement="top" title="Add to cart"> Add to cart </a></li>
                                    <li><a href="javascript:void(0);" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist" class="wishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="javascript:void(0);" data-tooltip="tooltip" data-placement="top" title="Compare" class="compare"><i class="icon-sliders"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div>

                <?php
                    $next_page = $page+1;
                    $previous_page = $page-1;
                    if($next_page > $product_button){
                        $next_page = $page;
                    }else {
                        $next_page = $page+1;
                    }      
                    if($previous_page < 1){
                        $previous_page = $page;
                    }else {
                        $previous_page = $page-1;
                    }   
                ?>

                <?php if($sort != '0'){ ?>
                <!--Pagination Start-->
                <div class="page-pagination">
                    <ul class="pagination justify-content-center">
                        <li <?php if($page==1){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link prev" href="?page=<?php echo $previous_page?>&sort=<?php echo $sort?>">Prev</a></li>

                        <?php
                            for($i = 1; $i<=$product_button; $i++){
                        ?>
                                <li class="page-item">
                                    <a href="?page=<?php echo $i?>&sort=<?php echo $sort?>" <?php if($i==$page){ echo 'class="page-link active"';}?> class="page-link"><?php echo $i ?></a>
                                </li>
                        <?php
                            }
                        ?>                    
                        
                        <li <?php if($page==$product_button){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link next" href="?page=<?php echo $next_page?>&sort=<?php echo $sort?>">Next</a></li>
                    </ul>
                </div>
                <!--Pagination End-->
                <?php 
                    }else{ 
                ?>
                <!--Pagination Start-->
                <div class="page-pagination">
                    <ul class="pagination justify-content-center">
                        <li <?php if($page==1){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link prev" href="?page=<?php echo $previous_page ?>">Prev</a></li>

                        <?php
                            for($i = 1; $i<=$product_button; $i++){
                        ?>
                                <li class="page-item">
                                    <a href="product.php?page=<?php echo $i ?>" <?php if($i==$page){ echo 'class="page-link active"';}?> class="page-link"><?php echo $i ?></a>
                                </li>
                        <?php
                            }
                        ?>                    
                        
                        <li <?php if($page==$product_button){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link next" href="?page=<?php echo $next_page ?>">Next</a></li>
                    </ul>
                </div>
                <!--Pagination End-->
                <?php } ?>
            </div>
            <div class="col-lg-3">
                <div class="shop-sidebar">


                    <!--Sidebar Categories Start-->
                    <div class="sidebar-categories">
                        <h3 class="widget-title">Danh mục tùy chỉnh</h3>

                        <ul class="categories-list">
                            <li><a href="bestsell_product.php">Sản phẩm bán chạy</a></li>
                            <li><a href="sale_product.php">Sản phẩm đang SALE</a></li>
                            <li><a href="featured_product.php">Sản phẩm nổi bật</a></li>
                            <li><a href="new_product.php">Sản phẩm mới</a></li>
                        </ul>
                    </div>
                    <!--Sidebar Categories End-->



                    <!--Sidebar Categories Start-->
                    <div class="sidebar-categories">
                        <h3 class="widget-title">Danh mục sản phẩm</h3>

                        <ul class="categories-list">
                            <?php
                                $catlist = $category->show_list_category();
                                if($catlist) {
                                    while($result = $catlist->fetch_assoc()) {
                            ?>
                            <li><a href="category.php?idCategory=<?php echo $result['idCategory']?>"><?php echo $result['CategoryName']?></a></li>
                            <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                    <!--Sidebar Categories End-->

                    <!--Sidebar Brands Start-->
                    <div class="sidebar-categories">
                        <h3 class="widget-title">Thương hiệu</h3>

                        <ul class="categories-list">
                            <?php
                                $brandlist = $brand->show_list_brand();
                                if($brandlist) {
                                    while($result = $brandlist->fetch_assoc()) {
                            ?>
                            <li><a href="brand.php?idBrand=<?php echo $result['idBrand']?>"><?php echo $result['BrandName']?></a></li>
                            <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                    <!--Sidebar Brands End-->

                    <!--Sidebar Color Start-->
                    <!-- <div class="sidebar-color">
                        <h3 class="widget-title">Color</h3>

                        <ul class="color-list">
                            <li class="active"> <span data-color="#ff0000"></span> Red</li>
                            <li> <span data-color="#008000"></span> Green</li>
                            <li> <span data-color="#0000ff"></span> Blue</li>
                            <li> <span data-color="#ffff00"></span> Yellow</li>
                            <li> <span data-color="#ffffff"></span> White</li>
                            <li> <span data-color="#ffd700"></span> Gold</li>
                        </ul>
                    </div> -->
                    <!--Sidebar Color End-->



                    <!--Sidebar Size Start-->
                    <!-- <div class="sidebar-size">
                        <h3 class="widget-title">Size</h3>

                        <ul class="size-list">
                            <li><a href="javascript:void(0)">S</a></li>
                            <li><a href="javascript:void(0)">M</a></li>
                            <li><a href="javascript:void(0)">L</a></li>
                            <li><a href="javascript:void(0)">Xl</a></li>
                            <li><a href="javascript:void(0)">XXl</a></li>
                        </ul>
                    </div> -->
                    <!--Sidebar Size End-->


                    <!--Sidebar Size Start-->
                    <div class="sidebar-banner">
                        <a href="#"><img src="assets/images/lancome.png" alt=""></a>
                    </div>
                    <!--Sidebar Size End-->


                    <!--Sidebar Product Start-->
                    <div class="sidebar-product">
                        <h3 class="widget-title">Top sản phẩm bán chạy</h3>

                        <ul class="product-list">
                            <?php
                                $list_product_top_best_sell = $pd->show_product_top_best_sell();
                                if($list_product_top_best_sell) {
                                    while($result = $list_product_top_best_sell->fetch_assoc()) {
                            ?>
                            <li>
                                <div class="single-mini-product">
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
                                    </div>
                                    <div class="product-content">
                                        <h4 class="title"><a href="shop-single.php?idProduct=<?php echo $result['idProduct']?>"><?php echo $result['ProductName']?></a></h4>
                                        <!-- <ul class="rating">
                                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                            <li class="rating-on"><i class="fa fa-star-o"></i></li>
                                        </ul> -->
                                        <div class="price-box">
                                            <?php
                                                $get_time_sale = $pd->get_time_sale($idpd);
                                                $SalePrice = 0;
                                                if($get_time_sale) {
                                                    while($result_time_sale = $get_time_sale->fetch_assoc()) {
                                                        $SalePrice = $result['Price'] - ($result['Price']/100)*$result_time_sale['Discount'];
                                                    }
                                                }
                                            ?>

                                            <?php
                                                if($SalePrice != '0'){
                                            ?>
                                                <span class="old-price"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                                                <span class="current-price text-primary"><?php echo $fm->adddotstring(round($SalePrice,-3))?>đ</span>
                                            <?php
                                                }else{
                                            ?>
                                                <span class="current-price text-primary"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                    <!--Sidebar Product End-->

                    <!-- Sidebar Tags Start
                    <div class="sidebar-tags">
                        <h3 class="widget-title">Tags</h3>

                        <ul class="tags-list">
                            <li><a href="#">black</a></li>
                            <li><a href="#">blue</a></li>
                            <li><a href="#">fiber</a></li>
                            <li><a href="#">gold</a></li>
                            <li><a href="#">gray</a></li>
                            <li><a href="#">green</a></li>
                            <li><a href="#">I</a></li>
                            <li><a href="#">leather</a></li>
                        </ul>
                    </div>
                    Sidebar Tags End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--Shop End-->

<?php
    include 'inc/footer.php';
?>