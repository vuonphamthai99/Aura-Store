<?php
    include '../inc/header.php';
?>

<?php
	if(isset($_GET['idBrand'])){
        $idBrand = $_GET['idBrand'];
		$delbrand = $brand->del_brand($idBrand);
    }
?>

<div class="content-page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <?php
                        $get_total_brand = $brand->total_brand();
                        if($get_total_brand){
                            while($result_total_brand = $get_total_brand->fetch_assoc()){
                    ?>
                    <h4 class="mb-3">Danh Sách Thương Hiệu ( Tổng: <?php echo $result_total_brand['total_brand'] ?> thương hiệu )</h4>
                    <?php
                            }
                        }
                    ?>
                    <p class="mb-0">Danh sách các thương hiệu hợp tác với cửa hàng<br>
                        Bảng điều khiên thực hiện chức năng.</p>
                </div>
                <a href="page-add-supplier.php" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Thêm Thương Hiệu</a>
            </div>
        </div>
        <?php
            if(isset($delbrand)){
                echo $delbrand;
            }
        ?>
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
            <table class="data-tables table mb-0 tbl-server-info">
                <thead class="bg-white text-uppercase">
                    <tr class="ligth ligth-data">
                        
                        <th>Tên thương hiệu</th>
                        <th>Mã thương hiệu</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="ligth-body">
                    <?php
                        $get_list_brand = $brand->show_list_brand();
                        if($get_list_brand){
                                while($result = $get_list_brand->fetch_assoc()){
                    ?>
                    <tr>
                        
                        <td><?php echo $result['BrandName']; ?></td>
                        <td><?php echo $result['idBrand']; ?></td>
                        <td><?php echo $result['BrandAddress']; ?></td>
                        <td><?php echo $result['BrandPhone']; ?> </td>
                        <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                    href="editbrand.php?idBrand=<?php echo $result['idBrand']?>"><i class="ri-pencil-line mr-0"></i></a>
                                    <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"
                                    href="?idBrand=<?php echo $result['idBrand']?>" onclick="return confirm('Bạn có muốn xóa thương hiệu <?php echo $result['BrandName']?> không?')"><i class="ri-delete-bin-line mr-0"></i></a>
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