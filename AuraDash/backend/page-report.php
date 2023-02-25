<?php
    include '../inc/header.php';
?>

<div class="content-page">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Báo cáo doanh thu</h4>
                    </div>                        
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton1"
                                data-toggle="dropdown">
                                This Month<i class="ri-arrow-down-s-line ml-1"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right shadow-none"
                                aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item" href="#">NĂM</a>
                                <a class="dropdown-item" href="#">THÁNG</a>
                                <a class="dropdown-item" href="#">TUẦN</a>
                            </div>
                        </div>
                    </div>
                </div>                    
                <div class="card-body">
                    <div id="report-chart1"></div>
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