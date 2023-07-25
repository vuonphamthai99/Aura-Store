<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class cart {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        //Mua Ngay
        public function add_to_cart_buy($QuantityBuy, $idProduct){
            $QuantityBuy = $this->fm->validation($QuantityBuy);
            $QuantityBuy = mysqli_real_escape_string($this->db->link, $QuantityBuy);
            $idProduct = mysqli_real_escape_string($this->db->link, $idProduct);
            $idCustomer = Session::get('customer_id');

            $query = "SELECT * FROM Product WHERE idProduct = '$idProduct'";
            $result = $this->db->select($query)->fetch_assoc();

            $now = date('Y-m-d H:i:s');
            $query_discount = "SELECT Discount FROM SaleProduct WHERE idProduct = '$idProduct' AND SaleStart < '$now' AND SaleEnd > '$now'"; 
            $result_discount = $this->db->select($query_discount);

            if($result_discount) $get_discount = $result_discount->fetch_assoc();

            $Price = $result['Price'];
            if($get_discount['Discount']) $SalePrice = $Price - ($Price/100)*$get_discount['Discount'];
            else $SalePrice = $Price;

            $round_SalePrice = round($SalePrice,-3);
            $Total = $QuantityBuy * $round_SalePrice;

            $get_pd_cart = "SELECT * FROM Cart WHERE idCustomer = '$idCustomer' AND idProduct ='$idProduct'";
            $select_pd_cart = $this->db->select($get_pd_cart);

            if($select_pd_cart){
                $result_pd_cart = $select_pd_cart->fetch_assoc();
                $total_qty = $result_pd_cart['QuantityBuy'] + $QuantityBuy;
                $Total_update = $total_qty * $round_SalePrice;
                
                $query_update = "UPDATE Cart SET QuantityBuy = '$total_qty', Total = '$Total_update'
                    WHERE idProduct = '$idProduct' AND idCustomer = '$idCustomer'";

                if($QuantityBuy > 10){
                    $alert = "<span class='text-danger'>Chỉ có thể mua tối đa 10 sản phẩm/mỗi loại!</span>";
                    return $alert;
                }else $update_cart = $this->db->update($query_update);
                if($update_cart) {
                    header('location:cart.php');
                }else {
                    header('location:404.php');
                }
            }else{
                $query_insert = "INSERT INTO Cart(idProduct, idCustomer, Price, QuantityBuy, Total) 
                VALUES('$idProduct', '$idCustomer', '$round_SalePrice', '$QuantityBuy', '$Total')";

                if($QuantityBuy > 10){
                    $alert = "<span class='text-danger'>Chỉ có thể mua tối đa 10 sản phẩm/mỗi loại!</span>";
                    return $alert;
                }else $insert_cart = $this->db->insert($query_insert);

                if($insert_cart) {
                    header('location:cart.php');
                }else {
                    header('location:404.php');
                }
            }
        }

        //Thêm vào giỏ hàng
        public function add_to_cart_add($QuantityBuy, $idProduct){
            $QuantityBuy = $this->fm->validation($QuantityBuy);
            $QuantityBuy = mysqli_real_escape_string($this->db->link, $QuantityBuy);
            $idProduct = mysqli_real_escape_string($this->db->link, $idProduct);
            $idCustomer = Session::get('customer_id');

            $query = "SELECT * FROM Product WHERE idProduct = '$idProduct'";
            $result = $this->db->select($query)->fetch_assoc();

            $now = date('Y-m-d H:i:s');
            $query_discount = "SELECT Discount FROM SaleProduct WHERE idProduct = '$idProduct' AND SaleStart < '$now' AND SaleEnd > '$now'"; 
            $result_discount = $this->db->select($query_discount);

            $get_discount = ($result_discount) ? $result_discount->fetch_assoc() : null;

            $Price = $result['Price'];
            if ($get_discount && $get_discount['Discount'] > 0) {
                $SalePrice = $Price - ($Price / 100) * $get_discount['Discount'];
            } else {
                $SalePrice = $Price;
            }

            $round_SalePrice = round($SalePrice, -3);

            $Total = $QuantityBuy * $round_SalePrice;


            $get_pd_cart = "SELECT * FROM Cart WHERE idCustomer = '$idCustomer' AND idProduct ='$idProduct'";
            $select_pd_cart = $this->db->select($get_pd_cart);

            if($select_pd_cart){
                $result_pd_cart = $select_pd_cart->fetch_assoc();
                $total_qty = $result_pd_cart['QuantityBuy'] + $QuantityBuy;
                $Total_update = $total_qty * $round_SalePrice;
                
                $query_update = "UPDATE Cart SET QuantityBuy = '$total_qty', Total = '$Total_update'
                    WHERE idProduct = '$idProduct' AND idCustomer = '$idCustomer'";
                
                if($QuantityBuy > 10){
                    $alert = "<span class='text-danger'>Chỉ có thể mua tối đa 10 sản phẩm/mỗi loại!</span>";
                    return $alert;
                }else $update_cart = $this->db->update($query_update);

                if($update_cart) {
                    $alert = "<span class='text-primary'>Sản Phẩm Đã Được Thêm Vào Giỏ Hàng</span>";
                    return $alert;
                }else {
                    header('location:404.php');
                }
            }else{
                $query_insert = "INSERT INTO Cart(idProduct, idCustomer, Price, QuantityBuy, Total) 
                VALUES('$idProduct', '$idCustomer', '$round_SalePrice', '$QuantityBuy', '$Total')";

                if($QuantityBuy > 10){
                    $alert = "<span class='text-danger'>Chỉ có thể mua tối đa 10 sản phẩm/mỗi loại!</span>";
                    return $alert;
                }else $insert_cart = $this->db->insert($query_insert);
                
                if($insert_cart) {
                    $alert = "<span class='text-primary'>Sản Phẩm Đã Được Thêm Vào Giỏ Hàng</span>";
                    return $alert;
                }else {
                    header('location:404.php');
                }
            }
        }

        //Lấy sản phẩm trong giỏ hàng
        public function get_product_cart(){
            $idCustomer = Session::get('customer_id');
            $query = "SELECT Cart.*, Product.ProductName, Product.Quantity FROM Cart INNER JOIN Product ON Cart.idProduct = Product.idProduct WHERE idCustomer = '$idCustomer'";
            $result = $this->db->select($query);
            return $result;
        }

        //Lấy số lượng sản phẩm trong giỏ hàng theo mã khách hàng
        public function get_qty_pd_cart(){
            $idCustomer = Session::get('customer_id');
            $query = "SELECT sum(QuantityBuy) AS qty_buy FROM Cart WHERE idCustomer = '$idCustomer'";
            $result = $this->db->select($query);
            return $result;
        }

        // // Cập nhật giỏ hàng
        // public function update_cart($data = array(), $idCustomer){

        //     foreach($data['QuantityBuy'] as $key => $val){
        //         $QuantityBuy[$key] = $val;
        //         $query = "UPDATE Cart SET
        //             QuantityBuy = '$QuantityBuy[$key]',
        //             Total = Price*'$QuantityBuy[$key]'
        //             WHERE idProduct = '$key' AND idCustomer = '$idCustomer'";

        //         if($QuantityBuy[$key] > 10){
        //             $alert = "<span class='text-danger'>Chỉ có thể mua tối đa 10 sản phẩm/mỗi loại!</span>";
        //             return $alert;
        //         }else $result = $this->db->update($query);
        //     }
        // }

        // Cập nhật 1 sản phẩm trong giỏ hàng
        public function update_quantity_cart($data = array())
        {
            foreach($data['QuantityBuy'] as $key => $val){
                $QuantityBuy[$key] = $val;
                $query = "UPDATE Cart SET
                    QuantityBuy = '$QuantityBuy[$key]',
                    Total = Price*'$QuantityBuy[$key]'
                    WHERE idCart = '$key'";

                if($QuantityBuy[$key] > 10){
                    $alert = "<span class='text-danger'>Chỉ có thể mua tối đa 10 sản phẩm/mỗi loại!</span>";
                    return $alert;
                }else $result = $this->db->update($query);
            }
        }

        //Xóa sản phẩm theo mã giỏ hàng
        public function del_product_cart($cartid){
            $idCustomer = Session::get('customer_id');
            $cartid = mysqli_real_escape_string($this->db->link, $cartid);
            $query = "DELETE FROM Cart WHERE idCart = '$cartid' AND idCustomer='$idCustomer'";
            $result = $this->db->delete($query);
        }

        //Xóa tất cả sản phẩm trong giỏ hàng
        public function del_all_data_cart($idCustomer){
			$query = "DELETE FROM Cart WHERE idCustomer='$idCustomer'";
			$result = $this->db->delete($query);
			return $result;
		}

        public function check_cart(){
            $idCustomer = Session::get('customer_id');
            $sId = session_id();
            $query = "SELECT * FROM Cart WHERE idCustomer='$idCustomer'";
            $result = $this->db->select($query);
            return $result;
        }

        //Thêm đơn hàng
        public function insertOrder($data, $customer_id) {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $OrderDate = date("Y-m-d H:i:s");
            
            $idAddress = mysqli_real_escape_string($this->db->link, $data['address_rdo']);
            $checkout = mysqli_real_escape_string($this->db->link, $data['checkout']);
            $query_sum = "SELECT sum(Total) AS TotalBill FROM Cart WHERE idCustomer = '$customer_id'";
            $get_sum = $this->db->select($query_sum)->fetch_assoc();
            
            $query_cart = "SELECT * FROM Cart WHERE idCustomer = '$customer_id'";
            $get_cart = $this->db->select($query_cart);
            if($get_cart){
                $Total = $get_sum['TotalBill'];
                if($Total < '1000000') $TotalBill = $Total + '30000';
                else $TotalBill = $Total;
                $query_order = "INSERT INTO Bill(idCustomer, OrderDate, TotalBill, idAddress,Payment) VALUES ('$customer_id', '$OrderDate', '$TotalBill', '$idAddress','$checkout')";
                $insert_bill = $this->db->insert($query_order);

                $id_bill = "SELECT idBill FROM Bill WHERE idCustomer = '$customer_id' AND OrderDate = '$OrderDate'";
                $get_id_bill = $this->db->select($id_bill)->fetch_assoc();
                while($result = $get_cart->fetch_assoc()){
                    $idBill = $get_id_bill['idBill'];
                    $idProduct = $result['idProduct'];
                    $Price = $result['Price'];
                    $QuantityBuy = $result['QuantityBuy'];
                    
                    $query_billinfo = "INSERT INTO BillInfo(idBill, idProduct, Price, QuantityBuy) VALUES ('$idBill', '$idProduct', '$Price', '$QuantityBuy')";
                    $insert_billinfo = $this->db->insert($query_billinfo);

                    $query_update_qty_pd = "UPDATE Product SET Quantity = Quantity - '$QuantityBuy' WHERE idProduct = '$idProduct'";
                    $result_update_qty_pd = $this->db->update($query_update_qty_pd);
                }

                if($insert_billinfo){
                    header('location:success-order.php');
                }else{
                    $alert = "<span class='text-danger'>Đặt hàng không thành công!</span>";
                    return $alert;
                }
            }

        }

        //Lấy ra danh sách đơn đặt hàng theo mã khách hàng
        public function get_cart_ordered($customer_id){
            $query = "SELECT DISTINCT Bill.*, AddressCustomer.* FROM Bill 
                INNER JOIN AddressCustomer ON Bill.idAddress = AddressCustomer.idAddress
                WHERE Bill.idCustomer = '$customer_id'
                ORDER BY OrderDate desc";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }
        
        //Lấy ra danh sách đơn đặt hàng đang chờ xác nhận theo mã khách hàng
        public function get_cart_waiting_ordered($customer_id){
            $query = "SELECT DISTINCT Bill.*, AddressCustomer.* FROM Bill 
                INNER JOIN AddressCustomer ON Bill.idAddress = AddressCustomer.idAddress
                WHERE Bill.idCustomer = '$customer_id' AND Status = 0
                ORDER BY OrderDate desc";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }

        //Lấy ra danh sách đơn đặt hàng đang giao theo mã khách hàng
        public function get_cart_shipping_ordered($customer_id){
            $query = "SELECT DISTINCT Bill.*, AddressCustomer.* FROM Bill 
                INNER JOIN AddressCustomer ON Bill.idAddress = AddressCustomer.idAddress
                WHERE Bill.idCustomer = '$customer_id' AND Status = 1
                ORDER BY OrderDate desc";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }

        //Lấy ra danh sách đơn đặt hàng đã giao theo mã khách hàng
        public function get_cart_shipped_ordered($customer_id){
            $query = "SELECT DISTINCT Bill.*, AddressCustomer.* FROM Bill 
                INNER JOIN AddressCustomer ON Bill.idAddress = AddressCustomer.idAddress
                WHERE Bill.idCustomer = '$customer_id' AND Status = 2
                ORDER BY OrderDate desc";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }

        //Lấy ra danh sách đơn đặt hàng đã hủy theo mã khách hàng
        public function get_cart_cancelled_ordered($customer_id){
            $query = "SELECT DISTINCT Bill.*, AddressCustomer.* FROM Bill 
                INNER JOIN AddressCustomer ON Bill.idAddress = AddressCustomer.idAddress
                WHERE Bill.idCustomer = '$customer_id' AND Status = 99
                ORDER BY OrderDate desc";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }
        
        // Lấy tất cả đơn đặt hàng của khách hàng
        public function get_cart_ordered_all(){
            $query = "SELECT Bill.*, Customer.*, Admin.AdminName FROM Bill 
                INNER JOIN Customer ON Bill.idCustomer = Customer.idCustomer
                INNER JOIN Admin ON Bill.idAdmin = Admin.idAdmin
                ORDER BY OrderDate desc";
            $get_cart_ordered_all = $this->db->select($query);
            return $get_cart_ordered_all;
        }

        // Lấy tất cả đơn đặt hàng đang chờ xác nhận của khách hàng
        public function get_cart_waiting_ordered_all(){
            $query = "SELECT Bill.*, Customer.*, Admin.AdminName FROM Bill 
                INNER JOIN Customer ON Bill.idCustomer = Customer.idCustomer
                INNER JOIN Admin ON Bill.idAdmin = Admin.idAdmin
                WHERE Status = 0
                ORDER BY OrderDate desc";
            $get_cart_ordered_all = $this->db->select($query);
            return $get_cart_ordered_all;
        }

        // Lấy tất cả đơn đặt hàng đang giao của khách hàng
        public function get_cart_shipping_ordered_all(){
            $query = "SELECT Bill.*, Customer.*, Admin.AdminName FROM Bill 
                INNER JOIN Customer ON Bill.idCustomer = Customer.idCustomer
                INNER JOIN Admin ON Bill.idAdmin = Admin.idAdmin
                WHERE Status = 1
                ORDER BY OrderDate desc";
            $get_cart_ordered_all = $this->db->select($query);
            return $get_cart_ordered_all;
        }

        // Lấy tất cả đơn đặt hàng đã giao của khách hàng
        public function get_cart_shipped_ordered_all(){
            $query = "SELECT Bill.*, Customer.*, Admin.AdminName FROM Bill 
                INNER JOIN Customer ON Bill.idCustomer = Customer.idCustomer
                INNER JOIN Admin ON Bill.idAdmin = Admin.idAdmin
                WHERE Status = 2
                ORDER BY OrderDate desc";
            $get_cart_ordered_all = $this->db->select($query);
            return $get_cart_ordered_all;
        }

        // Lấy tất cả đơn đặt hàng đã hủy của khách hàng
        public function get_cart_cancelled_ordered_all(){
            $query = "SELECT Bill.*, Customer.*, Admin.AdminName FROM Bill 
                INNER JOIN Customer ON Bill.idCustomer = Customer.idCustomer
                INNER JOIN Admin ON Bill.idAdmin = Admin.idAdmin
                WHERE Status = 99
                ORDER BY OrderDate desc";
            $get_cart_ordered_all = $this->db->select($query);
            return $get_cart_ordered_all;
        }

        //Lấy ra chi tiết đơn hàng của 1 đơn hàng theo mã khách hàng
        public function get_billinfo_cus($idBill){
            $query ="SELECT Bill.*, BillInfo.*, Product.*, BillInfo.Price AS Pricee FROM Bill
                INNER JOIN BillInfo ON Bill.idBill = BillInfo.idBill
                INNER JOIN Product ON BillInfo.idProduct = Product.idProduct
                WHERE Bill.idBill = '$idBill'";
            $get_billinfo_cus = $this->db->select($query);
            return $get_billinfo_cus;
        }

        //Lấy ra địa chỉ giao hàng của đơn hàng
        public function get_address_billinfo($idBill, $idCustomer){
            $query = "SELECT Bill.*, AddressCustomer.* FROM Bill 
                INNER JOIN AddressCustomer ON Bill.idAddress = AddressCustomer.idAddress
                WHERE Bill.idCustomer = '$idCustomer' AND Bill.idBill = '$idBill'
                ORDER BY OrderDate desc";
            $get_address_billinfo = $this->db->select($query);
            return $get_address_billinfo;
        }
    }
?>