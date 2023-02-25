<?php
    include '../inc/header.php';
?>

<div class="content-page">
    <div class="container-fluid add-form-list">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Thêm đơn hàng</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="page-list-purchase.php" data-toggle="validator">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dob">Ngày *</label>
                                    <input type="date" class="form-control" id="dob" name="dob" />
                                </div>
                            </div>  
                            <div class="col-md-6">                      
                                <div class="form-group">
                                    <label>Mã đơn hàng *</label>
                                    <input type="text" class="form-control" placeholder="Mã đơn hàng" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Thương hiệu</label>
                                    <select name="type" class="selectpicker form-control" data-style="py-0">
                                        <option>Chọn thương hiệu</option>
                                        <option>Kiểm tra thương hiệu</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label>Trạng thái đơn hàng</label>
                                    <select name="type" class="selectpicker form-control" data-style="py-0">
                                        <option>Đã nhận</option>
                                        <option>Hoàn hàng</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Thuế đặt hàng</label>
                                    <select name="type" class="selectpicker form-control" data-style="py-0">
                                        <option>Số thuế</option>
                                        <option>GST @5%</option>
                                        <option>VAT @20%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Giảm giá</label>
                                    <input type="text" class="form-control" placeholder="Giảm giá">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vận chuyển</label>
                                    <input type="text" class="form-control" placeholder="Đang giao hàng">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thanh toán *</label>
                                    <input type="text" class="form-control" placeholder="Tiền mặt" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ghi chú *</label>
                                    <div id="quill-tool">
                                        <button class="ql-bold" data-toggle="tooltip" data-placement="bottom" title="Bold"></button>
                                        <button class="ql-underline" data-toggle="tooltip" data-placement="bottom" title="Underline"></button>
                                        <button class="ql-italic" data-toggle="tooltip" data-placement="bottom" title="Add italic text <cmd+i>"></button>
                                        <button class="ql-image" data-toggle="tooltip" data-placement="bottom" title="Upload image"></button>
                                        <button class="ql-code-block" data-toggle="tooltip" data-placement="bottom" title="Show code"></button>
                                    </div>
                                    <div id="quill-toolbar">
                                    </div>
                                </div>
                            </div>                                
                        </div>                            
                        <button type="submit" class="btn btn-primary mr-2">Thêm đơn hàng</button>
                        <button type="reset" class="btn btn-danger">Đặt lại</button>
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