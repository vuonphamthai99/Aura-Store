<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class category {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        // Hiển thị danh sách danh mục
        public function show_list_category()
        {
             $query = "SELECT * FROM Category order by idCategory asc";
            $result = $this->db->select($query);
            return $result;
        }
        
        // Hiển thị danh mục theo mã danh mục
        public function show_cat_byid($id)
        {
            $query = "SELECT * FROM Category WHERE idCategory = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        
        // Xóa danh mục
        public function del_category($id)
        {
            $query = "DELETE FROM Category WHERE idCategory = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='text-success mt-10 ml-3'>Xoá danh mục thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='text-danger mt-10 ml-3'>Xoá danh mục thất bại</span>";
                return $alert;
            }
        }

        // Thêm danh mục
        public function insert_category($data) 
        {
            // Kết nối dữ liệu với CSDL
            $CategoryName = mysqli_real_escape_string($this->db->link, $data['tenCate']);
            if($CategoryName=="") {
                $alert = "<span class='text-danger mt-10'>Các trường không được trống!!</span>";
                return $alert;
            
            }else {
                $query = "INSERT INTO Category(CategoryName) VALUES('$CategoryName')";
                $result = $this->db->insert($query);
                if($result) {
                    $alert = "<span class='text-success mt-10'>Thêm danh mục thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='text-danger mt-10'>Thêm danh mục thất bại</span>";
                    return $alert;
                }
            }
        }

        // Hiển thị danh mục theo mã danh mục
        public function get_Category_by_idCategory($idCategory)
        {
            $query = "SELECT * from Category WHERE idCategory = '$idCategory'";
            $result = $this->db->select($query);
            return $result;
        }

        // Cập nhật danh mục theo mã danh mục
        public function update_Category($data,$idCategory) 
        {
            // Kết nối dữ liệu với CSDL
            $CategoryName = mysqli_real_escape_string($this->db->link, $data['tenCate']);
            if($CategoryName=="") {
                $alert = "<span class='text-danger mt-10'>Các trường không được trống!!</span>";
                return $alert;
            }
            else {
                $query = "UPDATE Category set CategoryName = '$CategoryName' where idCategory = '$idCategory'";
                $result = $this->db->update($query);
                if($result) {
                    $alert = "<span class='text-success mt-10'>Cập nhật danh mục thành công</span>";
                    return $alert;
                }else {
                    $alert = "<span class='text-danger mt-10'>Cập nhật danh mục thất bại</span>";
                    return $alert;
                }
            }
        }

        // Tổng số lượng danh mục
        public function total_category()
        {
            $query = "SELECT COUNT(idCategory) AS total_category FROM Category"; 
            $result = $this->db->select($query);
            return $result;    
        }
    }
?>