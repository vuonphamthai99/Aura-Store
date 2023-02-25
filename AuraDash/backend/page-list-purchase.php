<?php
    include '../inc/header.php';
    if(isset($_GET['conf_idBill'])){
        $idBill = $_GET['conf_idBill'];
		$conf = $sale->conf_Bill($idBill);
    }
    
    if(isset($_GET['idBill']) && isset($_GET['idCustomer'])){
        $idBill = $_GET['idBill'];
        $idCustomer = $_GET['idCustomer'];
		$del_bill = $sale->del_Bill($idBill,$idCustomer);
    }
?>

<div class="content-page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <?php
                        $get_total_bill = $sale->total_bill();
                        if($get_total_bill){
                            while($result_total_bill = $get_total_bill->fetch_assoc()){
                    ?>
                    <h4 class="mb-3">Danh Sách Đơn Hàng ( Tổng: <?php echo $result_total_bill['total_bill'] ?> đơn )</h4>
                    <?php
                            }
                        }
                    ?>
                    <p class="mb-0">Trang tổng quan mua hàng cho phép người quản lý mua hàng theo dõi, đánh giá một cách hiệu quả, <br>
                        và tối ưu hóa tất cả các quy trình mua lại trong một công ty.</p>
                </div>
                <!-- <a href="page-add-purchase.php" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Thêm đơn hàng</a> -->
            </div>
        </div>
        <?php
            if(isset($del_bill)) echo $del_bill;
            if(isset($conf)) echo $conf;
        ?>
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
            <table class="data-tables table mb-0 tbl-server-info">
                <thead class="bg-white text-uppercase">
                    <tr class="ligth ligth-data">
                        <th>Mã ĐH</th>
                        <th>Tên tài khoản</th>
                        <th>SĐT</th>
                        <!-- <th>Tổng tiền</th> -->
                        <th>Ngày đặt hàng</th>
                        <th>Ngày giao hàng</th>
                        <th>Trạng Thái</th>
                        <th>NV xác nhận</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="ligth-body">
                    <?php
                        $get_cart = $ct->get_cart_ordered_all();
                        if($get_cart){
                            while($result = $get_cart->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $result['idBill']?></td>
                        <td><?php echo $result['username']?></td>
                        <td><?php echo $result['PhoneNumber']?></td>                            
                        <!-- <td><?php echo $fm->adddotstring($result['TotalBill'])?>đ</td> -->
                        <td><?php echo $result['OrderDate'];?></td>
                        <td><?php echo $result['ReceiveDate'];?></td>
                        <td>
                        <?php
                            if($result['Status'] == '0'){
                                echo '<div class=" align-items-center badge badge-warning">Chờ xác nhận</div>' ;
                            }
                            else if($result['Status'] == '1'){
                                echo '<div class="badge badge-info">Đã xác nhận</div>' ;
                            }
                            else echo '<div class="badge badge-success">Đã hoàn thành</div>' ;
                        ?>
                        </td>
                        <td>
                            <?php
                                if($result['Status'] == '0'){
                                    echo '<div class=" align-items-center badge badge-warning">Chờ xác nhận</div>' ;
                                }else{
                                    echo $result['AdminName'];
                                }
                            ?>
                        </td>
                        <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge badge-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xem chi tiết"
                                    href="pages-invoice.php?idBill=<?php echo $result['idBill']?>&idCustomer=<?php echo $result['idCustomer']?>"><i class="ri-eye-line mr-0"></i></a>
                                <?php
                                    if($result['Status'] == '0'){
                                ?>
 
                                <a class="badge badge-info mr-2 <?php echo $result['Payment'] ?>" value="<?php echo $result['idBill'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xác nhận đơn hàng"
                                    href="<?php if ($result['Payment']=="cash"){echo"?conf_idBill=".$result['idBill'];}else {echo("#");}?>"><i class="ri-thumb-up-line mr-0"></i></a>
                                    
                                <a class="badge badge-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hủy đơn hàng"
                                    href="?idBill=<?php echo $result['idBill']?>&idCustomer=<?php echo $result['idCustomer']?>" onclick="return confirm('Bạn có muốn xóa đơn hàng này không?')"><i class="ri-delete-bin-line mr-0"></i></a>
                                <?php
                                    }
                                ?>
                            </div>
                            <!-- ?conf_idBill=<?php echo $result['idBill']?>? -->
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