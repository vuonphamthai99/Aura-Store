<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class admin {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        //Đăng nhập tài khoản admin
        public function login_admin($AdminUser, $AdminPass) 
        {
            // Kiểm tra dữ liệu nhập vào có hợp lệ không
            $AdminUser = $this->fm->validation($AdminUser);
            $AdminPass = $this->fm->validation($AdminPass);
            // Kết nối dữ liệu với CSDL
            $AdminUser = mysqli_real_escape_string($this->db->link, $AdminUser);
            $AdminPass = mysqli_real_escape_string($this->db->link, $AdminPass);
            //
            if(empty($AdminUser) || empty($AdminPass)) {
                $alert = "<span class='text-danger mt-1'>Tài khoản và mật khẩu không được trống!!</span>";
                return $alert;
            }else {
                $query = "SELECT * FROM Admin WHERE AdminUser = '$AdminUser' AND AdminPass ='$AdminPass' LIMIT 1";
                $result = $this->db->select($query);
                if($result != false) {
                    $value = $result->fetch_assoc();
                    Session::set('adminlogin', true);
                    Session::set('idAdmin', $value['idAdmin']);
                    Session::set('AdminUser', $value['AdminUser']);
                    Session::set('AdminName', $value['AdminName']);
                    Session::set('Position', $value['Position']);
                    header('Location:index.php');
                }else {
                    $alert = "<span class='text-danger mt-1'>Tài khoản hoặc mật khẩu không đúng!!</span>";
                    return $alert;
                }
            }
        }

        //Hiện thông tin admin
        public function show_admin($id)
        {
            $query = "SELECT * FROM Admin WHERE idAdmin = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        //Hiện danh sách admin
        public function show_list_admin()
        {
            $query = "SELECT * FROM Admin";
            $result = $this->db->select($query);
            return $result;
        }

        //Chỉnh sửa thông tin cá nhân của admin
        public function update_admin($data, $files, $id)
        {
            $AdminName = mysqli_real_escape_string($this->db->link, $data['AdminName']);
            $NumberPhone = mysqli_real_escape_string($this->db->link, $data['NumberPhone']);
            $Email = mysqli_real_escape_string($this->db->link, $data['Email']);
            $Address = mysqli_real_escape_string($this->db->link, $data['Address']);


            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['Avatar']['name'];
            $file_size = $_FILES['Avatar']['size'];
            $file_temp = $_FILES['Avatar']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "../assets/images/user/".$unique_image;

            if(!empty($file_name)){
                //Nếu người dùng chọn ảnh
                if($file_size > 20480000) {
                    $alert = "<span class='text-danger mt-1 ml-2'>Kích cỡ ảnh phải nhỏ hơn 2MB!</span>";
                    return $alert;
                }else if(in_array(($file_ext), $permited) === false){
                    $alert = "<span class='text-danger mt-1 ml-2'>Bạn chỉ có thể upload:-".implode(', ', $permited)."!</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE Admin
                            SET AdminName = '$AdminName',
                                NumberPhone = '$NumberPhone',
                                Email = '$Email',
                                Address = '$Address',
                                Avatar = '$unique_image'
                            WHERE idAdmin = '$id'";
            }else {
                //Nếu người dùng không chọn ảnh
                $query = "UPDATE Admin SET AdminName = '$AdminName', NumberPhone = '$NumberPhone', Email = '$Email', Address = '$Address' WHERE idAdmin = '$id'";
            }

            $result = $this->db->insert($query);

            if($result) {
                $alert = "<span class='text-success mt-1 ml-2'>Lưu Thông Tin Thành Công!</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger mt-1 ml-2'>Lưu Thông Tin Thất Bại!</span>";
                return $alert;
            }
        }

        //Đổi mật khẩu tài khoản admin
        public function change_password($data, $id)
        {
            $password = mysqli_real_escape_string($this->db->link, $data['password']);
            $newpassword = mysqli_real_escape_string($this->db->link, $data['newpassword']);
            $renewpassword = mysqli_real_escape_string($this->db->link, $data['renewpassword']);

            $sql = "SELECT AdminPass FROM Admin WHERE idAdmin='$id'";
            $sql_result = $this->db->select($sql);
            $row = $sql_result->fetch_array()[0]?? '';

            if(md5($password) != $row){
                $alert = "<span class='text-danger mt-1'>Nhập mật khẩu cũ không đúng!!</span>";
                return $alert;
            }else{
                $query = "UPDATE Admin SET
                AdminPass = '".md5($newpassword)."',
                AdminRePass = '".md5($renewpassword)."'
                WHERE idAdmin='$id'";  
            }
            $result = $this->db->update($query);
            if($result) {
                $alert = "<span class='text-success mt-1'>Đổi mật khẩu thành công!</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger mt-1'>Đổi mật khẩu thất bại!</span>";
                return $alert;
            }
        }

        //Xóa tài khoản khách hàng theo mã khách hàng
        public function del_customer($id)
        {
            $query = "DELETE FROM Customer WHERE idCustomer = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='text-success mt-1 ml-3'>Xoá tài khoản khách hàng thành công!</span>";
                return $alert;
            }else{
                $alert = "<span class='text-danger mt-1 ml-3'>Xóa tài khoản khách hàng thất bại!</span>";
                return $alert;
            }
        }

        //Xóa tài khoản nhân viên
        public function del_admin($id)
        {
            $query_ps = "SELECT Position FROM Admin WHERE idAdmin ='$id' AND Position = 'Nhân Viên'";
            $result_ps = $this->db->select($query_ps);
            // $row = $result_ps->fetch_array();
            $query = "DELETE FROM Admin WHERE idAdmin = '$id' AND Position = 'Nhân Viên'";
            $result = $this->db->delete($query);
            if($result && $result_ps){
                $alert = "<span class='text-success mt-1 ml-3'>Xoá nhân viên thành công!</span>";
                return $alert;
            }else{
                $alert = "<span class='text-danger mt-1 ml-3'>Không thể xóa Quản Lý!</span>";
                return $alert;
            }
        }

        //Thêm tài khoản nhân viên
        public function insert_admin($data) 
        {
            // Kết nối dữ liệu với CSDL
            $AdminName = mysqli_real_escape_string($this->db->link, $data['AdminName']);
            $NumberPhone = mysqli_real_escape_string($this->db->link, $data['NumberPhone']);
            $Email = mysqli_real_escape_string($this->db->link, $data['Email']);
            $Address = mysqli_real_escape_string($this->db->link, $data['Address']);
            $AdminUser = mysqli_real_escape_string($this->db->link, $data['AdminUser']);
            $AdminPass = mysqli_real_escape_string($this->db->link, $data['AdminPass']);
            $AdminRePass = mysqli_real_escape_string($this->db->link, $data['AdminRePass']);
            $Position = mysqli_real_escape_string($this->db->link, $data['Position']);

            $check_AdminUser = "SELECT * FROM Admin WHERE AdminUser = '$AdminUser' LIMIT 1";
            $result_check = $this->db->select($check_AdminUser);
            if($result_check){
                $alert = "<span class='text-danger mt-1'>Tên tài khoản này đã tồn tại!</span>";
                return $alert;
            }else {
                $query = "INSERT INTO Admin(AdminName,NumberPhone,Email,Address,AdminUser,AdminPass,AdminRePass,Position) VALUES('$AdminName', '$NumberPhone', '$Email', '$Address', '$AdminUser', '".md5($AdminPass)."', '".md5($AdminRePass)."', '$Position') ";
                $result = $this->db->insert($query);
                if($result) {
                    $alert = "<span class='text-success mt-1'>Thêm nhân viên thành công!</span>";
                    return $alert;
                }else {
                    $alert = "<span class='text-danger mt-1'>Thêm nhân viên thất bại!</span>";
                    return $alert;
                }
            }
        }

        // Tổng số lượng nhân viên
        public function total_admin()
        {
            $query = "SELECT COUNT(idAdmin) AS total_admin FROM Admin"; 
            $result = $this->db->select($query);
            return $result;    
        }
    }
?>