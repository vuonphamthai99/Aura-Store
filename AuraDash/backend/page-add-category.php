<?php
    include '../inc/header.php';
?>
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCategory'])){
        $insertCategory= $category->insert_category($_POST);
    }

?>
<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <?php
                if(isset($insertCategory)){
                    echo $insertCategory;
                }
            ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Thêm danh mục sản phẩm</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" data-toggle="validator" method="POST" enctype="multipart/form-data">
                        <div class="row">  
                            <div class="col-md-12">                      
                                <div class="form-group">
                                    <label>Tên danh mục *</label>
                                    <input type="text" name="tenCate"  class="form-control" placeholder="Nhập Tên Danh Mục"  required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>                                 
                             
                            
                        </div>                            
                        <input type="submit" name="addCategory" class="btn btn-primary mr-2" value="Thêm Danh Mục">
                        <a href="page-list-category.php" class="btn btn-light mr-2">Trở Về</a>
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