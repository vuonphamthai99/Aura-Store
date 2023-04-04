<?php
    ob_start();
    include 'lib/session.php';
    Session::init();
    if(isset($_POST['product_id'])){
        $idpdcmp = $_POST['product_id'];
        }else {
            $idpdcmp ='Không có gì cả';
        }
?>
<?php
    include_once 'lib/database.php';
    include_once 'helpers/format.php';
    spl_autoload_register(function($className){
        include_once "classes/".$className.".php";
    });
    $db = new Database();
    $fm = new Format();
    $cs = new customer();
    $ad = new address();
    $admin = new admin();
    $brand = new brand();
    $category = new category();
    $pd = new product();
    $wishlist = new wishlist();
    $ct = new cart();
    $sale = new sale();
    $report = new report();
    $compare = new compare();
    $blog = new blog();

?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
  date_default_timezone_set("Asia/Ho_Chi_Minh");
?>

                <?php
                    $pdlist = $pd->show_product_related($idpdcmp);
                    if($pdlist) {
                        while($result = $pdlist->fetch_assoc()) {
                ?>
                <div class="product-item col-md-3 select-pd" id="product-item-<?php echo $result['idProduct'];?>" data-id="<?php echo $result['idProduct'];?>">
                    <div class="product-image mb-3" id="product-image-<?php echo $result['idProduct'];?>">
                        <?php
                            $id = $result['idProduct'];
                            $imglist = $pd->show_image_pd($id);
                            if($imglist) {
                                while($result_image = $imglist->fetch_assoc()) {
                                    $img_pd = $result_image['ImageName'];
                        ?>
                        <label for="chk-pd-<?php echo $id;?>"><img src="../Aura-Store/AuraDash/assets/images/product/<?php echo $result_image['ImageName']?>" class="rounded w-100 img-fluid"/></label>
                        <?php
                                }
                            }
                        ?>

                        <div class="product-title">
                            <div class="product-name" style="height:30px ;overflow:hidden;display:-webkit-box;">
                                <input type="checkbox" class="checkstatus d-none" id="chk-pd-<?php echo $result['idProduct'];?>" name="chk_product[]" value="<?php echo $result['idProduct'];?>" data-id="<?php echo $result['idProduct'];?>" data-name="<?php echo $result['ProductName']?>" data-price="<?php echo $result['Price']?>" data-img="<?php echo $img_pd;?>">
                                <span><?php echo $result['ProductName']?></span>
                            </div>
                            <div style="text-align:center;"><?php  echo $fm->adddotstring($result['Price']);?>đ</div>
                        </div>
                    </div>
                    <input type="hidden" name="selected_product[]" id="product-<?php echo $result['idProduct'];?>" value="" />
                </div>
                <?php
                        }
                    }
                ?>

<script>
    var list = [];
    $(document).ready(function(){
        $("#confirm").css("pointer-events","none");
        $("#confirm").css("background-color","#6c757d");
        var product_id = <?php echo $idpdcmp ?>;
        list[0] = product_id;
        
    });
    $("input[type=checkbox]").on("click", function() {
        var product_id = $(this).data("id");
        var product_name = $(this).data("name");
        var product_price = $(this).data("price");
        var product_img = $(this).data("img");
        var numberOfChecked = $('input:checkbox:checked').length;

        if(numberOfChecked>2){
            showWarningModal();
            $(this).prop('checked', false);

        }else{
            if($(this).is(":checked")){
            $("#product-image-"+product_id).css("border","#ff7a6a 3px solid");
            $("#product-image-"+product_id).css("border-radius","10px");
            $("#product-"+product_id).val(product_id);
            list.push(product_id);
            $(document).ready(function(){
                $("#confirm").css("pointer-events","auto");
                $("#confirm").css("background-color","#0d6efd");
                $("#confirm").click(function(){
                    if(list.length == 3){
                        var idpd1 = list[0];
                        var idpd2 = list[1];
                        var idpd3 = list[2];
                        window.location.href="compare.php?idProduct1="+idpd1+"&idProduct2="+idpd2+"&idProduct3="+idpd3;
                    }else if(list.length == 2){
                        var idpd1 = list[0];
                        var idpd2 = list[1];
                        window.location.href="compare.php?idProduct1="+idpd1+"&idProduct2="+idpd2;
                    }
                    ;
                    
                })
            })
        }
        else if($(this).is(":not(:checked)")){
            $("#product-image-"+product_id).css("border","none");
            $("#product-"+product_id).val("	");
            list.splice(list.indexOf(product_id), 1);
            $(document).ready(function(){
                var $fields = $(this).find('input[name="chk_product[]"]:checked');
            if (!$fields.length) {
                $("#confirm").css("pointer-events","none");
                $("#confirm").css("background-color","#6c757d");
            }
            })
        }
        }
        
    });</script>
