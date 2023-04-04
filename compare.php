<?php
    include 'inc/header.php';
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:login.php');
    }else{
        $idCustomer = Session::get('customer_id');
    }
?>

<?php
    $check_com = 1;

        if(isset($_GET['idProduct3'])  ){
            $idProduct1 = $_GET['idProduct1'];
            $idProduct2 = $_GET['idProduct2'];
            $idProduct3 = $_GET['idProduct3'];
            
            $add_to_compare1 = $compare->add_to_compare($idCustomer,$idProduct1);
            $add_to_compare2 = $compare->add_to_compare($idCustomer,$idProduct2);
            $add_to_compare3 = $compare->add_to_compare($idCustomer,$idProduct3);

            $check_com = $compare->check_compare($idCustomer);
        }
        else if(isset($_GET['del_idpro'])){
            $idProduct = $_GET['del_idpro'];
            $delCompare = $compare->del_compare($idCustomer,$idProduct);
            $check_com = $compare->check_compare($idCustomer);
        }
        else {
            $idProduct1 = $_GET['idProduct1'];
            $idProduct2 = $_GET['idProduct2'];
            

            $add_to_compare1 = $compare->add_to_compare($idCustomer,$idProduct1);
            $add_to_compare2 = $compare->add_to_compare($idCustomer,$idProduct2);
            

            $check_com = $compare->check_compare($idCustomer);
        }
        
    
    


?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/testimonial-bg.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">So sánh sản phẩm</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">So sánh sản phẩm</li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->
<?php
    
    if($check_com>'0'){
?>
<!--Compare Start-->
<div class="compare-page section-padding-5">
    <div class="container">
        <div class="compare-table table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Sản Phẩm</th>
                        <?php
                        $show_compare_by_customer = $compare->show_compare_by_idCustomer($idCustomer);
                    if($show_compare_by_customer){
                        while($result = $show_compare_by_customer->fetch_assoc()){
                            ?>
                        <td>
                            <div class="product-image-title">
                            <?php
                            $idpd = $result['idProduct'];
                            $imglist = $pd->show_image_pd($idpd);
                            if($imglist) {
                                while($result_image = $imglist->fetch_assoc()) {
                            ?>
                                <a class="product-image" href="shop-single.php?idProduct=<?php echo $result_image['idProduct']?>"><img src="../Aura-Store/AuraDash/assets/images/product/<?php echo $result_image['ImageName']?>" alt="product"></a>
                            <?php
                                }
                            }
                            ?>
                                <h5 class="title"><a class="view-hover" href="shop-single.php?idProduct=<?php echo $result_image['idProduct']?>"><?php echo $result['ProductName'] ?></a></h5>
                            </div>
                        </td>
                       <?php
                        }
                    }
                       ?>
                    </tr>
                    <tr>
                        <th>Mô tả</th>
                        <?php
                        $show_compare_by_customer = $compare->show_compare_by_idCustomer($idCustomer);
                    if($show_compare_by_customer){
                        while($result = $show_compare_by_customer->fetch_assoc()){
                            ?>
                        <td>
                            <div style="text-align:justify;">
                                <?php echo $result['DesProduct'] ?>
                            </div>
                        </td>
                        <?php
                        }
                    }
                       ?>
                        
                    </tr>
                    <tr>
                        <th>Giá</th>
                        <?php
                        $show_compare_by_customer = $compare->show_compare_by_idCustomer($idCustomer);
                    if($show_compare_by_customer){
                        while($result = $show_compare_by_customer->fetch_assoc()){
                            ?>
                        <td>
                        <?php
                                    $get_time_sale = $pd->get_time_sale($idpd);
                                    $SalePrice = 0;
                                    if($get_time_sale) {
                                        while($result_time_sale = $get_time_sale->fetch_assoc()) {
                                            $SalePrice = $result['Price'] - ($result['Price']/100)*$result_time_sale['Discount'];
                                ?>
                            <span class="old-price"><strike><?php echo $fm->adddotstring($result['Price'])?>đ</strike></span>
                            <span class="current-price text-primary"><?php echo $fm->adddotstring(round($SalePrice,-3))?>đ</span>
                            
                        <?php
                            };
                        }else{
                        ?>
                            <span class="current-price text-primary"><?php echo $fm->adddotstring($result['Price'])?>đ</span>
                        <?php
                            }
                        ?></td>
                        <?php
                        }
                    }
                       ?>
                    </tr>

                    <tr>
                        <th>Xem chi tiết</th>
                        <?php
                        $show_compare_by_customer = $compare->show_compare_by_idCustomer($idCustomer);
                        if($show_compare_by_customer){
                            while($result = $show_compare_by_customer->fetch_assoc()){
                        ?>
                        <td><a href="shop-single.php?idProduct=<?php echo $result['idProduct']?>" class="btn btn-primary">Xem chi tiết</a></td>
                        <?php
                            }
                        }
                            ?>
                    </tr>
                    <tr>
                        <th>Xóa</th>
                        <?php
                        $show_compare_by_customer = $compare->show_compare_by_idCustomer($idCustomer);
                    if($show_compare_by_customer){
                        while($result = $show_compare_by_customer->fetch_assoc()){
                            ?>
                        <td><a href="compare.php?del_idpro=<?php echo $result['idProduct'] ?>" class="btn btn-secondary">Xóa</a></td>
                        <?php
                        }
                    }
                       ?>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Compare End-->
<?php
}
else{
    ?>
<!--Empty Cart Start-->
<div class="empty-cart-page section-padding-5">
    <div class="container">
        <div class="empty-cart-content text-center">
            <h2 class="empty-cart-title text-primary">Chưa có sản phẩm so sánh!</h2>
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


        <!--Footer Section Start-->
        <div class="footer-area">
            <div class="container">
                <div class="footer-widget-area section-padding-6">
                    <div class="row justify-content-between">

                        <!--Footer Widget Start-->
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget">
                                <a class="footer-logo" href="#"><img src="assets/images/logo/logo-white.png" alt=""></a>
                                <div class="footer-widget-text">
                                    <p>AURA Cosmetics từ điểm bắt đầu đến đích đến llànlanf da khỏe mạnh.</p>
                                </div>
                                <div class="widget-social">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--Footer Widget End-->
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">Thông tin liên hệ</h4>

                                <div class="footer-widget-menu">
                                    <ul>
                                        <li><a href="#">Hotline: 1900636510 (8:00-21:00)</a></li>
                                        <li><a href="#">Email: order@aura.com</a></li>
                                        <li><a href="#">Hệ thống cửa hàng</a></li>
                                        <li><a href="#">Cần Thơ: 30/4 Ninh Kiều Cần Thơ</a></li>
                                        <li><a href="#">TPHCM: Phố đi bộ Nguyễn Huệ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">Danh mục</h4>

                                <div class="footer-widget-menu">
                                    <ul>
                                        <li><a href="#">Sản phẩm</a></li>
                                        <li><a href="#">Danh mục</a></li>
                                        <li><a href="#">Thương hiệu</a></li>
                                        <li><a href="blog.php">Tin tức</a></li>
                                        <li><a href="about.php">Về chúng tôi</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--<div class="col-lg-2 col-md-4 col-sm-6">-->
                        <!--    <div class="footer-widget">-->
                        <!--        <h4 class="footer-widget-title">Help</h4>-->

                        <!--        <div class="footer-widget-menu">-->
                        <!--            <ul>-->
                        <!--                <li><a href="#">FAQ’s</a></li>-->
                        <!--                <li><a href="#">Pricing Plans</a></li>-->
                        <!--                <li><a href="#">Track</a></li>-->
                        <!--                <li><a href="#">Your Order</a></li>-->
                        <!--                <li><a href="#">Returns</a></li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <!--<div class="col-lg-2 col-md-4 col-sm-6">-->
                        <!--    <div class="footer-widget">-->
                        <!--        <h4 class="footer-widget-title">Customer Service</h4>-->

                        <!--        <div class="footer-widget-menu">-->
                        <!--            <ul>-->
                        <!--                <li><a href="my-account.php">My Account</a></li>-->
                        <!--                <li><a href="#">Terms of Use</a></li>-->
                        <!--                <li><a href="#">Deliveries & Returns</a></li>-->
                        <!--                <li><a href="#">Gift card</a></li>-->
                        <!--                <li><a href="#">Legal Notice</a></li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                    </div>
                </div>
            </div>
        </div>
        <!--Footer Section End-->

        <!--Copyright Section Start-->
        <div class="copyright-section">
            <div class="container">
                <div class="copyright-wrapper text-center d-lg-flex align-items-center justify-content-between">

                    <!--Right Start-->
                    <div class="copyright-content">
                        <p>Copyright 2020 &copy; <a href="https://hasthemes.com/">HasThemes</a> . All Rights Reserved</p>
                    </div>
                    <!--Right End-->

                    <!--Right Start-->
                    <div class="copyright-payment">
                        <img src="assets/images/payment.png" alt="">
                    </div>
                    <!--Right End-->

                </div>
            </div>
        </div>
        <!--Copyright Section End-->


        <!--Back To Start-->
        <a href="#" class="back-to-top">
            <i class="fa fa-angle-double-up"></i>
        </a>
        <!--Back To End-->




        <!-- Quick View  Start-->
        <div class="modal fade" id="exampleModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="quick-view-image">
                                    <img src="assets/images/product-single/product-1.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="quick-view-content">
                                    <h4 class="product-title">Sweet Alyssum</h4>
                                    <div class="thumb-price">
                                        <span class="current-price">$19.00</span>
                                        <span class="old-price">$29.00</span>
                                        <span class="discount">-34%</span>
                                    </div>
                                    <div class="product-rating">
                                        <ul class="rating-star">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <span>No reviews</span>
                                    </div>
                                    <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will</p>

                                    <div class="quick-view-quantity-addcart d-flex flex-wrap">
                                        <form action="#">
                                            <div class="quantity d-inline-flex">
                                                <button type="button" class="sub"><i class="ti-minus"></i></button>
                                                <input type="text" value="1" />
                                                <button type="button" class="add"><i class="ti-plus"></i></button>
                                            </div>
                                        </form>
                                        <div class="addcart-btn">
                                            <button class="btn btn-primary">Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Quick View Tags End-->


    </div>

    <!-- JS
    ============================================ -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>

    <!-- Plugins JS -->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="assets/js/plugins/jquery.elevateZoom.min.js"></script>
    <script src="assets/js/plugins/select2.min.js"></script>
    <script src="assets/js/plugins/ajax-contact.js"></script>


    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <!-- <script src="assets/js/plugins.min.js"></script> -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>


    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ5y0EF8dE6qwc03FcbXHJfXr4vEa7z54"></script>
    <script src="assets/js/map-script.js"></script>
    
        <!-- Facebook Messenger Pluggin -->
<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    <script>
    
    var list = [];

    $('.addtoCmp').click(function(){
            var product_id = this.id;
            
            $.ajax({             
            type:'POST',             
            url: 'modalcompare.php',             
            data: {                 
                product_id: product_id             
            },             
            success: function(response) {                 
            $('.container').html(response); 
            $('#select-products').modal('show');
            },             
            error: function(response) {                 
                alert("Thêm vào so sánh thất bại"); 
            }         
            });  

        });
        $('#WarningModal').on('hidden.bs.modal', function () {
            $("#select-products").modal('toggle');
        })
    function showWarningModal(){
        $(document).ready(function(){
            $("#WarningModal").modal('toggle');
            $("#select-products").modal('toggle');
        });
    };

    

</script>

<script>    
$(window).bind('beforeunload', function(){
    var value = "unload";
    $.ajax({             
            type:'POST',             
            url: 'delcompare.php',             
            data: {                 
                value: value             
            },             
            success: function(data) {                 
                return 'Are you sure you want to leave?';

            },             
            error: function(response) {                 
                alert("thất bại"); 
            }         
            }); 
    
    });

    </script>
    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "110184591640431");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v13.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    
<div class="zalo-chat-widget bottom-right" data-oaid="477138193349888639" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="3" data-width="" data-height=""></div>

<script src="https://sp.zalo.me/plugins/sdk.js"></script>
    

    




</body>

</html>
