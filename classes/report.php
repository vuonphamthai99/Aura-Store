<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class report {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function get_sale_day()
        {
            $sale_by_days = array();
            
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 1 day;";
            $get_sum_d1 = $this->db->select($query)->fetch_assoc();
            $sale_by_days[6] = $get_sum_d1['Sale'];
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 2 day and ReceiveDate < now() -  interval 1 day;";
            $get_sum_d2 = $this->db->select($query)->fetch_assoc();
            $sale_by_days[5] = $get_sum_d2['Sale'];
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 3 day and ReceiveDate < now() -  interval 2 day;";
            $get_sum_d3 = $this->db->select($query)->fetch_assoc();
            $sale_by_days[4] = $get_sum_d3['Sale'];
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 4 day and ReceiveDate < now() -  interval 3 day;";
            $get_sum_d4 = $this->db->select($query)->fetch_assoc();
            $sale_by_days[3] = $get_sum_d4['Sale'];
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 5 day and ReceiveDate < now() -  interval 4 day;";
            $get_sum_d5 = $this->db->select($query)->fetch_assoc();
            $sale_by_days[2] = $get_sum_d5['Sale'];
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 6 day and ReceiveDate < now() -  interval 5 day;";
            $get_sum_d6 = $this->db->select($query)->fetch_assoc();
            $sale_by_days[1] = $get_sum_d6['Sale'];
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 7 day and ReceiveDate < now() -  interval 6 day;";
            $get_sum_d7 = $this->db->select($query)->fetch_assoc();
            $sale_by_days[0] = $get_sum_d7['Sale'];
            
            return $sale_by_days;

        }
        public function get_sale_month(){
            $sale_by_month = array();
            $query = "select sum(TotalBill) AS Sale from Bill where  ReceiveDate > now() -  interval 7 day;";
            $get_sum_m1 = $this->db->select($query)->fetch_assoc();
            $sale_by_month[3] = $get_sum_m1['Sale'];
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 14 day and ReceiveDate < now() -  interval 7 day";
            $get_sum_m2 = $this->db->select($query)->fetch_assoc();
            $sale_by_month[2] = $get_sum_m2['Sale'];
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 21 day and ReceiveDate < now() -  interval 14 day;";
            $get_sum_m3 = $this->db->select($query)->fetch_assoc();
            $sale_by_month[1] = $get_sum_m3['Sale'];
            $query = "select sum(TotalBill) AS Sale from Bill where ReceiveDate > now() -  interval 28 day and ReceiveDate < now() -  interval 21 day;";
            $get_sum_m3 = $this->db->select($query)->fetch_assoc();
            $sale_by_month[0] = $get_sum_m3['Sale'];
            return $sale_by_month;
        }
        public function get_sale_all()
        {
            $query = "select sum(TotalBill) AS Sale from Bill where status=2;";
            $get_sum = $this->db->select($query)->fetch_assoc();
            $sale_all = $get_sum['Sale'];
            return $sale_all;

        }
        public function get_product_sold()
        {
            $query = "SELECT  sum(QuantityBuy) AS ProductSold FROM `BillInfo` INNER JOIN Bill ON BillInfo.idBill = Bill.idBill where Status = 2;";
            $get_sum = $this->db->select($query)->fetch_assoc();
            $pd_sold = $get_sum['ProductSold'];
            return $pd_sold;
        }
        
    }
?>