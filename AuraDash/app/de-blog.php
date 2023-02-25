<?php
    include '../inc/header.php';
    ?> 
<?php

$sl_baiviet = "select * from Blog WHERE idBlog =".$_GET['idBlog'];
$rs_baiviet = mysqli_query($conn,$sl_baiviet);
        if(!$rs_baiviet)
            echo "Không thể truy vấn CSDL $sl_baiviet";
        $row_baiviet = mysqli_fetch_array($rs_baiviet);
?>
<!-- Nội dung ở đây -->
<div class="content-page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
<h3 style="text-align: center"><?php echo $row_baiviet['BlogTitle'];?></h3>
<div class="row">
    <div class="col-md-10"><img src="../assets/images/<?php echo $row_baiviet['BlogImage'];?>"></div>
</div>
<div class="row">
    <div class="col-md-10"><?php echo $row_baiviet['BlogDesc'];?></div>
</div>
<div class="row" style=" line-height: 2.5; font-family: Source-Sans-Pro, Arial, sans-serif; background-color: transparent;text-align: justify;">
    <div class="col-md-10"><?php echo $row_baiviet['BlogContent'];?></div>
</div>

</div>
</div>
</div>
</div>
<?php
    include '../inc/footer.php';
    ?> 


