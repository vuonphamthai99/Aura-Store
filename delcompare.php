


<?php
    ob_start();
    include 'lib/session.php';
    Session::init();
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:login.php');
    }else{
        $idCustomer = Session::get('customer_id');
    }
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
    
    if(isset($_POST['value'])){

        if($_POST['value']=='unload'){
    
            $delCompare = $compare->del_compare_by_idcustomer($idCustomer);

        }
    }
?>

