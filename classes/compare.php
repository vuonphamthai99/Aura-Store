<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php
    class compare {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function add_to_compare($idCustomer,$idProduct)
        {
            $query = "SELECT COUNT(idCustomer) AS NumIdCustomer FROM Compare where idCustomer = '$idCustomer';";
            $get_num_idCustomer = $this->db->select($query)->fetch_assoc();
            $num_idCustomer = $get_num_idCustomer['NumIdCustomer'];
            if($num_idCustomer >=  3){
                $alert = "<span class='text-danger mt-10'>So sánh tối đa 3 sản phẩm!</span>";
                return $alert;
            }
            else{
                $query = "SELECT idProduct FROM Compare where idCustomer = '$idCustomer' and idProduct = '$idProduct' LIMIT 1";
                $result = $this->db->select($query);
                if($result!= false){
                    $alert = "<span class='text-danger mt-10'>Sản phẩm đã có trong mục so sánh!</span>";
                    return $alert;
                }
                else{
                    $query = "INSERT INTO Compare(idProduct,idCustomer) VALUES('$idProduct','$idCustomer')";
                    $result = $this->db->insert($query);
                    if(!$result) {
                        $alert = "<span class='text-danger mt-10'>Thêm thất bại</span>";
                        return $alert;
                    }
                }
            }
        }
        public function show_compare_by_idCustomer($idCustomer){
            $query = "SELECT Product.* FROM Product INNER JOIN Compare on Product.idProduct = Compare.idProduct where Compare.idCustomer = '$idCustomer'ORDER BY Compare.idProduct DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function del_compare($idCustomer,$idProduct)
        {
            $query = "DELETE FROM Compare WHERE idCustomer ='$idCustomer' AND idProduct = '$idProduct'" ;
            $result = $this->db->delete($query);
        }
        public function del_compare_by_idcustomer($idCustomer)
        {
            $query = "DELETE FROM Compare WHERE idCustomer ='$idCustomer'" ;
            $result = $this->db->delete($query);
        }
        public function check_compare($idCustomer)
        {
            $query = "SELECT COUNT(idCustomer) AS Com_Num FROM `Compare` WHERE idCustomer = '$idCustomer'" ;
            $result = $this->db->select($query)->fetch_assoc();
            $Com_Num = $result['Com_Num'];
            return $Com_Num;
        }

    }
?>