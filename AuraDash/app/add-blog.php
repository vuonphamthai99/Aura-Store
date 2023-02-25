<?php  include '../inc/header.php';?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<style> div.row {padding-top: 2%;}</style>
<!-- Nội dung ở đây -->
<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Thêm bài viết</h4>
                    </div>
                </div>
                <div class="card-body">
<form  method="post" action="" name="ThemBaiViet" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"><strong>Tên sản phẩm: </strong></div>
        <?php $sl_hanghoa = "select * from Product";
        $rs_hanghoa = mysqli_query($conn,$sl_hanghoa);
        if(!$rs_hanghoa)
            echo "Không thể truy vấn CSDL";?>
        <div class="col-md-9">
            <select class= "selectpicker form-control" name="idProduct" data-style="py-0">
                <?php while ($r = $rs_hanghoa->fetch_assoc()) {?>
                    <option value="<?php echo $r["idProduct"];?>"> <?php echo $r['ProductName'];?> </option>
                <?php }?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Tiêu đề</strong></div>
        <div class="col-md-9"><input class="form-control" type="text" name="BlogTitle" value=""></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Hình đại diện</strong></div>
        <div class="col-md-9">
            <input type="hidden" name="MAX_FILE_SIZE" value="200000">
            <label> Mời bạn chọn hình</label>
            <div><input class="form-control image-file" type="file" name="file" id="file"></div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Mô tả ngắn:  </strong></div>
        <div class="col-md-9"><textarea class="form-control" name="BlogDesc" cols="" rows="" ></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace( 'BlogDesc' );
        </script>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Nội dung </strong></div>
        <div class="col-md-9"><textarea class="form-control" name="BlogContent" cols="" rows="" ></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace( 'BlogContent' );
        </script>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Ngày cập nhật</strong></div>
        <div class="col-md-9"><input class="form-control" type="text" name="Date" readonly="readonly" value="<?php echo date("Y-m-d h:i:s");?>"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong></strong></div>
        <div class="col-md-9">
            <select class="selectpicker form-control" data-style="py-0" name="HideShow">
                <option value="0"> <strong>Ẩn</strong></option>
                <option value="1"> <strong>Hiện</strong></option>

            </select>
        </div>
    </div>
    <div class=" row">
        <div class=" col-md-4 col-md-offset-4">
            <input class="btn btn-primary mr-2" name="Ok" type="submit" value="Ok" />
            <input class="btn btn-warning mr-2" type="button" name="Huy" value="Hủy" onclick="getConfirmation()";>
        </div>
    </div>
</form>
<script type="text/javascript">

    function getConfirmation(){
        var retVal = confirm("Bạn có muốn hủy ?");
        if( retVal == true ){
            window.history.back();
        }
    }
    
</script>
<?php
if(isset($_POST['Ok']) &&isset($_POST['BlogContent'])&& isset($_POST['BlogTitle']) && isset($_POST['BlogDesc'])) {
        if ($_FILES['file']['name'] != null) {
        }
        $path = '../images/';
        // file lưu vào thư mục images
        $tmp_name = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $size = $_FILES['file']['size'];
        if (file_exists($path . $_FILES["file"]["name"]))// dò trùng ảnh trong folder
        {
            echo "<script language='javascript'>alert('Tên ảnh đã tồn tại!');</script>";
        }
        else {
            $q_baiviet = "insert into Blog(idProduct,BlogTitle,BlogContent,Date,HideShow,BlogDesc,BlogImage) VALUES (" . $_POST['idProduct'] . ",N'" . $_POST['BlogTitle'] . "',
            '" . $_POST['BlogContent'] . "','" . $_POST['Date'] . "'," . $_POST['HideShow'] . ",N'" . $_POST['BlogDesc'] . "','".$name."')";
            $rs = mysqli_query($conn, $q_baiviet);
            echo '<span>'.$rs.'</span>';
            echo '<span>'.$q_baiviet.'</span>';
            if ($rs) {
                // upload file
                move_uploaded_file($tmp_name, $path . $name);
                echo "<script language='javascript'>alert('Thêm thành công');";
                echo "location.href = 'ui-blog.php';</script>";
            } else{
                echo "<script language='JavaScript'> alert('Thêm không thành công!');</script>";
            }
        }

}
?>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<?php include_once ('../inc/footer.php');?>

