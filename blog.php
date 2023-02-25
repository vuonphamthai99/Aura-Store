<?php
include 'inc/header.php';
require_once 'config/config.php';


$result = mysqli_query($conn, 'select count(idBlog) as total from Blog');
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

//  TÌM LIMIT VÀ CURRENT_PAGE
$current_page = isset($_GET['page'])?$_GET['page'] : 1;
$limit = 6;
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page){
    $current_page = $total_page;
}
else if ($current_page < 1){
    $current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $limit;
// lấy danh sách tin tức
$result = mysqli_query($conn, "SELECT * FROM Blog where HideShow=1 LIMIT $start, $limit");


?>        
        <!--Page Banner Start-->
        <div class="page-banner" style="background-image: url(assets/images/Blog1.jpg);">
            <div class="container">
                <div class="page-banner-content text-center">
                    <h2 class="title">Tin tức</h2>
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--Page Banner End-->
        <!--Blog Start-->
        <div class="blog-page section-padding-7">
            <div class="container">
                <div class="row">
                <?php if($result){ while($r_bv=$result->fetch_assoc()){
                    $date = date_create($r_bv['Date'])
    ?>                 
    
                     <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
     
                            <div class="blog-image">
                                <a href="desc-blog.php?idBlog=<?php echo $r_bv['idBlog'];?>"><img src="./AuraDash/assets/images/<?php echo $r_bv['BlogImage'];?>" alt=""></a>
                            </div>
                            <div class="blog-content">
                            <a href="desc-blog.php?idBlog=<?php echo $r_bv['idBlog'];?>" class="new-block">
                                <h5 class="title"><a href="desc-blog.php?idBlog=<?php echo $r_bv['idBlog'];?>"><?php echo $r_bv['BlogTitle'];?></a></h5>
                                <div class="articles-date">
                                    <!-- <p>By <span>  Shopify Team HasTheme /  August 12, 2020</span></p> -->
                                </div>
                                <?php echo $r_bv['BlogDesc'];?>

                                <div class="blog-footer">
                                    <a class="more" href="desc-blog.php?idBlog=<?php echo $r_bv['idBlog'];?>">Tìm hiểu thêm</a>
                                    <!-- <p class="comment-count"><i class="icon-message-circle"></i> 0</p> -->
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


                <!--Pagination Start-->
                <div class="page-pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link prev" href="#">Prev</a></li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link next" href="#">Next</a></li>
                    </ul>
                </div>
                <!--Pagination End-->


            </div>
        
        <!--Blog End-->

<?php 
include 'inc/footer.php'
?>