<?php
    include '../inc/header.php';
?>
<?php
    if(!isset($_GET['idBrand']) || $_GET['idBrand']==NULL){
        // echo "Không đươ";
    }else {
        $idBrand = $_GET['idBrand'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updbrand'])){
        $update_brand= $brand->update_brand($_POST,$idBrand);
    }

?>

<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <?php
                if(isset($update_brand)){
                    echo $update_brand;
                }
            ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Sửa Thương Hiệu</h4>
                    </div>
                </div>
                <div class="card-body">
                <?php
                                    $get_Brand_by_idBrand = $brand->get_Brand_by_idBrand($idBrand);
                                        if($get_Brand_by_idBrand){
                                            while($result = $get_Brand_by_idBrand->fetch_assoc()){
                                ?>
                    <form action="" method="POST" data-toggle="validator">
                        <div class="row"> 
                            <div class="col-md-6">                      
                                <div class="form-group">
                                    <label>Name *</label>
                                    <input type="text" name="tenTH" class="form-control" value="<?php echo $result['BrandName']?>" placeholder="Nhập tên thương hiệu" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Số điện thoại *</label>
                                    <input type="text" name="sdt" class="form-control" value="<?php echo $result['BrandPhone']?>" placeholder="Nhập số điện thoại" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" value="<?php echo $result['BrandAddress']?>" name="dc" rows="4"></input>
                                </div>
                            </div>
                            
                        </div>                             
                        <input type="submit" name="updbrand" class="btn btn-primary mr-2" value="Cập nhật thương hiệu">
                        <a href="page-list-suppliers.php" class="btn btn-light mr-2">Trở Về</a>
                    </form>
                    <?php
                                        }
                                    }
                                ?>
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