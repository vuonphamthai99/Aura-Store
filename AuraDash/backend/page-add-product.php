<?php
    include '../inc/header.php';
?>

<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addproduct'])){
		$insertProduct = $pd->insert_product($_POST, $_FILES);
	}
?>

<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <?php
                if(isset($insertProduct)) {
                    echo $insertProduct;
                }
            ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Thêm sản phẩm</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" id="form-insert-product" data-toggle="validator" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">                      
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input id="ProductName" name="ProductName" type="text" class="form-control" placeholder="Vui lòng nhập tên" data-errors="Please Enter Name." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select id="idCategory" name="idCategory" class="selectpicker form-control" data-style="py-0" required>
                                        <option value="">Chọn danh mục sản phẩm</option>
                                        <?php
                                            $catlist = $category->show_list_category();
                                            if($catlist) {
                                                while($result = $catlist->fetch_assoc()){           
                                        ?>
                                        <option value="<?php echo $result['idCategory']?>"><?php echo $result['CategoryName']?></option>
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
                                    <select id="idBrand" name="idBrand" class="selectpicker form-control" data-style="py-0" required>
                                        <option value="">Chọn thương hiệu sản phẩm</option>
                                        <?php
                                            $brandlist = $brand->show_list_brand();
                                            if($catlist) {
                                                while($result = $brandlist->fetch_assoc()){           
                                        ?>
                                        <option value="<?php echo $result['idBrand']?>"><?php echo $result['BrandName'] ?></option>
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
                                    <input id="Price" name="Price" type="number" class="form-control" placeholder="Vui lòng nhập giá" data-errors="Please Enter Price." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">                                    
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input id="Quantity" name="Quantity" type="number" class="form-control" placeholder="Vui lòng nhập số lượng" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ảnh *</label>
                                    <input name="ImageName[]" type="file" class="form-control image-file" multiple required/>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <textarea id="ShortDes_Pro" name="ShortDes_Pro" class="form-control" placeholder="Nhập mô tả ngắn" rows="2" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô tả / Chi tiết sản phẩm</label>
                                    <textarea id="DesProduct" name="DesProduct" class="form-control tinymce" placeholder="Nhập mô tả chi tiết" rows="4" required></textarea>
                                    <script>CKEDITOR.replace('DesProduct');</script>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>                            
                        <input type="submit" name="addproduct" class="btn btn-primary mr-2" value="Thêm sản phẩm">
                        <a href="page-list-product.php" class="btn btn-light">Trở về</a>
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