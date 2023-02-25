<?php
    include '../inc/header.php';
?>
<?php
	if(isset($_GET['idSale']) && isset($_GET['idProduct'])){
        $idSale = $_GET['idSale'];
        $idProduct = $_GET['idProduct'];
		$del_sale_pd = $pd->delete_sale_pd($idSale);
    }
?>

<div class="content-page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <?php
                        $get_total_discount = $pd->get_total_discount();
                        if($get_total_discount){
                            while($result_total_discount = $get_total_discount->fetch_assoc()){
                    ?>
                    <h4 class="mb-3">Danh Sách Khuyến Mãi ( Tổng: <?php echo $result_total_discount['total_discount'] ?> đợt )</h4>
                    <?php
                            }
                        }
                    ?>
                    <p class="mb-0">Danh sách khuyến mãi hiện có. <br>
                    Trang này hiện thông tin các sản phẩm khuyến mãi theo đợt, có thể chỉnh sửa và xóa sản phẩm khuyến mãi.</p>
                </div>
                <a href="page-add-discount.php" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Thêm khuyến mãi</a>
            </div>
        </div>
        <?php
            if(isset($del_sale_pd)){
                echo $del_sale_pd;
            }
        ?>
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
            <table class="data-tables table mb-0 tbl-server-info">
                <thead class="bg-white text-uppercase">
                    <tr class="ligth ligth-data">
                        <th> Tên khuyến mãi </th>
                        <th> Sản phẩm </th>
                        <th> Bắt đầu </th>
                        <th> Kết thúc </th>
                        <th> % Giảm </th>
                        <th> Thao tác </th>
                    </tr>
                </thead>
                <tbody class="ligth-body">
                    <?php
                        $show_list_discount = $pd->show_list_discount();
                        if($show_list_discount){
                                while($result = $show_list_discount->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $result['SaleName']; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
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
                                <div><?php echo $result['ProductName']?></div>
                            </div>
                        </td>
                        <td><?php echo $result['SaleStart']; ?></td>
                        <td><?php echo $result['SaleEnd']; ?></td>
                        <td><?php echo $result['Discount']; ?></td>
                        <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sửa"
                                    href="page-edit-discount.php?idSale=<?php echo $result['idSale']?>&idProduct=<?php echo $result['idProduct']?>"><i class="ri-pencil-line mr-0"></i></a>
                                
                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"
                                href="?idSale=<?php echo $result['idSale']?>&idProduct=<?php echo $result['idProduct']?>" onclick="return confirm('Bạn có muốn xóa khuyến mãi của sản phẩm <?php echo $result['ProductName']?> không?')"><i class="ri-delete-bin-line mr-0"></i></a>
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