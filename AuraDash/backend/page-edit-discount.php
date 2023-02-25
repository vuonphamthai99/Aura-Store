<?php
    include '../inc/header.php';
?>

<?php
    if((!isset($_GET['idSale']) || $_GET['idSale']==NULL) && (!isset($_GET['idProduct']) || $_GET['idProduct']==NULL)){
        echo "<script>window.location ='page-list-discount.php'</script>";
    }else {
        $idSale = $_GET['idSale'];
        $idProduct = $_GET['idProduct'];
    }

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_discount'])){
		$updateDiscount = $pd->update_discount_product($_POST, $idSale, $idProduct);
	}
?>
<form action="" method="POST" id="form-insert-discount" data-toggle="validator" enctype="multipart/form-data" autocomplete="off">
<div class="content-page">
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12 alert-pd">
                <?php
                    if(isset($updateDiscount)) {
                        echo $updateDiscount;
                    }
                ?>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Sửa khuyến mãi sản phẩm</h4>
                        </div>
                    </div>
                    <?php
                        $get_discount_product = $pd->get_discount_product($idSale);
                        if($get_discount_product){
                                while($result = $get_discount_product->fetch_assoc()){
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">  
                                <label>Sản phẩm</label>                    
                                <div class="d-flex align-items-center mb-3">
                                    <?php
                                        $id = $result['idProduct'];
                                        $imglist = $pd->show_image_pd($id);
                                        if($imglist) {
                                            while($result_image = $imglist->fetch_assoc()) {
                                    ?>
                                    <img src="../assets/images/product/<?php echo $result_image['ImageName']?>" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                    <?php
                                            }
                                        }
                                    ?>
                                    <div style="color:#000;"><?php echo $result['ProductName']?></div>
                                </div>
                            </div>
                            <div class="col-md-12">                      
                                <div class="form-group">
                                    <label>Tên chương trình khuyến mãi</label>
                                    <input id="SaleName" name="SaleName" type="text" class="form-control" value="<?php echo $result['SaleName'];?>" placeholder="Vui lòng nhập tên" data-errors="Please Enter Name." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>  
                            <div class="col-md-6">                      
                                <div class="form-group">
                                    <label>Thời gian bắt đầu</label>
                                    <input type='text' name="datetime-start" id='datetime-start' value="<?php echo $result['SaleStart'];?>" placeholder="Nhập thời gian bắt đầu" class="form-control" />
                                    <span class="text-danger"></span>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Thời gian kết thúc</label>
                                    <input type='text' name="datetime-end" id='datetime-end' value="<?php echo $result['SaleEnd'];?>" placeholder="Nhập thời gian kết thúc" class="form-control" />
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">                                    
                                <div class="form-group">
                                    <label>Giảm giá</label>
                                    <input id="Discount" name="Discount" type="number" min="1" max="100" class="form-control" value="<?php echo $result['Discount'];?>" placeholder="% Giảm" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>                            
                        <input type="submit" name="update_discount" class="btn btn-primary mr-2" value="Cập nhật khuyến mãi" data-toggle="modal" data-target=".bd-example-modal-sm">
                        <a href="page-list-product.php" class="btn btn-light">Trở về</a>
                    </div>
                    <?php
                                }
                            }
                    ?>
                </div>
            </div>
        </div>
    <!-- Page end  -->
    </div>
</div>
</form>
</div>
<!-- Wrapper End-->

<?php
    include '../inc/footer2.php';
?>

<link rel="stylesheet" type="text/css" href="../assets/datetimepicker-master/jquery.datetimepicker.css">
<script src="../assets/datetimepicker-master/jquery.js"></script>
<script src="../assets/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
<script src="../assets/js/moment.js"></script>

<script>
    jQuery.datetimepicker.setLocale('vi');
    // $.datetimepicker.setDateFormatter('moment');
    jQuery(function(){
        jQuery('#datetime-start').datetimepicker({
            // format: 'DD-MM-YYYY HH:mm',
            format:'Y-m-d H:i',
            // timepicker: false,
            onShow:function( ct ){
                this.setOptions({
                    maxDate:jQuery('#datetime-end').val()?jQuery('#datetime-end').val():false
                })
            }
        });
        jQuery('#datetime-end').datetimepicker({
            // format: 'DD-MM-YYYY HH:mm',
            format:'Y-m-d H:i',
            // timepicker: false,
            onShow:function( ct ){
                this.setOptions({
                    minDate:jQuery('#datetime-start').val()?jQuery('#datetime-start').val():false
                })
            }
        });
    });
</script>

<script>
    Validator({
        form: "#form-insert-discount",
        errorSelector: ".text-danger",
        parentSelector: ".form-group",
        rules:[
            Validator.isRequired("#datetime-start"),
            Validator.isRequired("#datetime-end"),
            Validator.isSaleEndTimeSysdate("#datetime-end"),
            Validator.isSaleEndTime("#datetime-end",function(){
            return  document.querySelector("#form-insert-discount #datetime-start").value;
            }),
            Validator.isSaleStartTime("#datetime-start",function(){
            return  document.querySelector("#form-insert-discount #datetime-end").value;
            })
        ]
    })
</script>

</body>
</html>

