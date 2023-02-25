<?php

use LDAP\Result;

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
    class wishlist {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        //Thêm sp vào ds yêu thích
        public function add_to_wishlist($idProduct,$idCustomer)
        {
            $query = "SELECT * FROM WishList where idCustomer = '$idCustomer' and idProduct = '$idProduct' LIMIT 1";
            $result = $this->db->select($query);
            if($result!= false){
                $alert = "<span class='text-danger mt-10'>Sản phẩm đã có trong danh sách yêu thích!</span>";
                return $alert;
            }
            else{
                $query = "INSERT INTO WishList(idProduct,idCustomer) VALUES('$idProduct','$idCustomer')";
                $result = $this->db->insert($query);
                if(!$result) {
                    $alert = "<span class='text-danger mt-10'>Thêm thất bại</span>";
                    return $alert;
                }
            }
        }

        //Hiển thị ds sp yêu thích theo mã KH
        public function show_wishlist_by_idCustomer($idCustomer){
            $query = "SELECT Product.*, Customer.idCustomer, WishList.idWish
                      FROM Product INNER JOIN WishList on Product.idProduct = WishList.idProduct
                      INNER JOIN Customer on WishList.idCustomer = Customer.idCustomer
                      where WishList.idCustomer = '$idCustomer'
                      ORDER BY WishList.idProduct DESC";
            
            $result = $this->db->select($query);
            return $result;
        }

        //Xóa sp trong ds yêu thích
        public function del_wishlist($id){
            $query = "DELETE FROM WishList WHERE idWish = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='text-success mt-10 ml-3'>Xoá yêu thích thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='text-danger mt-10 ml-3'>Xoá yêu thích thất bại</span>";
                return $alert;
            }
        }
        
        
        // public function add_wish_to_cart($QuantityBuy, $idProduct){
        //     $QuantityBuy = $this->fm->validation($QuantityBuy);
        //     $QuantityBuy = mysqli_real_escape_string($this->db->link, $QuantityBuy);
        //     $idProduct = mysqli_real_escape_string($this->db->link, $idProduct);
        //     $idCustomer = Session::get('customer_id');

        //     $query = "SELECT * FROM Product WHERE idProduct = '$idProduct'";
        //     $result = $this->db->select($query)->fetch_assoc();
            
        //     $SalePrice = $result['SalePrice'];
        //     $Price = $result['Price'];

        //     if($SalePrice == 0) $Total = $QuantityBuy * $Price;
        //     else $Total = $QuantityBuy * $SalePrice;

        //     $get_pd_cart = "SELECT * FROM Cart WHERE idCustomer = '$idCustomer' AND idProduct ='$idProduct'";
        //     $select_pd_cart = $this->db->select($get_pd_cart);

        //     if($select_pd_cart){
        //         $result_pd_cart = $select_pd_cart->fetch_assoc();
        //         $total_qty = $result_pd_cart['QuantityBuy'] + $QuantityBuy;
        //         if($SalePrice == 0) $Total_update = $total_qty * $Price;
        //         else $Total_update = $total_qty * $SalePrice;
                
        //         $query_update = "UPDATE Cart SET QuantityBuy = '$total_qty', Total = '$Total_update'
        //             WHERE idProduct = '$idProduct' AND idCustomer = '$idCustomer'";
                
        //         if($QuantityBuy > 10){
        //             $alert = "<span class='text-danger'>Chỉ có thể mua tối đa 10 sản phẩm/mỗi loại!</span>";
        //             return $alert;
        //         }else $update_cart = $this->db->update($query_update);

        //         if($update_cart) {
        //             $alert = "<span class='text-primary'>Sản Phẩm Đã Được Thêm Vào Giỏ Hàng</span>";
        //             return $alert;
        //         }else {
        //             header('location:404.php');
        //         }
        //     }else{
        //         if($SalePrice == 0){
        //             $query_insert = "INSERT INTO Cart(idProduct, idCustomer, Price, QuantityBuy, Total) 
        //             VALUES('$idProduct', '$idCustomer', '$Price', '$QuantityBuy', '$Total')";
        //         }else{
        //             $query_insert = "INSERT INTO Cart(idProduct, idCustomer, Price, QuantityBuy, Total) 
        //             VALUES('$idProduct', '$idCustomer', '$SalePrice', '$QuantityBuy', '$Total')";
        //         }

        //         if($QuantityBuy > 10){
        //             $alert = "<span class='text-danger'>Chỉ có thể mua tối đa 10 sản phẩm/mỗi loại!</span>";
        //             return $alert;
        //         }else $insert_cart = $this->db->insert($query_insert);
                
        //         if($insert_cart) {
        //             $alert = "<span class='text-primary'>Sản Phẩm Đã Được Thêm Vào Giỏ Hàng</span>";
        //             return $alert;
        //         }else {
        //             header('location:404.php');
        //         }
        //     }
        // }
        
        // Kiểm tra sp trong ds yêu thích
        public function check_Wish($idCustomer)
        {
            $query = "SELECT COUNT(idCustomer) AS Com_Num FROM `WishList` WHERE idCustomer = '$idCustomer'" ;
            $result = $this->db->select($query)->fetch_assoc();
            $Com_Num = $result['Com_Num'];
            return $Com_Num;
        }

        // Tổng số lượng yêu thích của 1 sp
        public function total_wish_product($idProduct)
        {
            $query = "SELECT COUNT(idWish) AS total_wish FROM WishList WHERE idProduct = '$idProduct'"; 
            $result = $this->db->select($query);
            return $result;    
        }
    }


?>