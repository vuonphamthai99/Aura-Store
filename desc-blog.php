<?php
   include_once 'inc/header.php';
?>
    
    <div class="main-wrapper">

        <div class="overlay"></div>
        <!--Overlay-->

        <!--Page Banner Start-->
        <div class="page-banner" style="background-image: url(assets/images/DEALS1.jpg);">
            <div class="container">
                <div class="page-banner-content text-center">
                    <h2 class="title">Mô Tả Bài Viết</h2>
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mô Tả Bài Viết</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--Page Banner End-->

        <!--Blog Start-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<?php
if(isset($_GET['idBlog']))
{
    $sl = "select * from Blog where idBlog=".$_GET['idBlog'];
    $result = mysqli_query($conn,$sl);
    $sl1 = "select * from Blog where HideShow=1 ORDER BY Date DESC LIMIT 3";
    $result1 = mysqli_query($conn,$sl1);
}
    
?>
<link rel="stylesheet" href="../css/hoa.min.css" type="text/css">

        <div class="blog-page section-padding-7">
            <div class="container">
                <?php while ($r = $result->fetch_assoc()) {?>
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="blog-single">
                            <img src="./AuraDash/assets/images/<?php echo $r_bv['BlogImage'];?>" alt="">

                            <h2 class="title"><?php echo $r['BlogTitle'];?></h2>
                            <div class="articles-date">
                                <!-- <p>By <span>  Shopify Team HasTheme /  August 12, 2020</span></p> -->
                            </div>

                            <p><?php echo  $r['BlogContent'];?></p>
              
                            <!--<div class="blog-dec-tags-social">-->
                            <!--    <div class="blog-dec-tags">-->
                            <!--        <span>Tags:</span>-->
                            <!--        <ul class="tags">-->
                            <!--            <li><a href="#">Bouquet</a></li>-->
                            <!--            <li><a href="#">Event</a></li>-->
                            <!--            <li><a href="#">Gift</a></li>-->
                            <!--            <li><a href="#">Joy</a></li>-->
                            <!--        </ul>-->
                            <!--    </div>-->
                            <!--    <div class="blog-dec-social">-->
                            <!--        <span>Share:</span>-->
                            <!--        <ul class="social">-->
                            <!--            <li><a href="#"><i class="fa fa-facebook"></i></a></li>-->
                            <!--            <li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
                            <!--            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>-->
                            <!--            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>-->
                            <!--        </ul>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <!--<div class="blog-next-previous">-->
                            <!--    <span class="left">-->
                            <!--    <a href="#"><i class="ti-arrow-left"></i> Older Post </a>-->
                            <!--</span>-->
                            <!--    <span class="right">-->
                            <!--    <a href="#">Newer Post  <i class="ti-arrow-right"></i></a>-->
                            <!--</span>-->
                            <!--</div>-->
                        </div>

                        <!--<div class="blog-comment">-->
                        <!--    <div class="comment-wrapper section-padding-2">-->
                        <!--        <h2 class="comment-title">Comment (03) </h2>-->

                        <!--        <ul class="comment-items">-->
                        <!--            <li>-->
                        <!--                <div class="single-commnet">-->
                        <!--                    <div class="comment-avater">-->
                        <!--                        <img src="assets/images/avater-1.png" alt="">-->
                        <!--                    </div>-->
                        <!--                    <div class="comment-content">-->
                        <!--                        <h4 class="avater-name">Anthony Stephens</h4>-->
                        <!--                        <span class="date">October 14, 2020</span>-->
                        <!--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim ad minim veniam,</p>-->
                        <!--                        <a href="#" class="replay">Replay</a>-->
                        <!--                    </div>-->
                        <!--                </div>-->

                        <!--                <ul class="comment-replay">-->
                        <!--                    <li>-->
                        <!--                        <div class="single-commnet">-->
                        <!--                            <div class="comment-avater">-->
                        <!--                                <img src="assets/images/avater-2.png" alt="">-->
                        <!--                            </div>-->
                        <!--                            <div class="comment-content">-->
                        <!--                                <h4 class="avater-name">Anthony Stephens</h4>-->
                        <!--                                <span class="date">October 14, 2020</span>-->
                        <!--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim ad minim veniam,</p>-->
                        <!--                                <a href="#" class="replay">Replay</a>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                    </li>-->
                        <!--                </ul>-->
                        <!--            </li>-->
                        <!--            <li>-->
                        <!--                <div class="single-commnet">-->
                        <!--                    <div class="comment-avater">-->
                        <!--                        <img src="assets/images/avater-1.png" alt="">-->
                        <!--                    </div>-->
                        <!--                    <div class="comment-content">-->
                        <!--                        <h4 class="avater-name">Anthony Stephens</h4>-->
                        <!--                        <span class="date">October 14, 2020</span>-->
                        <!--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolor magna aliqua. Ut enim ad minim veniam,</p>-->
                        <!--                        <a href="#" class="replay">Replay</a>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </li>-->
                        <!--        </ul>-->
                        <!--    </div>-->
                        <!--    <div class="comment-wrapper section-padding-2">-->
                        <!--        <h2 class="comment-title">Leave a comment</h2>-->

                        <!--        <form action="#">-->
                        <!--            <div class="row">-->
                        <!--                <div class="col-md-6">-->
                        <!--                    <div class="single-form">-->
                        <!--                        <input type="text" placeholder="Name">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="col-md-6">-->
                        <!--                    <div class="single-form">-->
                        <!--                        <input type="email" placeholder="Email">-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="col-md-12">-->
                        <!--                    <div class="single-form">-->
                        <!--                        <textarea placeholder="Message"></textarea>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--                <div class="col-md-12">-->
                        <!--                    <div class="single-form">-->
                        <!--                        <button class="btn btn-primary">Send Message</button>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </form>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="col-lg-3">
                        <div class="blog-sidebar"> 
                              <!--Sidebar Categories Start-->
                            <div class="sidebar-post">
                                <h3 class="widget-title">Bài viết gần đây</h3>

                                <ul class="post-items">
                                    <?php
                                    if($result1){
                                        while($r_recent=$result1->fetch_assoc()){
                                        $date1 = date_create($r_recent['Date'])
                                    ?>
                                    <li>
                                        <div class="single-post">
                                            <div class="post-thumb">
                                                <a href="desc-blog.php?idBlog=<?php echo $r_recent['idBlog'] ?>"><img src="./AuraDash/assets/images/<?php echo $r_recent['BlogImage'];?>" alt=""></a>
                                            </div>
                                            <div class="post-content">
                                                <span class="date"><?php echo date_format($date1, "d-m-Y");?></span>
                                                <h4 class="post-title"><a href="desc-blog.php?idBlog=<?php echo $r_recent['idBlog'] ?>"><?php echo $r_recent['BlogTitle'];?></a></h4>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>
                            <!--Sidebar Categories End-->


                            <!--Sidebar Tags Start-->
                            <!--<div class="sidebar-tags">-->
                            <!--    <h3 class="widget-title">Tags</h3>-->

                            <!--    <ul class="tags-list">-->
                            <!--        <li><a href="#">Bouquet</a></li>-->
                            <!--        <li><a href="#">Event</a></li>-->
                            <!--        <li><a href="#">Gift</a></li>-->
                            <!--        <li><a href="#">Joy</a></li>-->
                            <!--        <li><a href="#">Love</a></li>-->
                            <!--        <li><a href="#">Special</a></li>-->
                            <!--        <li><a href="#">Success</a></li>-->
                            <!--        <li><a href="#">Festival</a></li>-->
                            <!--    </ul>-->
                            <!--</div>-->
                            <!--Sidebar Tags End-->

                        </div>
                         </div>
                    </div>
                    <?php }?>
            </div>
        </div>
        <!--Blog End-->



        <!--Back To Start-->
        <a href="#" class="back-to-top">
            <i class="fa fa-angle-double-up"></i>
        </a>
        <!--Back To End-->

        <?php
    include 'inc/footer.php';
?>