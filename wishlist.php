<?php

use LDAP\Result;

    include 'inc/header.php';
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:login.php');
    }else{
        $idCustomer = Session::get('customer_id');
    }

    
?>
<?php

	if(isset($_GET['idProduct']) ){
        $idProduct = $_GET['idProduct'];
        $add_to_wishlist = $wishlist->add_to_wishlist($idProduct,$idCustomer);
        
       
    }
    else if(isset($_GET['idWish'])){
        $idWish = $_GET['idWish'];
        $del_Wishlist = $wishlist->del_wishlist($idWish);
    }
    
?>
<?php
    $check_Wish = $wishlist->check_Wish($idCustomer);
    if($check_Wish>'0'){
?>
<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Danh sách yêu thích</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách yêu thích</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->

<!--Wishlist Start-->
<div class="cart-page section-padding-5">
    <div class="container">
        <div class="cart-table table-responsive">
        <?php
                if(isset($add_to_wishlist)){
                    echo $add_to_wishlist;
                }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th class="image">Hình ảnh</th>
                        <th class="product">Tên sản phẩm</th>
                        <th class="price">Giá tiền</th>
                        <th class="remove">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_wishlist_by_customer = $wishlist->show_wishlist_by_idCustomer($idCustomer);
                    if($show_wishlist_by_customer){
                        while($result = $show_wishlist_by_customer->fetch_assoc()){
                    ?>
                    <tr>
                    <?php
                        $idpd = $result['idProduct'];
                        $imglist = $pd->show_image_pd($idpd);
                        if($imglist) {
                            while($result_image = $imglist->fetch_assoc()) {
                    ?>
                        <td class="image">
                            <a href="shop-single.php?idProduct=<?php echo $result_image['idProduct']?>"><img src="../kngu/AuraDash/assets/images/product/<?php echo $result_image['ImageName']?>" alt=""></a>
                        </td>
                    <?php
                            }
                        }
                    ?>
                        <td class="product">
                            <a href="shop-single.php?idProduct=<?php echo $result['idProduct']?>"><?php echo $result['ProductName']?></a>
                        </td>

                        <?php
                            $get_time_sale = $pd->get_time_sale($idpd);
                            $SalePrice = 0;
                            if($get_time_sale) {
                                while($result_time_sale = $get_time_sale->fetch_assoc()) {
                                    $SalePrice = $result['Price'] - ($result['Price']/100)*$result_time_sale['Discount'];
                                }
                            }
                        ?>
                        <td class="price">
                            <?php
                                if($SalePrice != '0'){
                            ?>
                            <span class="amount"><?php echo $fm->adddotstring(round($SalePrice,-3))?>đ</span>
                            <?php
                                }else{
                            ?>
                            <span class="amount"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                            <?php
                                }
                            ?>
                        </td>
                        
                        <td class="remove">
                            <a href="?idWish=<?php echo $result['idWish']?> "onclick="return confirm('Bạn có muốn xóa <?php echo $result['ProductName']?> khỏi danh sách yêu thích không?')"><i class="ti-close"></i></a>
                        </td>
                    </tr>
                   <?php
                        }
                    }
                   ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Wishlist End-->
<?php
}
else{
    ?>
<!--Empty Cart Start-->
<div class="empty-cart-page section-padding-5">
    <div class="container">
        <div class="empty-cart-content text-center">
            <h2 class="empty-cart-title text-primary">Chưa có sản phẩm yêu thích!</h2>
            <div class="empty-cart-img">
                <img src="assets/images/cart.png" alt="">
            </div>
            <a href="index.php" class="btn btn-primary">Trở lại trang chủ</a>
        </div>
    </div>
</div>
<!--Empty Cart End-->
<?php
}
?>
<?php
    include 'inc/footer.php';
?>