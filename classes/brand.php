<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class brand {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        // Hiển thị danh sách thương hiệu
        public function show_list_brand()
        {
             $query = "SELECT * FROM Brand order by idBrand asc";
            $result = $this->db->select($query);
            return $result;
        }
        
        // HIển thị thương hiệu theo mã thương hiệu
        public function show_brand_byid($id)
        {
            $query = "SELECT * FROM Brand WHERE idBrand = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        
        // Xóa thương hiệu theo mã thương hiệu
        public function del_brand($id)
        {
            $query = "DELETE FROM Brand WHERE idBrand = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='text-success mt-10 ml-3'>Xoá thương hiệu thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='text-danger mt-10 ml-3'>Xoá thương hiệu thất bại</span>";
                return $alert;
            }
        }

        // Thêm thương hiệu
        public function insert_brand($data) 
        {
            // Kết nối dữ liệu với CSDL
            $BrandName = mysqli_real_escape_string($this->db->link, $data['tenTH']);
            $BrandPhone	 = mysqli_real_escape_string($this->db->link, $data['sdt']);
            $BrandAddress = mysqli_real_escape_string($this->db->link, $data['dc']);
            if($BrandName=="" || $BrandPhone=="" || $BrandAddress=="") {
                $alert = "<span class='text-danger mt-10'>Các trường không được trống!!</span>";
                return $alert;
            }else if(strlen($BrandPhone) < '10' || strlen($BrandPhone) > '12'){
                $alert = "<span class='text-danger mt-10'>Số điện thoại phải từ 10 đến 12 số</span>";
                return $alert;
            }else {
                $query = "INSERT INTO Brand(BrandName,BrandPhone, BrandAddress) VALUES('$BrandName', '$BrandPhone', '$BrandAddress')";
                $result = $this->db->insert($query);
                if($result) {
                    $alert = "<span class='text-success mt-10'>Thêm thương hiệu thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='text-danger mt-10'>Thêm thương hiệu thất bại</span>";
                    return $alert;
                }
            }
        }

        // Hiển thị thương hiệu theo mã thương hiệu
        public function get_Brand_by_idBrand($idBrand)
        {
            $query = "SELECT * from Brand WHERE idBrand = '$idBrand'";
            $result = $this->db->select($query);
            return $result;
        }

        // Cập nhật thương hiệu theo mã thương hiệu
        public function update_brand($data,$idBrand) {
            // Kết nối dữ liệu với CSDL
            $BrandName = mysqli_real_escape_string($this->db->link, $data['tenTH']);
            $BrandPhone	 = mysqli_real_escape_string($this->db->link, $data['sdt']);
            $BrandAddress = mysqli_real_escape_string($this->db->link, $data['dc']);
            if($BrandName=="" || $BrandPhone=="" || $BrandAddress=="") {
                $alert = "<span class='text-danger mt-10'>Các trường không được trống!!</span>";
                return $alert;
            }else if(strlen($BrandPhone) < '10' || strlen($BrandPhone) > '12'){
                $alert = "<span class='text-danger mt-10'>Số điện thoại phải từ 10 đến 12 số</span>";
                return $alert;
            }else {
                $query = "UPDATE Brand set BrandName = '$BrandName' ,BrandPhone = $BrandPhone, BrandAddress = '$BrandAddress' where idBrand = '$idBrand'";
                $result = $this->db->update($query);
                if($result) {
                    $alert = "<span class='text-success mt-10'>Cập nhật thương hiệu thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='text-danger mt-10'>Cập nhật thương hiệu thất bại</span>";
                    return $alert;
                }
            }
        }

        // Tổng số lượng thương hiệu
        public function total_brand()
        {
            $query = "SELECT COUNT(idBrand) AS total_brand FROM Brand"; 
            $result = $this->db->select($query);
            return $result;    
        }
    }
?>