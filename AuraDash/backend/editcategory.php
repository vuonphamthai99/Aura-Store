<?php
    include '../inc/header.php';
?>
<?php
    if(!isset($_GET['idCategory']) || $_GET['idCategory']==NULL){
        // echo "<script>window.location ='productlist.php'</script>";
    }else {
        $idCategory = $_GET['idCategory'];
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updCategory'])){
        $updateCategory= $category->update_Category($_POST, $idCategory);
    }
    
?>
<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Cập nhật danh mục sản phẩm</h4>
                        <?php
                if(isset($updateCategory)){
                    echo $updateCategory;
                }
            ?>
                    </div>
                </div>
                <div class="card-body">
                <?php
                                    $getCategorybyidCategory = $category->get_Category_by_idCategory($idCategory);
                                        if($getCategorybyidCategory){
                                            while($result = $getCategorybyidCategory->fetch_assoc()){
                                ?>
                    <form action="" data-toggle="validator" method="POST" enctype="multipart/form-data">
                        <div class="row">  
                            <div class="col-md-12">                      
                                <div class="form-group">
                                    <label>Tên danh mục *</label>
                               
                                        
                                    <input type="text" name="tenCate"  class="form-control" value="<?php echo $result['CategoryName']?>" placeholder="Nhập Tên Danh Mục"  required>
                                   
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>                                 
                           
                            
                        </div>                            
                        <input type="submit" name="updCategory" class="btn btn-primary mr-2" value="Sửa Danh Mục">
                        <a href="page-list-category.php" class="btn btn-light mr-2">Trở Về</a>
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