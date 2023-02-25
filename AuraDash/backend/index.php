<?php
    ob_start();
    include '../inc/header.php';
    include './report-data.php';
    
    if(isset($_GET['sort'])){
        $sort = $_GET['sort'];
        if($sort == 'lastweek'){
            $type_sort = '7 Ngày Qua';
        }
        else if($sort== 'lastmonth'){
            $type_sort = '4 Tuần Qua';
        }
        
    }
    else {
        $sort = 'lastweek';
        $type_sort = '7 Ngày Qua';
    }
    $sale_all = $report->get_sale_all();
    $pd_sold = $report->get_product_sold();
?>

<div class="content-page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-transparent card-block card-stretch card-height border-none">
            <?php
                    $id = Session::get('idAdmin');
                    $get_admin = $admin->show_admin($id);
                    if($get_admin){
                        while($result = $get_admin->fetch_assoc()){
                ?>
            <div class="card-body p-0 mt-lg-2 mt-0">
                    <h3 class="mb-3">Hi <?php echo $result['AdminName']?>, Good Morning</h3>
                    <p class="mb-0 mr-4">
Trang tổng quan của bạn cung cấp cho bạn các quan điểm về hiệu suất chính hoặc quy trình kinh doanh.</p>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-6 col-md-4">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4 card-total-sale">
                                <div class="icon iq-icon-box-2 bg-info-light">
                                    <img src="../assets/images/product/1.png" class="img-fluid" alt="image">
                                </div>
                                <div>
                                    <p class="mb-2">Tổng Doanh Thu</p>
                                    <h4><?php echo $fm->adddotstring($sale_all); ?> đ</h4>
                                </div>
                            </div>                                
                            <div class="iq-progress-bar mt-2">
                                <span class="bg-info iq-progress progress-1" data-percent="85">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-4">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4 card-total-sale">
                                <div class="icon iq-icon-box-2 bg-success-light">
                                    <img src="../assets/images/product/3.png" class="img-fluid" alt="image">
                                </div>
                                <div>
                                    <p class="mb-2">Tổng Sản Phầm Bán Ra</p>
                                    <h4><?php echo $pd_sold; ?> sản phẩm</h4>
                                </div>
                            </div>
                            <div class="iq-progress-bar mt-2">
                                <span class="bg-success iq-progress progress-1" data-percent="75">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Doanh Thu Cửa Hàng</h4>
                    </div>
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton002"
                                data-toggle="dropdown">
                                <?php echo $type_sort; ?><i class="ri-arrow-down-s-line ml-1"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                aria-labelledby="dropdownMenuButton002">
                                <a class="dropdown-item" href="index.php?sort=lastweek">7 Ngày Qua</a>
                                <a class="dropdown-item" href="index.php?sort=lastmonth">4 Tuần Qua</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div id="bar-<?php echo $sort ?>" style="height: 250px;"></div>
                
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
    include './report-data.php';
?>
<?php
    include '../inc/footer.php';
?>