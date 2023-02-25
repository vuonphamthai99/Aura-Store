<?php
    include '../inc/header.php';
?>

<?php
	if(isset($_GET['idCustomer'])){
        $idCustomer = $_GET['idCustomer'];
		$delcus = $admin->del_customer($idCustomer);
    }
?>

<div class="content-page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <?php
                        $get_total_customer = $cs->total_customer();
                        if($get_total_customer){
                            while($result_total_customer = $get_total_customer->fetch_assoc()){
                    ?>
                    <h4 class="mb-3">Danh Sách Tài Khoản Khách Hàng ( Tổng: <?php echo $result_total_customer['total_customer'] ?> khách hàng )</h4>
                    <?php
                            }
                        }
                    ?>
                    <p class="mb-0">Trang hiển thị danh sách tài khoản khách hàng, cung cấp thông tin về khách hàng, các chức năng và điều khiển. </p>
                </div>
            </div>
        </div>
        <?php
            if(isset($delcus)){
                echo $delcus;
            }
        ?>
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
            <table class="data-tables table mb-0 tbl-server-info">
                <thead class="bg-white text-uppercase">
                    <tr class="ligth ligth-data">
                        <th>Avatar</th>
                        <th>Tên Tài Khoản</th>
                        <th>Họ Và Tên</th>
                        <th>Số Điện Thoại</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="ligth-body">
                    <?php
                        $get_list_customers = $cs->show_list_customers();
                        if($get_list_customers){
                            while($result = $get_list_customers->fetch_assoc()){
                    ?>
                    <tr>
                        <?php
                            if($result['Avatar']){
                        ?>
                        <td class="text-center"><img class="rounded img-fluid avatar-40"
                                 src="../../assets/images/customer/<?php echo $result['Avatar']?>" alt="profile"></td>
                        <?php
                            }else{
                                echo '<td class="text-center"><img class="rounded img-fluid avatar-40"
                                    src="../../assets/images/customer/1.png" alt="profile"></td>';
                            }
                        ?>
                        <td><?php echo $result['username']?></td>
                        <td><?php echo $result['CustomerName']?></td>
                        <td><?php echo $result['PhoneNumber']?></td>
                        <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                    href="?idCustomer=<?php echo $result['idCustomer']?>" onclick="return confirm('Bạn có muốn xóa tài khoản khách hàng <?php echo $result['username']?> không?')"><i class="ri-delete-bin-line mr-0"></i></a>
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