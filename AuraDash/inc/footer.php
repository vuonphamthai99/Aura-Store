
<footer class="iq-footer">
    <div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="../backend/privacy-policy.php">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="../backend/terms-of-service.php">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">AURA Dash</a>.
                </div>
            </div>
        </div>
    </div>
</div>
</footer>
<!-- MoMo confirm Modal -->
<div class="modal fade" id="momoconfirm" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông báo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Khách hàng đã thanh toán bằng MoMo, Hãy kiểm tra thanh toán trước khi xác nhận</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Hủy</button>
        <button type="button" id="confirmMomoOrder" class="btn btn-primary btn-round" data-dismiss="modal">Xác nhận</button>
      </div>
    </div>
  </div>
</div>
<!-- MoMo confirm Modal End-->
<!-- ZaloPay confirm Modal -->
<div class="modal fade" id="zaloconfirm" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông báo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Khách hàng đã thanh toán bằng ZaloPay, Hãy kiểm tra thanh toán trước khi xác nhận</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Hủy</button>
        <button type="button" id="confirmZaloOrder" class="btn btn-primary btn-round" data-dismiss="modal">Xác nhận</button>
      </div>
    </div>
  </div>
</div>
<!-- MoMo confirm Modal End-->
<script>
    $('.momo').click(function(){
        var idBill = $(this).attr("value");
        $("#momoconfirm").modal('toggle');
        $("#confirmMomoOrder").prop('value', idBill);
    });
    $('.zalo').click(function(){
        var idBill = $(this).attr("value");
        $("#zaloconfirm").modal('toggle');
        $("#confirmZaloOrder").prop('value', idBill);
    });
    function confirmMomoOrder(){

    }
    $('#confirmMomoOrder').click(function(){
        var idBill = $(this).attr("value");
        $(document).ready(function(){
        window.location.href="page-list-purchase.php?conf_idBill="+idBill;
        
        });
    });
    $('#confirmZaloOrder').click(function(){
        var idBill = $(this).attr("value");
        $(document).ready(function(){
        window.location.href="page-list-purchase.php?conf_idBill="+idBill;
        
        });
    });

</script>
<link rel="stylesheet" type="text/css" href="../assets/datetimepicker-master/jquery.datetimepicker.css">
<script src="../assets/datetimepicker-master/jquery.js"></script>
<script src="../assets/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
<script src="../assets/js/moment.js"></script>

<!-- Backend Bundle JavaScript -->
<script src="../assets/js/backend-bundle.min.js"></script>

<!-- Table Treeview JavaScript -->
<script src="../assets/js/table-treeview.js"></script>

<!-- Chart Custom JavaScript -->
<script src="../assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="../assets/js/chart-custom.js"></script>

<!-- app JavaScript -->
<script src="../assets/js/app.js"></script>
ob_flush();
</body>
</html>

