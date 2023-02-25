<?php
    include 'inc/header.php';
    
?>

<?php
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
?>

<!--Page Banner Start-->
<div class="page-banner" style="background-image: url(assets/images/TKSP_1.jpg);">
    <div class="container">
        <div class="page-banner-content text-center">
            <h2 class="title">Tìm kiếm sản phẩm</h2>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tìm kiếm sản phẩm </li>
            </ol>
        </div>
    </div>
</div>
<!--Page Banner End-->
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tukhoa = $_POST['tukhoa'];
        $search_product = $pd->search_product($tukhoa);
        if($search_product){
            $product_count = mysqli_num_rows($search_product);
        }else{
            $product_count = 1;
        }
        $product_button = ceil($product_count/15);
    }
?>
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
                    <select class="sorter wide" name="SortBy" id="SortBy">
                        <option value="manual">Nổi bật</option>
                        <option value="best-selling">Bán chạy</option>
                        <option value="price-ascending">Giá, thấp đến cao</option>
                        <option value="price-descending">Giá, cao đến thấp</option>
                        <option value="created-descending">Ngày, mới nhất đến cũ nhất</option>
                        <option value="created-ascending">Ngày, cũ nhất đến mới nhất</option>
                    </select>
                </div>
            </div>
            <div class="top-bar-page-amount">
                <p>Hiển thị 1 - 15 trong <?php echo $product_count?> sản phẩm</p>
            </div>
        </div>
        <!--Shop Top Bar End-->


       <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="grid" role="tabpanel">
                <div class="row">
                    <?php
                            if($search_product) {
                                while($result = $search_product->fetch_assoc()) {
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
                             
                                    <img src="../kngu/AuraDash/assets/images/product/<?php echo $result_image['ImageName']?>" alt=""></a>
                           
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
                                       <!--<li><a href="cart.php" data-tooltip="tooltip" data-placement="left" title="Add to cart"><i class="icon-shopping-bag"></i></a></li>-->
                                       <li><a class="addtoCmp"  id="<?php echo $result['idProduct'] ?>" data-toggle="modal" data-target="#select-products" data-tooltip="tooltip" data-placement="left" title="So sánh"><i class="icon-sliders"></i></a></li>
                                       <li><a href="wishlist.php?idProduct=<?php echo $result['idProduct']?>" data-tooltip="tooltip" data-placement="left" title="Thêm vào danh sách yêu thích"><i class="icon-heart"></i></a></li>
                                       <li><a href="javascript:void(0);" data-tooltip="tooltip" data-placement="left" title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-eye"></i></a></li>
                                   </ul>
                               </div>
                           </div>
                           <div class="product-content text-center">

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

        <!--Pagination Start-->
        <div class="page-pagination">
            <ul class="pagination justify-content-center">
                <li <?php if($page==1){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link prev" href="?page=<?php echo $previous_page ?>">Prev</a></li>

                <?php
                    for($i = 1; $i<=$product_button; $i++){
                ?>
                        <li class="page-item">
                            <a href="?page=<?php echo $i ?>" <?php if($i==$page){ echo 'class="page-link active"';}?> class="page-link"><?php echo $i ?></a>
                        </li>
                <?php
                    }
                ?>                    
                
                <li <?php if($page==$product_button){ echo 'class="page-item disabled"';}?> class="page-item"><a class="page-link next" href="?page=<?php echo $next_page ?>">Next</a></li>
            </ul>
        </div>
        <!--Pagination End-->
    </div>
</div>
<!--Shop End-->

<?php
    include 'inc/footer.php';
?>