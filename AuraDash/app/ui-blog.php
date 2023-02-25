<?php
    include '../inc/header.php';
    ?> 

    <link rel="stylesheet" href="backend.css">

 
<!-- Nội dung ở đây -->
<div class="content-page">
    <div class="container-fluid">
    <div class="row">
    <div class="col-lg-12">
            <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Danh Sách Bài Viết</h4>
                    <p class="mb-0">Trang hiển thị danh sách nhân viên, cung cấp cho bạn thông tin về nhân viên và chức vụ của nhân viên, các chức năng và điều khiển. </p>
                </div>
                <a href="add-blog.php" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Thêm bài viết</a>
            </div>
        </div>
  <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
            <table class="data-tables table mb-0 tbl-server-info">
                <thead class="bg-white text-uppercase">
                    <tr class="ligth ligth-data">
                        <th>STT</th>
                        <th>ID Bài Viết</th>
                        <th>Tên sản phẩm</th>
                        <th>Tiêu đề</th>
                        <th>Ngày cập nhật</th>
                        <th>Ẩn Hiện</th>
                        <th>Thao tác</th>
                        
                    </tr>
                </thead>
                <div class="d-flex align-items-center">
        <?php $stt = 0; $sl_baiviet = "select * from Blog";
        $rs_baiviet = mysqli_query($conn,$sl_baiviet);
        if(!$rs_baiviet)
        {
            echo "<script language='javascript'>alert('Tạm ngưng phục vụ!');";
            echo "location.href='ui-Blog.php';</script>";
        }?>
        <?php while ($r = $rs_baiviet->fetch_assoc()) {?>
            <tbody class="ligth-body">
            <td ><?php echo ++$stt;?> </td>
            <td width=""><?php echo $r['idBlog'];?> </td>
            <?php
                $q_sp = "select ProductName from Product WHERE idProduct=".$r['idProduct'];
                $rs_sp = mysqli_query($conn,$q_sp);
                $row_sp = mysqli_fetch_array($rs_sp);
            ?>
            <td width=""><?php echo $row_sp['ProductName'];?></td>
            <td><a style="color:blue;" href="de-blog.php?idBlog=<?php echo $r["idBlog"]?>"><?php echo $r['BlogTitle'];?></a> </td>
            <td  width=""><?php echo $r['Date'];?></td>
            <td width=""><?php if($r['HideShow'] ==1) echo "Hiện"; else echo "Ẩn";?></td>
            <!-- <td><a style="color:blue;" href="fix-blog.php?idBlog=<?php echo $r["idBlog"]?>" ><strong> Sửa/Xóa </strong></a></td> -->
            <td>
                <div class="d-flex align-items-center list-action"  style="justify-content:center;">
                    <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                    href="fix-blog.php?idBlog=<?php echo $r["idBlog"]?>"><i class="ri-pencil-line mr-0"></i></a>
                </div>
            </td>
        </tbody>
        <?php }?>
        </table> </div>
        </div>
        
    </div>
    </div>
</div>
      

<?php
    include '../inc/footer.php';
?>
