<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class address {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_address($data) {
            // Kết nối dữ liệu với CSDL
            $Address = mysqli_real_escape_string($this->db->link, $data['Address']);
            $idCustomer = Session::get('customer_id');
            $CustomerName = mysqli_real_escape_string($this->db->link, $data['CustomerName']);
            $PhoneNumber = mysqli_real_escape_string($this->db->link, $data['PhoneNumber']);
            if($Address=="" || $CustomerName=="" || $PhoneNumber=="") {
                $alert = "<span class='text-danger mt-10'>Các trường không được trống!!</span>";
                return $alert;
            }else if(strlen($PhoneNumber) < '10' || strlen($PhoneNumber) > '12'){
                $alert = "<span class='text-danger mt-10'>Số điện thoại phải từ 10 đến 12 số</span>";
                return $alert;
            }else {
                $query = "INSERT INTO AddressCustomer(Address,idCustomer, CustomerName, PhoneNumber) VALUES('$Address', '$idCustomer', '$CustomerName', '$PhoneNumber')";
                $result = $this->db->insert($query);
                if($result) {
                    $alert = "<span class='text-success mt-10'>Thêm địa chỉ thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='text-danger mt-10'>Thêm địa chỉ thất bại</span>";
                    return $alert;
                }
            }
        }
        public function show_address(){
            $idCustomer = Session::get('customer_id');
            $query = "SELECT AddressCustomer.*
                      FROM AddressCustomer
                      WHERE idCustomer = '$idCustomer' ORDER BY AddressCustomer.idAddress DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_address($data, $id){
            $Address = mysqli_real_escape_string($this->db->link, $data['Address']);
            $CustomerName = mysqli_real_escape_string($this->db->link, $data['CustomerName']);
            $PhoneNumber = mysqli_real_escape_string($this->db->link, $data['PhoneNumber']);
            if($Address=="" || $CustomerName=="" || $PhoneNumber=="") {
                $alert = "<span class='text-danger mt-10'>Các trường không được trống!!</span>";
                return $alert;
            }else if(strlen($PhoneNumber) < '10' || strlen($PhoneNumber) > '12'){
                $alert = "<span class='text-danger mt-10'>Số điện thoại phải từ 10 đến 12 số</span>";
                return $alert;
            }else{
                $query = "UPDATE AddressCustomer SET
                Address = '$Address',
                CustomerName = '$CustomerName',
                PhoneNumber = '$PhoneNumber'
                WHERE idAddress='$id'";  
            }
            $result = $this->db->update($query);
            if($result) {
                $alert = "<span class='text-success mt-10'>Cập nhật địa chỉ thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger mt-10'>Cập nhật địa chỉ thất bại</span>";
                return $alert;
            }
        }
        public function del_address($id){
            $query = "DELETE FROM AddressCustomer WHERE idAddress = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='text-success mt-10'>Xoá địa chỉ thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='text-danger mt-10'>Xóa địa chỉ thất bại</span>";
                return $alert;
            }
        }

        public function getaddressbyidAddress($idAddress){
            $query = "SELECT AddressCustomer.*, Customer.Avatar, Customer.username FROM AddressCustomer INNER JOIN Customer ON AddressCustomer.idCustomer = Customer.idCustomer WHERE idAddress = '$idAddress'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>