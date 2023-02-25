<?php
    include '../inc/header.php';
?>
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addbrand'])){
        $insertBrand= $brand->insert_brand($_POST);
    }

?>

<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <?php
                if(isset($insertBrand)){
                    echo $insertBrand;
                }
            ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Thêm Thương Hiệu</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" data-toggle="validator">
                        <div class="row"> 
                            <div class="col-md-6">                      
                                <div class="form-group">
                                    <label>Name *</label>
                                    <input type="text" name="tenTH" class="form-control" placeholder="Nhập tên thương hiệu" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Số điện thoại *</label>
                                    <input type="text" name="sdt" class="form-control" placeholder="Nhập số điện thoại" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <textarea class="form-control" name="dc" rows="4"></textarea>
                                </div>
                            </div>
                            
                        </div>                             
                        <input type="submit" name="addbrand" class="btn btn-primary mr-2" value="Thêm thương hiệu">
                        <a href="page-list-suppliers.php" class="btn btn-light mr-2">Trở Về</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
    </div>
</div>
<!-- Wrapper End-->

<?php
    include '../inc/footer.php';
?>