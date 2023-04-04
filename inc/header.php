<?php
    ob_start();
    include 'lib/session.php';
    Session::init();
?>
<?php
    include_once 'lib/database.php';
    include_once 'helpers/format.php';
    spl_autoload_register(function($className){
        include_once "classes/".$className.".php";
    });
    $db = new Database();
    $fm = new Format();
    $cs = new customer();
    $ad = new address();
    $admin = new admin();
    $brand = new brand();
    $category = new category();
    $pd = new product();
    $wishlist = new wishlist();
    $ct = new cart();
    $sale = new sale();
    $report = new report();
    $compare = new compare();
    $blog = new blog();

?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
  date_default_timezone_set("Asia/Ho_Chi_Minh");
?>

<!doctype html>
<html class="no-js" lang="en">
<!-- Màu button  #f98c8c, màu nền #FFEFD5 -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AuraShop</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="assets/css/vendor/plazaicon.css">
    <link rel="stylesheet" href="assets/css/vendor/themify-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/select2.min.css">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="assets/css/helper.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">


    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <!-- <link rel="stylesheet" href="assets/css/plugins-min/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> -->





    <div class="main-wrapper">


        <!--Top Notification Start-->
        <!-- <div class="top-notification-bar text-center">
            <div class="container">
                <div class="notification-entry">
                    <p>Tất cả sản phẩm nổi bật giảm giá 50% <a href="#">Mua ngay</a></p>
                </div>
            </div>
            <div class="notification-close">
                <button class="notification-close-btn"><i class="fa fa-times"></i></button>
            </div>
        </div> -->
        <!--Top Notification End-->

        <!--Header Section Start-->
        <div class="header-section d-none d-lg-block">
            <div class="main-header">
                <div class="container position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <div class="header-logo">
                                <a href="index.php"><img src="assets/images/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-7 position-static">
                            <div class="site-main-nav">
                                <nav class="site-nav">
                                    <ul>
                                        <li><a href="index.php">Trang chủ</a></li>
                                        <li>
                                            <a href="product.php">Cửa hàng <span class="new">Mới</span></a>

                                            <ul class="mega-sub-menu">
                                                <li class="mega-dropdown">
                                                    <a class="mega-title" href="product.php">Danh mục</a>

                                                    <ul class="mega-item">
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
                                                </li>
                                                <li class="mega-dropdown">
                                                    <a class="mega-title" href="product.php">Thương hiệu</a>

                                                    <ul class="mega-item">
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
                                                </li>
                                                <li class="mega-dropdown">
                                                    <a class="mega-title" href="product.php">Sản phẩm</a>

                                                    <ul class="mega-item">
                                                        <li><a href="new_product.php">Sản phẩm mới</a></li>
                                                        <li><a href="bestsell_product.php">Sản phẩm bán chạy</a></li>
                                                        <li><a href="featured_product.php">Sản phẩm nổi bật</a></li>
                                                        <li><a href="sale_product.php">Sản phẩm đang SALE</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-dropdown">
                                                    <a class="menu-banner" href="#">
                                                        <img src="assets/images/bannerr.jpg" alt="">
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                          <li>
                                            <a href="#">Tin tức</a>

                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="blog.php">AURA DEALS</a>
                                                   
                                                </li>
                                                <!--<li>-->
                                                <!--    <a href="blog-left-sidebar.php">SKINCARE TIPS</a>-->
                                                <!--</li>-->
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="about.php">Về chúng tôi</a>
                                        </li>
                                        <li><a href="contact.php">Liên hệ</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="header-meta-info">
                                <div class="header-search">
                                    <form action="search.php" method="post">
                                        <input type="text" placeholder="Tìm kiếm " name="tukhoa">
                                        <button><i class="icon-search"></i></button>
                                    </form>
                                </div>
                                
                                <div class="header-account">
                                    <?php
                                        if(isset($_GET['customer_id'])){
                                            Session::destroy_customer();
                                        }
                                    ?>
                                    <?php
                                        $login_check = Session::get('customer_login');
                                        if($login_check == true){
                                    ?>
                                        <?php
                                            $id = Session::get('customer_id');
                                            $get_customers = $cs->show_customers($id);
                                            if($get_customers){
                                                while($result = $get_customers->fetch_assoc()){
                                        ?>
                                        
                                        <div class="header-account-list dropdown top-link">
                                            <a href="#" role="button" data-toggle="dropdown"><i class="icon-users"></i></a>

                                            <ul class="dropdown-menu ">
                                                <li><a href="my-account.php">Tài khoản của tôi</a></li>
                                                <li><a href="wishlist.php">Sản phẩm yêu thích</a></li>
                                                <li><a href="order.php">Đơn mua</a></li>
                                                <li><a href="?customer_id='.Session::get('customer_id').'">Đăng xuất</a></li>
                                            </ul>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    <?php
                                        }else{
                                            echo '
                                            <div class="header-account-list dropdown top-link">
                                                <a href="#" role="button" data-toggle="dropdown"><i class="icon-users"></i></a>

                                                <ul class="dropdown-menu ">
                                                    <li><a href="register.php">Đăng ký</a></li>
                                                    <li><a href="login.php">Đăng nhập</a></li>
                                                </ul>
                                            </div>
                                            ';
                                        }
                                    ?>
                                    <?php
                                        if(isset($_GET['idCart'])){
                                            $idCart = $_GET['idCart'];
                                            $delcart = $ct->del_product_cart($idCart);
                                            header('location:index.php');
                                        }
                                    ?>

                                    <div class="header-account-list dropdown mini-cart">
                                        <a href="#" role="button" data-toggle="dropdown">
                                            <i class="icon-shopping-bag"></i>
                                            <?php
                                                $qty_buy = $ct->get_qty_pd_cart();
                                                if($qty_buy) {
                                                    while($result = $qty_buy->fetch_assoc()) {
                                                        if($result['qty_buy'] > 0){
                                            ?>
                                            <span class="item-count"><?php echo $result['qty_buy']?></span>
                                            <?php
                                                        }else echo '';
                                                    }
                                                }
                                            ?>
                                        </a>

                                        <?php
                                            $pd_cart = $ct->get_product_cart();
                                            if($pd_cart) {
                                                $total = 0;
                                        ?>
                                        <ul class="dropdown-menu">
                                            <li class="product-cart">
                                                <?php
                                                    while($result = $pd_cart->fetch_assoc()) {
                                                        $total += $result['Total'];
                                                ?>
                                                <div class="single-cart-box">
                                                    <div class="cart-img">
                                                        <?php
                                                            $img_pd_cart = $pd->show_image_pd($result['idProduct']);
                                                            if($img_pd_cart) {
                                                                while($result_img = $img_pd_cart->fetch_assoc()) {
                                                        ?>
                                                        <a href="shop-single.php?idProduct=<?php echo $result['idProduct']?>"><img src="../Aura-Store/AuraDash/assets/images/product/<?php echo $result_img['ImageName']?>" alt=""></a>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                        <span class="pro-quantity">x<?php echo $result['QuantityBuy']?></span>
                                                    </div>
                                                    <div class="cart-content">
                                                        <h6 class="title"><a href="shop-single.php?idProduct=<?php echo $result['idProduct']?>"><?php echo $result['ProductName']?></a></h6>
                                                        
                                                        <?php
                                                            $get_time_sale = $pd->get_time_sale($result['idProduct']);
                                                            $SalePrice = 0;
                                                            if($get_time_sale) {
                                                                while($result_time_sale = $get_time_sale->fetch_assoc()) {
                                                                    $SalePrice = $result['Price'] - ($result['Price']/100)*$result_time_sale['Discount'];
                                                                }
                                                            }
                                                        ?>
                                                        <div class="cart-price">   
                                                            <?php
                                                                if($SalePrice != '0'){
                                                            ?>
                                                            <span class="sale-price"><?php echo $fm->adddotstring(round($SalePrice,-3))?>đ</span>
                                                            <span class="regular-price"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                                                            <?php
                                                                }else{
                                                            ?>
                                                            <span class="sale-price"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                                                            <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <a href="?idCart=<?php echo $result['idCart']?>" onclick="return confirm('Bạn có muốn xóa sản phẩm <?php echo $result['ProductName']?> không?');" class="del-icon"><i class="fa fa-trash"></i></a>
                                                </div>
                                                <?php
                                                        }
                                                ?>
                                            </li>
                                            <li class="product-total">
                                                <ul class="cart-total">
                                                    <li> Tổng tiền: <span><?php echo $fm->adddotstring($total) ?>đ</span></li>
                                                </ul>
                                            </li>
                                            <li class="product-btn">
                                                <a href="cart.php" class="btn btn-dark btn-block">Xem giỏ hàng</a>
                                            </li>
                                        </ul>
                                        <?php
                                            }else{
                                        ?>
                                        <ul class="dropdown-menu" style="height:250px; width: 250px;">
                                            <li style="height:100%; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                                                <img src="../Aura-Store/assets/images/no_cart.png" alt="" style="width: 80%;" class="product-image">
                                                <span style="text-align: center; width: 100%; display:block;">Giỏ hàng trống</span>
                                            </li>
                                        </ul>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Header Section End-->


        <!--Header Mobile Start-->
        <div class="header-mobile d-lg-none">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="header-logo">
                            <a href="index.php">
                                <img src="assets/images/logo/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="header-meta-info">
                            <div class="header-account">
                                <?php
                                    $login_check = Session::get('customer_login');
                                    if($login_check == true){
                                ?>
                                    <?php
                                        $id = Session::get('customer_id');
                                        $get_customers = $cs->show_customers($id);
                                        if($get_customers){
                                            while($result = $get_customers->fetch_assoc()){
                                    ?>
                                    
                                    <div class="header-account-list dropdown top-link">
                                        <a href="#" role="button" data-toggle="dropdown"><i class="icon-users"></i></a>

                                        <ul class="dropdown-menu ">
                                            <li><a href="my-account.php">Tài khoản của tôi</a></li>
                                            <li><a href="wishlist.php">Sản phẩm yêu thích</a></li>
                                            <li><a href="order.php">Đơn mua</a></li>
                                            <li><a href="?customer_id='.Session::get('customer_id').'">Đăng xuất</a></li>
                                        </ul>
                                    </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                <?php
                                    }else{
                                        echo '
                                        <div class="header-account-list dropdown top-link">
                                            <a href="#" role="button" data-toggle="dropdown"><i class="icon-users"></i></a>

                                            <ul class="dropdown-menu ">
                                                <li><a href="register.php">Đăng ký</a></li>
                                                <li><a href="login.php">Đăng nhập</a></li>
                                            </ul>
                                        </div>
                                        ';
                                    }
                                ?>
                                <div class="header-account-list mini-cart">
                                    <a href="cart.php">
                                        <i class="icon-shopping-bag"></i>
                                        <?php
                                            $qty_buy = $ct->get_qty_pd_cart();
                                            if($qty_buy) {
                                                while($result = $qty_buy->fetch_assoc()) {
                                                    if($result['qty_buy'] > 0){
                                        ?>
                                        <span class="item-count"><?php echo $result['qty_buy']?></span>
                                        <?php
                                                    }else echo '';
                                                }
                                            }
                                        ?>
                                    </a>
                                </div>
                                <div class="header-account-list mobile-menu-trigger">
                                    <button id="menu-trigger">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Header Mobile End-->

        <!--Header Mobile Menu Start-->
        <div class="header-mobile-menu d-lg-none">

            <a href="javascript:void(0)" class="mobile-menu-close">
                <span></span>
                <span></span>
            </a>

            <div class="header-meta-info">
                <div class="header-search">
                    <form action="search.php" method="post">
                        <input type="text" placeholder="Tìm kiếm " name="tukhoa">
                        <button><i class="icon-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="site-main-nav">
                <nav class="site-nav">
                    <ul class="navbar-mobile-wrapper">
                        <li><a href="product.php">Trang sản phẩm</a></li>
                        <li>
                            <a href="#">Cửa hàng <span class="new">Mới</span></a>
                            <ul class="mega-sub-menu">
                                <li class="mega-dropdown">
                                    <a class="mega-title" href="#">Danh mục</a>

                                    <ul class="mega-item">
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
                                </li>
                                <li class="mega-dropdown">
                                    <a class="mega-title" href="#">Thương hiệu</a>

                                    <ul class="mega-item">
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
                                </li>
                                <li class="mega-dropdown">
                                    <a class="mega-title" href="#">Sản phẩm</a>

                                    <ul class="mega-item">
                                        <li><a href="new_product.php">Sản phẩm mới</a></li>
                                        <li><a href="bestsell_product.php">Sản phẩm bán chạy</a></li>
                                        <li><a href="featured_product.php">Sản phẩm nổi bật</a></li>
                                        <li><a href="sale_product.php">Sản phẩm đang SALE</a></li>
                                    </ul>
                                </li>
                                <li class="mega-dropdown">
                                    <a class="menu-banner" href="#">
                                        <img src="assets/images/bannerr.jpg" alt="">
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Tin tức</a>

                            <ul class="sub-menu">
                                <li>
                                    <a href="blog.php">AURA DEALS</a>
                                    
                                </li>
                                <li>
                                    <a href="blog-left-sidebar.php">SKINCARE TIPS</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="about.php">Về chúng tôi</a>
                        </li>
                        <li><a href="contact.php">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>

            <div class="header-social">
                <ul class="social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>

        </div>
        <!--Header Mobile Menu End-->

        <div class="overlay"></div>
        <!--Overlay-->
        
        