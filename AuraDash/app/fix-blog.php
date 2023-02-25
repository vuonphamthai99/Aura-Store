<?php
    include '../inc/header.php';

    $sl_baiviet = "select * from Blog where idBlog =".$_GET['idBlog'];
        $rs_baiviet = mysqli_query($conn,$sl_baiviet);
        $row_bv = mysqli_fetch_array($rs_baiviet);
        if(!$rs_baiviet)
        {
            echo "<script language='javascript'>alert('Không thể kết nối !');";
            echo "location.href='ui-blog.php';</script>";
        }
?>

<style> div.row { padding-top: 2%;}</style>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

<!-- Nội dung ở đây -->
<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Chỉnh sửa bài viết</h4>
                    </div>
                </div>
                <div class="card-body">

<form  method="post" action="" name="CapNhatBaiViet" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên sản phẩm: </strong></div>
<?php $sl_hanghoa = "select * from Product";
        $rs_hanghoa = mysqli_query($conn,$sl_hanghoa);
        if(!$rs_hanghoa)
        {
            // echo "<script language='javascript'>alert('Không thể kết nối !');";
            // echo "location.href='ui-blog.php';</script>";
        }?>
        <div class="col-md-9">
            <select class= "selectpicker form-control" name="idProduct" data-style="py-0">
                <?php while ($r = $rs_hanghoa->fetch_assoc()) {?>
                    <option value="<?php echo $r["idProduct"]; if($r["idProduct"] ==$_GET['idBlog']) echo "selected";?>"> <?php echo $r['ProductName'];?></option>
                <?php }?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Tiêu đề</strong></div>
        <div class="col-md-9"><input type="text" class="form-control" name="BlogTitle" value="<?php echo $row_bv['BlogTitle'];?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Mô tả ngắn</strong></div>
        <div class="col-md-9"><textarea class="form-control" name="BlogDesc" cols="" rows=""><?php echo $row_bv['BlogDesc'];?></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace( 'BlogDesc');
        </script>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Hình đại diện</strong></div>
        <div class="col-md-9">
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000">
            <div>Hình hiện tại: <input type="text"class="form-control" readonly  name="BlogImage" value="<?php echo $row_bv['BlogImage'];?>">
            </div>

            <div><input  class="form-control image-file" type="file" name="file"></div>
   
                                   
                                </div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Nội dung </strong></div>
        <div class="col-md-9"><textarea class="form-control" name="BlogContent" cols="" rows=""><?php echo $row_bv['BlogContent'];?></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace( 'BlogContent');
        </script>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ngày cập nhật</strong></div>
        <div class="col-md-9"><input class="form-control"  type="text" name="Date" readonly="readonly" value="<?php echo $row_bv['Date'];?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong></strong></div>
        <div class="col-md-9">
            <select class="selectpicker form-control" data-style="py-0" name="HideShow">
<?php if($row_bv['HideShow'] == 0)?>
                <option value="0" <?php if($row_bv['HideShow'] == 0) echo "selected";?>> <strong>Ẩn</strong></option>
                <option value="1" <?php if($row_bv['HideShow'] == 1) echo "selected";?>> <strong>Hiện</strong></option>

            </select>
        </div>
    </div>
    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input class="btn btn-primary mr-2" name="update" type="submit" value="Cập nhật" />
            <input class="btn btn-warning mr-2" name="delete" type="submit" value="Xóa"/>
            <input class="btn btn-danger mr-2" type="button" name="Huy" value="Trở về" onclick="getConfirmation()";>
        </div>
    </div>
</form>
</div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
    </div>
</div>
</div>
<script type="text/javascript">
    
    function getConfirmation(){
        var retVal = confirm("Bạn có muốn trở về không ?");
        if( retVal == true ){
            window.history.back();
        }
    }
    
</script>

<?php
$ngaycapnhat = date('Y-m-d H:m:s');
$anhcu = $row_bv['BlogImage'];

if(isset($_POST['update']) && isset($_POST['BlogTitle']) && isset($_POST['BlogContent'])) {
    if ($_FILES['file']['name'] != null)// người dùng  chọn ảnh mới => không thay đổi ảnh
    {
            /*file hợp lệ và tiến hành upload*/
            $path = "../assets/images/"; // file lưu vào thư mục images
            $tmp_name = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $type = $_FILES['file']['type'];
            $size = $_FILES['file']['size'];
            if (file_exists($path . $_FILES["file"]["name"]))// dò trùng ảnh trong folder
            {
                echo "<script language='javascript'>alert('Tên ảnh đã tồn tại!');</script>";
            } else /// không trùng tên trong folder
            {

                $q_up_baiviet = "update Blog
                        set idProduct=" . $_POST['idProduct'] . ",BlogTitle=N'" . $_POST['BlogTitle'] . "',BlogContent=N'" . $_POST['BlogContent'] . "',
                        Date='" . $ngaycapnhat . "',HideShow=" . $_POST['HideShow'] . ",BlogDesc =N'" . $_POST['BlogDesc'] . "',BlogImage='" . $name . "'
                        where idBlog =" . $_GET['idBlog'];
                $rs_up_baiviet = mysqli_query($conn, $q_up_baiviet);
                if ($rs_up_baiviet) {
                    unlink('../assets/images/' . $anhcu);// xóa ảnh
                    // upload file
                    move_uploaded_file($tmp_name, $path . $name);
                    echo "<script language='javascript'>alert('Cập nhật thành công');";
                    echo "location.href = 'ui-blog.php';</script>";
                } else
                    echo "<script language='javascript'>alert('Cập nhật không thành công');";
            }
    }
    else// người dùng k thay đổi ảnh
    {
        // cập nhật thông tin ngoại trừ ảnh
        $q_up_baiviet = "update Blog
                        set idProduct=" . $_POST['idProduct'] . ",BlogTitle=N'" . $_POST['BlogTitle'] . "',BlogContent=N'" . $_POST['BlogContent'] . "',
                        Date='" . $ngaycapnhat . "',HideShow=" . $_POST['HideShow'] . ",BlogDesc =N'" . $_POST['BlogDesc'] . "'
                        where idBlog =" . $_GET['idBlog'];
        $rs_up_baiviet = mysqli_query($conn, $q_up_baiviet);
        if ($rs_up_baiviet) {
            echo "<script language='javascript'>alert('Cập nhật thành công');";
            echo "location.href = 'ui-blog.php';</script>";
        } else
            echo "<script language='javascript'>alert('Cập nhật không thành công');";
    }
}

if(isset($_POST['delete'])) {
$q_delete_bv = "delete  from Blog where idBlog =".$_GET['idBlog'];
$rs_delete_bv = mysqli_query($conn, $q_delete_bv);
if ($rs_delete_bv) {
    if (file_exists('../assets/images/'. $anhcu))// dò xem có ảnh trong folder k
    {
        if (is_file('../assets/images/' . $anhcu))// xóa ảnh cũ:
        {
            unlink('../assets/images/' . $anhcu);
        }

    }
echo "<script language='javascript'>alert('Xóa thành công');";
    echo "location.href = 'ui-blog.php';</script>";
} else
echo "<script language='JavaScript'> alert('Xóa  không thành công!');</script>";
}
?>

<?php include_once ('../inc/footer.php');?>
