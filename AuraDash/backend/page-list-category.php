<?php
    include '../inc/header.php';
?>
<?php
	if(isset($_GET['idCategory'])){
        $idCategory = $_GET['idCategory'];
		$delcategory = $category->del_category($idCategory);
    }
?>

<div class="content-page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <?php
                        $get_total_category = $category->total_category();
                        if($get_total_category){
                            while($result_total_category = $get_total_category->fetch_assoc()){
                    ?>
                    <h4 class="mb-3">Danh Mục Sản Phẩm ( Tổng: <?php echo $result_total_category['total_category'] ?> danh mục )</h4>
                    <?php
                            }
                        }
                    ?>
                    <p class="mb-0">Danh mục sản phẩm hiện có. <br>
                    Chọn tên loại sản phẩm trước khi thêm danh sách sản phẩm mới. .</p>
                </div>
                <a href="page-add-category.php" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Thêm danh mục sản phẩm</a>
            </div>
        </div>
         <?php
            if(isset($delcategory)){
                echo $delcategory;
            }
        ?>
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
            <table class="data-tables table mb-0 tbl-server-info">
                <thead class="bg-white text-uppercase">
                    <tr class="ligth ligth-data">
                        <th>Mã danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="ligth-body">
                    <?php
                        $get_list_category = $category->show_list_category();
                        if($get_list_category){
                                while($result = $get_list_category->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $result['idCategory']; ?></td> 
                        <td><?php echo $result['CategoryName']; ?></td>
                        <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa"
                                    href="editcategory.php?idCategory=<?php echo $result['idCategory']?>"><i class="ri-pencil-line mr-0"></i></a>
                                
                                    <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"
                                    href="?idCategory=<?php echo $result['idCategory']?>" onclick="return confirm('Bạn có muốn xóa danh mục <?php echo $result['CategoryName']?> không?')"><i class="ri-delete-bin-line mr-0"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                            }    
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- Page end  -->
</div>
<!-- Modal Edit -->
<div class="modal fade" id="edit-note" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <div class="media align-items-top justify-content-between">                            
                        <h3 class="mb-3">Product</h3>
                        <div class="btn-cancel p-0" data-dismiss="modal"><i class="las la-times"></i></div>
                    </div>
                    <div class="content edit-notes">
                        <div class="card card-transparent card-block card-stretch event-note mb-0">
                            <div class="card-body px-0 bukmark">
                                <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">                                                    
                                    <div class="quill-tool">
                                    </div>
                                </div>
                                <div id="quill-toolbar1">
                                    <p>Virtual Digital Marketing Course every week on Monday, Wednesday and Saturday.Virtual Digital Marketing Course every week on Monday</p>
                                </div>
                            </div>
                            <div class="card-footer border-0">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                    <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                    <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<!-- Wrapper End-->

<?php
    include '../inc/footer.php';
?>