<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class sale {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        //Hủy đơn hàng
        public function del_Bill($idBill, $idCustomer){
            $query_qty_pd = "SELECT * FROM BillInfo
                            INNER JOIN Bill ON Bill.idBill = BillInfo.idBill
                            WHERE Bill.idBill = '$idBill' AND Bill.idCustomer = '$idCustomer'";
            $select_qty_pd = $this->db->select($query_qty_pd);
            
            if($select_qty_pd){
                while($result_qty_pd = $select_qty_pd->fetch_assoc()){
                    $idProduct = $result_qty_pd['idProduct'];
                    $QuantityBuy = $result_qty_pd['QuantityBuy'];
                    
                    $query_update_qty_pd = "UPDATE Product SET Quantity = Quantity + '$QuantityBuy'
                                            WHERE idProduct = '$idProduct'";
                    $update_qty_pd = $this->db->update($query_update_qty_pd);
                }
                $query = "UPDATE Bill SET Status = '99' WHERE idBill='$idBill' AND idCustomer = '$idCustomer'";
                $result = $this->db->update($query);
            }

            if($result) {
                $alert = "<span class='text-success ml-3'>Hủy đơn hàng thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger ml-3'>Hủy đơn hàng thất bại</span>";
                return $alert;
            }
        }

        //Xác nhận đơn hàng
        public function conf_Bill($idBill){
            $idAdmin = Session::get('idAdmin');
                $query = "UPDATE Bill SET
                Status = '1',
                idAdmin = '$idAdmin'
                WHERE idBill='$idBill'";
            $result = $this->db->update($query);
            if($result) {
                $alert = "<span class='text-success ml-3'>Xác nhận đơn hàng thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger ml-3'>Xác nhận đơn hàng thất bại</span>";
                return $alert;
            }
        }

        //Xác nhận đơn hàng đã hoàn thành (Admin page)
        public function conf_success_Bill($idBill){
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $ReceiveDate = date("Y-m-d H:i:s");

                $query = "UPDATE Bill SET
                Status = '2',
                ReceiveDate = '$ReceiveDate'
                WHERE idBill='$idBill'";
            $result = $this->db->update($query);

            $query_qty_pd = "SELECT * FROM BillInfo
                            INNER JOIN Bill ON Bill.idBill = BillInfo.idBill
                            WHERE Bill.idBill = '$idBill'";
            $select_qty_pd = $this->db->select($query_qty_pd);
            
            if($select_qty_pd && $result){
                while($result_qty_pd = $select_qty_pd->fetch_assoc()){
                    $idProduct = $result_qty_pd['idProduct'];
                    $QuantityBuy = $result_qty_pd['QuantityBuy'];
                    
                    $query_update_sold_pd = "UPDATE Product SET Sold = Sold + '$QuantityBuy'
                                            WHERE idProduct = '$idProduct'";
                    $update_sold_pd = $this->db->update($query_update_sold_pd);
                }
            }

            if($result) {
                $alert = "<span class='text-success ml-3'>Xác nhận đơn hàng thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger ml-3'>Xác nhận đơn hàng thất bại</span>";
                return $alert;
            }
        }

        //Xác nhận đã nhận hàng (KH page)
        public function conf_receive_Bill($idBill){
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $ReceiveDate = date("Y-m-d H:i:s");
            
            $query = "UPDATE Bill SET 
                    Status = '2',
                    ReceiveDate = '$ReceiveDate'
                    WHERE idBill='$idBill'";
            $result = $this->db->update($query);
            
            $query_qty_pd = "SELECT * FROM BillInfo
                            INNER JOIN Bill ON Bill.idBill = BillInfo.idBill
                            WHERE Bill.idBill = '$idBill'";
            $select_qty_pd = $this->db->select($query_qty_pd);
            
            if($select_qty_pd && $result){
                while($result_qty_pd = $select_qty_pd->fetch_assoc()){
                    $idProduct = $result_qty_pd['idProduct'];
                    $QuantityBuy = $result_qty_pd['QuantityBuy'];
                    
                    $query_update_sold_pd = "UPDATE Product SET Sold = Sold + '$QuantityBuy'
                                            WHERE idProduct = '$idProduct'";
                    $update_sold_pd = $this->db->update($query_update_sold_pd);
                }
            }
        }

        // Tổng số lượng đơn hàng
        public function total_bill()
        {
            $query = "SELECT COUNT(idBill) AS total_bill FROM Bill"; 
            $result = $this->db->select($query);
            return $result;    
        }

        // Tổng số lượng đơn hàng chờ xác nhận
        public function total_waiting_bill()
        {
            $query = "SELECT COUNT(idBill) AS total_bill FROM Bill WHERE Status = 0"; 
            $result = $this->db->select($query);
            return $result;    
        }

        // Tổng số lượng đơn hàng đang giao
        public function total_shipping_bill()
        {
            $query = "SELECT COUNT(idBill) AS total_bill FROM Bill WHERE Status = 1"; 
            $result = $this->db->select($query);
            return $result;    
        }

        // Tổng số lượng đơn hàng đã giao
        public function total_shipped_bill()
        {
            $query = "SELECT COUNT(idBill) AS total_bill FROM Bill WHERE Status = 2"; 
            $result = $this->db->select($query);
            return $result;    
        }

        // Tổng số lượng đơn hàng đã hủy
        public function total_cancelled_bill()
        {
            $query = "SELECT COUNT(idBill) AS total_bill FROM Bill WHERE Status = 99"; 
            $result = $this->db->select($query);
            return $result;    
        }
    }
?>