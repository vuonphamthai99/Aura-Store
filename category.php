<?php
    include 'inc/header.php';
?>

<?php
	if(isset($_GET['idCategory'])){
        $idCategory = $_GET['idCategory'];
    }

    if(!isset($_GET['sort']) || $_GET['sort']==NULL) $sort = 0;
    else $sort = $_GET['sort'];
?>

<?php
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    if($sort && $sort != '0') $product_all = $pd->getproduct_bycat_transpage_price_asc($idCategory);
    else $product_all = $pd->getproduct_bycat_transpage($idCategory);
    if($product_all){
        $product_count = mysqli_num_rows($product_all);
    }else{
        $product_count = 1;
    }
    $product_button = ceil($product_count/16);
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/pexels-karolina-grabowska-4202326.jpg);">
    <div class="container">
        <?php
            $cat = $category->show_cat_byid($idCategory);
            if($cat) {
                while($result = $cat->fetch_assoc()) {
        ?>
        <div class="page-banner-content text-center">
            <h2 class="title"><?php echo $result['CategoryName']?></h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $result['CategoryName']?></li>
            </ol>
        </div>
        <?php   
                }
            }
        ?>
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
                        <?php
                            if($sort && $sort == "asc") echo '<span class="select-input__price">Giá: Thấp đến Cao</span>';
                            else if($sort && $sort == "desc") echo '<span class="select-input__price">Giá: Cao đến Thấp</span>';
                            else if($sort && $sort == "bestsells") echo '<span class="select-input__price">Bán chạy</span>';
                            else if($sort && $sort == "datedesc") echo '<span class="select-input__price">Ngày, mới nhất đến cũ nhất</span>';
                            else if($sort && $sort == "dateasc") echo '<span class="select-input__price">Ngày, cũ nhất đến mới nhất</span>';
                            else echo '<span class="select-input__price">Nổi bật</span>';
                        ?>
                        <i class="select-input__icon fa fa-angle-down"></i>
                        <ul class="select-input__list">
                            <li class="select-input__item"><a href="?idCategory=<?php echo $idCategory;?>">Nổi bật</a></li>
                            <li class="select-input__item"><a href="?idCategory=<?php echo $idCategory;?>&sort=bestsells">Bán chạy</a></li>
                            <li class="select-input__item"><a href="?idCategory=<?php echo $idCategory;?>&sort=desc">Giá: Cao đến Thấp</a></li>
                            <li class="select-input__item"><a href="?idCategory=<?php echo $idCategory;?>&sort=asc">Giá: Thấp đến Cao</a></li>
                            <li class="select-input__item"><a href="?idCategory=<?php echo $idCategory;?>&sort=datedesc">Ngày, mới nhất đến cũ nhất</a></li>
                            <li class="select-input__item"><a href="?idCategory=<?php echo $idCategory;?>&sort=dateasc">Ngày, cũ nhất đến mới nhất</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="top-bar-page-amount">
                <p>Hiển thị 1 - 16 trong <?php echo $product_count?> sản phẩm</p>
            </div>
        </div>
        <!--Shop Top Bar End-->


        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="grid" role="tabpanel">
                <div class="row">
                    <?php
                        $pd_by_cat = $pd->getproduct_bycat_transpage($idCategory);
                        if($sort && $sort == "asc"){
                            $pd_by_cat = $pd->getproduct_bycat_transpage_price_asc($idCategory);
                        }else if($sort && $sort == "desc"){
                            $pd_by_cat = $pd->getproduct_bycat_transpage_price_desc($idCategory);
                        }else if($sort && $sort == "bestsells"){
                            $pd_by_cat = $pd->getproduct_bycat_transpage_bestsells($idCategory);
                        }else if($sort && $sort == "datedesc"){
                            $pd_by_cat = $pd->getproduct_bycat_transpage_new($idCategory);
                        }else if($sort && $sort == "dateasc"){
                            $pd_by_cat = $pd->getproduct_bycat_transpage_old($idCategory);
                        }
                        if($pd_by_cat) {
                            while($result = $pd_by_cat->fetch_assoc()) {
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
                                        <li><a href="cart.php" data-tooltip="tooltip" data-placement="left" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>
                                        <li><a class="addtoCmp"  id="<?php echo $result['idProduct'] ?>" data-toggle="modal" data-target="#select-products" data-tooltip="tooltip" data-placement="left" title="So sánh"><i class="icon-sliders"></i></a></li>
                                        <li><a href="wishlist.php" data-tooltip="tooltip" data-placement="left" title="Add to Wishlist"><i class="icon-heart"></i></a></li>
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
                                <h4 class="product-name"><a href="shop-single.php"><?php echo $result['ProductName']?></a></h4>
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
                <li <?php if($page==1){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link prev" href="idCategory=<?php echo $idCategory;?>&page=<?php echo $previous_page?>&sort=<?php echo $sort?>">Prev</a></li>

                <?php
                    for($i = 1; $i<=$product_button; $i++){
                ?>
                        <li class="page-item">
                            <a href="idCategory=<?php echo $idCategory;?>&page=<?php echo $i?>&sort=<?php echo $sort?>" <?php if($i==$page){ echo 'class="page-link active"';}?> class="page-link"><?php echo $i ?></a>
                        </li>
                <?php
                    }
                ?>                    
                
                <li <?php if($page==$product_button){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link next" href="idCategory=<?php echo $idCategory;?>&page=<?php echo $next_page?>&sort=<?php echo $sort?>">Next</a></li>
            </ul>
        </div>
        <!--Pagination End-->
        <?php 
            }else{ 
        ?>
        <!--Pagination Start-->
        <div class="page-pagination">
            <ul class="pagination justify-content-center">
                <li <?php if($page==1){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link prev" href="?idCategory=<?php echo $idCategory?>&page=<?php echo $previous_page ?>">Prev</a></li>

                <?php
                    for($i = 1; $i<=$product_button; $i++){
                ?>
                        <li class="page-item">
                            <a href="?idCategory=<?php echo $idCategory?>&page=<?php echo $i ?>" <?php if($i==$page){ echo 'class="page-link active"';}?> class="page-link"><?php echo $i ?></a>
                        </li>
                <?php
                    }
                ?>                    
                
                <li <?php if($page==$product_button){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link next" href="?idCategory=<?php echo $idCategory?>&page=<?php echo $next_page ?>">Next</a></li>
            </ul>
        </div>
        <!--Pagination End-->
        <?php } ?>
    </div>
</div>
<!--Shop End-->

<?php
    include 'inc/footer.php';
?>
