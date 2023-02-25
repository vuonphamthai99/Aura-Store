<?php
    include '../inc/header.php';
?>

<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_discount'])){
		$insertDiscount = $pd->insert_discount_product($_POST);
	}
?>
<form action="" method="POST" id="form-insert-discount" data-toggle="validator" enctype="multipart/form-data" autocomplete="off">
<div class="content-page">
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12 alert-pd">
                <?php
                    if(isset($insertDiscount)) {
                        echo $insertDiscount;
                    }
                ?>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Thêm khuyến mãi</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">                      
                                <div class="form-group">
                                    <label>Tên chương trình khuyến mãi</label>
                                    <input id="SaleName" name="SaleName" type="text" class="form-control" placeholder="Vui lòng nhập tên" data-errors="Please Enter Name." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>  
                            <div class="col-md-6">                      
                                <div class="form-group">
                                    <label>Thời gian bắt đầu</label>
                                    <input type='text' name="datetime-start" id='datetime-start' placeholder="Nhập thời gian bắt đầu" class="form-control" />
                                    <span class="text-danger"></span>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Thời gian kết thúc</label>
                                    <input type='text' name="datetime-end" id='datetime-end' placeholder="Nhập thời gian kết thúc" class="form-control" />
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">                                    
                                <div class="form-group">
                                    <label>Giảm giá</label>
                                    <input id="Discount" name="Discount" type="number" min="1" max="100" class="form-control" placeholder="% Giảm" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">                                    
                                <label>Sản phẩm</label>
                                <div class="row form-group list-product">
                                    <a href="#" class="col-md-2 btn add-btn shadow-none d-none d-md-block add-product" data-toggle="modal" data-target="#select-products">
                                        <i class="las la-plus mr-2" style="font-size:24px;"></i>
                                        <br><span>Thêm Sản Phẩm</span>
                                    </a>
                                </div>
                            </div>
                        </div>                            
                        <input type="submit" name="add_discount" class="btn btn-primary mr-2" value="Thêm khuyến mãi" data-toggle="modal" data-target=".bd-example-modal-sm">
                        <a href="page-list-product.php" class="btn btn-light">Trở về</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- Page end  -->
    </div>
</div>

<div class="modal fade" id="select-products" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chọn sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <?php
                    $pdlist = $pd->show_product();
                    if($pdlist) {
                        while($result = $pdlist->fetch_assoc()) {
                ?>
                <div class="product-item col-md-3 select-pd" id="product-item-<?php echo $result['idProduct'];?>" data-id="<?php echo $result['idProduct'];?>">
                    <div class="product-image mb-3" id="product-image-<?php echo $result['idProduct'];?>">
                        <?php
                            $id = $result['idProduct'];
                            $imglist = $pd->show_image_pd($id);
                            if($imglist) {
                                while($result_image = $imglist->fetch_assoc()) {
                                    $img_pd = $result_image['ImageName'];
                        ?>
                        <label for="chk-pd-<?php echo $id;?>"><img src="../assets/images/product/<?php echo $result_image['ImageName']?>" class="rounded w-100 img-fluid"/></label>
                        <?php
                                }
                            }
                        ?>

                        <div class="product-title">
                            <div class="product-name">
                                <input type="checkbox" class="checkstatus d-none" id="chk-pd-<?php echo $result['idProduct'];?>" name="chk_product[]" value="<?php echo $result['idProduct'];?>" data-id="<?php echo $result['idProduct'];?>" data-name="<?php echo $result['ProductName']?>" data-price="<?php echo $result['Price']?>" data-img="<?php echo $img_pd;?>">
                                <span><?php echo $result['ProductName']?></span>
                            </div>
                            <div style="text-align:center;"><?php echo $fm->adddotstring($result['Price'])?>đ</div>
                        </div>
                    </div>
                    <input type="hidden" name="selected_product[]" id="product-<?php echo $result['idProduct'];?>" value="" />
                </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" id="confirm" class="btn btn-primary" data-dismiss="modal">Xác nhận</button>
            </div>
        </div>
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
    $("input[type=checkbox]").on("click", function() {
        var product_id = $(this).data("id");
        var product_name = $(this).data("name");
        var product_price = $(this).data("price");
        var product_img = $(this).data("img");

        if($(this).is(":checked")){
            $("#product-image-"+product_id).css("border","#ff7a6a 3px solid");
            $("#product-"+product_id).val(product_id);
            $(document).ready(function(){
                $("#confirm").click(function(){
                    if($(".list-product > #product-list-item-"+product_id).length < 1)
                    $(".list-product").append('<div class="product-item col-md-2" id=product-list-item-'+ product_id +'><div class="product-image" id=product-list-image-'+ product_id +'><img src="../assets/images/product/'+ product_img +'" class="rounded w-100 img-fluid"><div class="product-title"><div class="product-name"><span>'+product_name+'</span></div></div></div></div>');
                })
            })
        }
        else if($(this).is(":not(:checked)")){
            $("#product-image-"+product_id).css("border","none");
            $("#product-"+product_id).val("	");
            $(document).ready(function(){
                $("#confirm").click(function(){
                    $(".list-product > #product-list-item-"+product_id).remove();
                })
            })
        }
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

    $(document).ready(function() {
        $('#form-insert-discount').submit(function() {
            var $fields = $(this).find('input[name="chk_product[]"]:checked');
            if (!$fields.length) {
                $(".alert-pd").append('<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"  aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-sm"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Thông báo</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p>Chưa thêm sản phẩm khuyến mãi.</p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button></div></div></div></div>');
                return false; // The form will *not* submit
            }
        });
    });
</script>

</body>
</html>

