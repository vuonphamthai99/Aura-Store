<?php
    include '../inc/header.php';
?>

<?php
	if(isset($_GET['idProduct'])){
        $idProduct = $_GET['idProduct'];
		$delpro = $pd->del_product($idProduct);
    }
?>

<div class="content-page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <?php
                        $get_total_product = $pd->total_product();
                        if($get_total_product){
                            while($result_total_product = $get_total_product->fetch_assoc()){
                    ?>
                    <h4 class="mb-3">Danh Sách Sản Phẩm ( Tổng: <?php echo $result_total_product['total_product'] ?> sản phẩm )</h4>
                    <?php
                            }
                        }
                    ?>
                    <p class="mb-0">Danh sách sản phẩm quyết định hiệu quả việc trình bày sản phẩm và cung cấp không gian <br> để liệt kê các sản phẩm và dịch vụ của bạn theo cách hấp dẫn nhất.</p>
                </div>
                <a href="page-add-product.php" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Thêm sản phẩm</a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
            <table class="data-tables table mb-0 tbl-server-info">
                <?php
                    if(isset($delpro)){
                        echo $delpro;
                    }
                ?>
                <thead class="bg-white text-uppercase">
                    <tr class="ligth ligth-data">
                            <th> Mã </th>
                            <th> Sản phẩm </th>
                            <th> Danh mục </th>
                            <th> Thương hiệu </th>
                            <th> Số lượng </th>
                            <th> Sửa/Xóa </th>
                    </tr>
                </thead>
                <tbody class="ligth-body">
                    <?php
                        $pdlist = $pd->show_product();
                        if($pdlist) {
                            while($result = $pdlist->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $result['idProduct']?></td>
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
                        <td><?php echo $result['CategoryName']?></td>
                        <td><?php echo $result['BrandName']?></td>
                        <td><?php echo $result['Quantity']?></td>
                        <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                    href="#"><i class="ri-eye-line mr-0"></i></a>
                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                    href="page-edit-product.php?idProduct=<?php echo $result['idProduct']?>"><i class="ri-pencil-line mr-0"></i></a>
                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                    href="?idProduct=<?php echo $result['idProduct']?>" onclick="return confirm('Bạn có muốn xóa sản phẩm <?php echo $result['ProductName']?> không?')"><i class="ri-delete-bin-line mr-0"></i></a>
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
</div>
<!-- Wrapper End-->

<?php
    include '../inc/footer.php';
?>