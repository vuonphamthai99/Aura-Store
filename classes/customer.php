<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class customer {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        // Đăng ký tài khoản khách hàng
        public function insert_customers($data)
        {
            $username = mysqli_real_escape_string($this->db->link, $data['username']);
            $password = mysqli_real_escape_string($this->db->link, $data['password']);
            $repassword = mysqli_real_escape_string($this->db->link, $data['repassword']);
            
            if($username=="" || $password=="" || $repassword=="") {
                $alert = "<span class='text-danger'>Các trường không được trống!!</span>";
                return $alert;
            }else {
                $check_username = "SELECT * FROM Customer WHERE username = '$username' LIMIT 1";
                $result_check = $this->db->select($check_username);
                if(!preg_match('/^\w{5,}$/', $username)){
                    $alert = "<span class='text-danger'>Tên đăng nhập phải gồm chữ hoặc số và dài hơn 5 ký tự!!</span>";
                    return $alert;
                }else if($result_check){
                    $alert = "<span class='text-danger'>Tên đăng nhập đã tồn tại</span>";
                    return $alert;
                }else if(strlen($password) < '8'){
                    $alert = "<span class='text-danger'>Mật khẩu phải có ít nhất 8 ký tự!!</span>";
                    return $alert;
                }else if($password != $repassword){
                    $alert = "<span class='text-danger'>Nhập lại mật khẩu không trùng khớp!!</span>";
                    return $alert;
                }else {
                    $query = "INSERT INTO Customer(username, password, repassword) VALUES('$username', '".md5($password)."', '".md5($repassword)."')";
                    $result = $this->db->insert($query);
                    if($result) {
                        $alert = "<span class='text-success'>Đăng Ký Tài Khoản Thành Công</span>";
                        return $alert;
                    }else {
                        $alert = "<span class='text-danger'>Đăng Ký Tài Khoản Thất Bại</span>";
                        return $alert;
                    }
                }
            }
        }

        // Đăng nhập tài khoản khách hàng
        public function login_customers($data)
        {
            $username = mysqli_real_escape_string($this->db->link, $data['username']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

            if($username=='' || $password=='') {
                $alert = "<span class='text-danger'>Các trường không được trống!!</span>";
                return $alert;
            }else {
                $check_login = "SELECT * FROM Customer WHERE username = '$username' AND password='$password'";
                $result_check = $this->db->select($check_login);
                if($result_check){
                    $value = $result_check->fetch_assoc();
                    Session::set('customer_login', true);
                    Session::set('customer_id', $value['idCustomer']);
                    header('Location:index.php');
                }else {
                    $alert = "<span class='text-danger'>Mật khẩu hoặc Tên đăng nhập không chính xác!!</span>";
                    return $alert;
                }
            }
        }

        // Hiển thị thông tin khách hàng theo mã khách hàng
        public function show_customers($id)
        {
            $query = "SELECT * FROM Customer WHERE idCustomer = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        
        // Hiển thị danh sách khách hàng
        public function show_list_customers()
        {
            $query = "SELECT * FROM Customer";
            $result = $this->db->select($query);
            return $result;
        }

        // Cập nhật khách hàng
        public function update_customers($data, $files, $id)
        {
            $CustomerName = mysqli_real_escape_string($this->db->link, $data['CustomerName']);
            $PhoneNumber = mysqli_real_escape_string($this->db->link, $data['PhoneNumber']);

            $permited = array('jpg','jpeg','png','gif');
            $file_name = $_FILES['Avatar']['name'];
            $file_size = $_FILES['Avatar']['size'];
            $file_temp = $_FILES['Avatar']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "../Aura-Store/assets/images/customer/".$unique_image;

            if($CustomerName=="" || $PhoneNumber=="") {
                $alert = "<span class='text-danger mt-10'>Các trường không được trống!!</span>";
                return $alert;
            }else if(strlen($PhoneNumber) < '10' || strlen($PhoneNumber) > '12'){
                $alert = "<span class='text-danger mt-10'>Số điện thoại phải từ 10 đến 12 số</span>";
                return $alert;
            }else {
                if(!empty($file_name)){
                    //Nếu người dùng chọn ảnh
                    if($file_size > 20480000) {
                        $alert = "<span class='text-danger mt-10'>Kích cỡ ảnh phải nhỏ hơn 2MB!</span>";
                        return $alert;
                    }else if(in_array(($file_ext), $permited) === false){
                        $alert = "<span class='text-danger mt-10'>Bạn chỉ có thể upload:-".implode(', ', $permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE Customer
                              SET CustomerName = '$CustomerName',
                                  PhoneNumber = '$PhoneNumber',
                                  Avatar = '$unique_image'
                              WHERE idCustomer = '$id'";
                    }else {
                        //Nếu người dùng không chọn ảnh
                        $query = "UPDATE Customer SET CustomerName = '$CustomerName', PhoneNumber = '$PhoneNumber' WHERE idCustomer = '$id'";
                    }
                }
            $result = $this->db->insert($query);
            if($result) {
                $alert = "<span class='text-success mt-10'>Lưu Thông Tin Thành Công</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger mt-10'>Lưu Thông Tin Thất Bại</span>";
                return $alert;
            }
        }

        // Đổi mật khẩu tài khoản khách hàng
        public function change_password($data, $id)
        {
            $password = mysqli_real_escape_string($this->db->link, $data['password']);
            $newpassword = mysqli_real_escape_string($this->db->link, $data['newpassword']);
            $renewpassword = mysqli_real_escape_string($this->db->link, $data['renewpassword']);

            $sql = "SELECT password FROM Customer WHERE idCustomer='$id'";
            $sql_result = $this->db->select($sql);
            $row = $sql_result->fetch_array()[0]?? '';

            if($password=="" || $newpassword=="" || $renewpassword=="") {
                $alert = "<span class='text-danger mt-10'>Các trường không được trống!!</span>";
                return $alert;
            }else if(md5($password) != $row){
                $alert = "<span class='text-danger mt-10'>Nhập mật khẩu cũ không đúng!!</span>";
                return $alert;
            }else if(strlen($newpassword) < '8'){
                $alert = "<span class='text-danger mt-10'>Mật khẩu mới phải có ít nhất 8 ký tự!!</span>";
                return $alert;
            }else if($newpassword != $renewpassword){
                $alert = "<span class='text-danger mt-10'>Xác nhận mật khẩu không đúng!!</span>";
                return $alert;
            }else{
                $query = "UPDATE Customer SET
                password = '".md5($newpassword)."',
                repassword = '".md5($renewpassword)."'
                WHERE idCustomer='$id'";  
            }
            $result = $this->db->update($query);
            if($result) {
                $alert = "<span class='text-success mt-10'>Đổi mật khẩu thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger mt-10'>Đổi mật khẩu thất bại</span>";
                return $alert;
            }
        }

        // Tổng số lượng khách hàng
        public function total_customer()
        {
            $query = "SELECT COUNT(idCustomer) AS total_customer FROM Customer"; 
            $result = $this->db->select($query);
            return $result;    
        }
    }
?>
