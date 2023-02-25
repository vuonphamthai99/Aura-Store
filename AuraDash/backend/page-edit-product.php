<?php
    include '../inc/header.php';
?>

<?php
    if(!isset($_GET['idProduct']) || $_GET['idProduct']==NULL){
        echo "<script>window.location ='productlist.php'</script>";
    }else {
        $id = $_GET['idProduct'];
    }

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateproduct'])){
		$updateProduct = $pd->update_product($_POST, $_FILES, $id);
	}
?>

<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <?php
                if(isset($updateProduct)) {
                    echo $updateProduct;
                }
            ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Chỉnh sửa sản phẩm</h4>
                    </div>
                </div>
                <?php
                    $pdlist = $pd->getproductbyId($id);
                    if($pdlist) {
                        while($result = $pdlist->fetch_assoc()) {
                ?>
                <div class="card-body">
                    <form action="" id="form-edit-product" method="POST" data-toggle="validator" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">                      
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input name="ProductName" type="text" class="form-control" value="<?php echo $result['ProductName']?>" placeholder="Nhập tên sản phẩm" data-errors="Please Enter Name." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select name="idCategory" class="selectpicker form-control" data-style="py-0" required>
                                        <option value="">Chọn danh mục sản phẩm</option>
                                        <?php
                                            $catlist = $category->show_list_category();
                                            if($catlist) {
                                                while($result_cat = $catlist->fetch_assoc()){           
                                        ?>
                                        <option
                                            <?php
                                                if($result_cat['idCategory'] == $result['idCategory']) {
                                                    echo 'selected';
                                                }
                                            ?> 
                                            value="<?php echo $result_cat['idCategory']?>"><?php echo $result_cat['CategoryName']?>
                                        </option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div> 
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Thương hiệu</label>
                                    <select name="idBrand" class="selectpicker form-control" data-style="py-0" required>
                                        <option value="">Chọn thương hiệu sản phẩm</option>
                                        <?php
                                            $brandlist = $brand->show_list_brand();
                                            if($brandlist) {
                                                while($result_brand = $brandlist->fetch_assoc()){           
                                        ?>
                                        <option 
                                            <?php
                                                if($result_brand['idBrand'] == $result['idBrand']) {
                                                    echo 'selected';
                                                }
                                            ?> 
                                            value="<?php echo $result_brand['idBrand']?>"><?php echo $result_brand['BrandName']?>
                                        </option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Price">Giá</label>
                                    <input id="Price" name="Price" type="number" class="form-control" value="<?php echo $result['Price']?>" placeholder="Vui lòng nhập giá" data-errors="Please Enter Price." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">                                    
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input name="Quantity" type="number" class="form-control" value="<?php echo $result['Quantity']?>" placeholder="Vui lòng nhập số lượng" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <input name="ImageName[]" type="file" class="form-control image-file" multiple/>
                                    <?php
                                        $imglist = $pd->show_list_image_pd($id);
                                        if($imglist) {
                                            while($result_image = $imglist->fetch_assoc()) {
                                    ?>
                                    <img src="../assets/images/product/<?php echo $result_image['ImageName']?>" class="img-fluid rounded avatar-100 mr-3 mt-2" alt="image">
                                    <?php
                                                }
                                            }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <textarea name="ShortDes_Pro" class="form-control" placeholder="Nhập mô tả ngắn" rows="2" required><?php echo $result['ShortDes_Pro']?></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô tả / Chi tiết sản phẩm</label>
                                    <textarea name="DesProduct" class="form-control" id="ten" placeholder="Nhập mô tả chi tiết" rows="4" required><?php echo $result['DesProduct']?></textarea>
                                    <script>CKEDITOR.replace('ten');</script>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>                            
                        <input type="submit" name="updateproduct" class="btn btn-primary mr-2" value="Cập nhật sản phẩm">
                        <a href="page-list-product.php" class="btn btn-light">Trở về</a>
                    </form>
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
</div>
<!-- Wrapper End-->


<?php
    include '../inc/footer.php';
?>