<?php

use Illuminate\Database\DBAL\TimestampType;

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class product {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        //Tìm kiếm sản phẩm
        public function search_product($tukhoa)
        {
            $pd_perpage = 15;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;

            $tukhoa = $this->fm->validation($tukhoa);
            $query = "SELECT * FROM Product WHERE ProductName LIKE '%$tukhoa%' LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Thêm sản phẩm
        public function insert_product($data,$files) 
        {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            // Kết nối dữ liệu với CSDL
            $ProductName = mysqli_real_escape_string($this->db->link, $data['ProductName']);
            $idCategory = mysqli_real_escape_string($this->db->link, $data['idCategory']);
            $idBrand = mysqli_real_escape_string($this->db->link, $data['idBrand']);
            $DesProduct = mysqli_real_escape_string($this->db->link, $data['DesProduct']);
            $Price = mysqli_real_escape_string($this->db->link, $data['Price']);
            $Quantity = mysqli_real_escape_string($this->db->link, $data['Quantity']);
            $ShortDes_Pro = mysqli_real_escape_string($this->db->link, $data['ShortDes_Pro']);
            $Date_Add = date("Y-m-d H:i:s");

            $targetDir = "../assets/images/product/"; 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            
            $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
            $fileNames = array_filter($_FILES['ImageName']['name']); 

            $query_delete_pd = "DELETE FROM Product WHERE Date_Add = '$Date_Add'";

            $query = "INSERT INTO Product(ProductName,idCategory,idBrand,DesProduct,Price,Quantity,Date_Add,ShortDes_Pro) VALUES('$ProductName', '$idCategory', '$idBrand', '$DesProduct', '$Price','$Quantity','$Date_Add','$ShortDes_Pro') ";
            $result = $this->db->insert($query);
                
            if($result) {
                $query_idpd = "SELECT idProduct FROM Product WHERE Date_Add = '$Date_Add'";
                $result_idpd = $this->db->select($query_idpd);
                $row = $result_idpd->fetch_array()[0]?? '';

                foreach($_FILES['ImageName']['name'] as $key=>$val){ 
                    // File upload path 
                    $fileName = basename($_FILES['ImageName']['name'][$key]); 
                    $targetFilePath = $targetDir . $fileName; 
                        
                    // Check whether file type is valid 
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                    if(in_array($fileType, $allowTypes)){ 
                        // Upload file to server 
                        if(move_uploaded_file($_FILES["ImageName"]["tmp_name"][$key], $targetFilePath)){ 
                            // Image db insert sql 
                            $insertValuesSQL .= "('".$fileName."', '".$row."'),"; 
                        }else{ 
                            $errorUpload .= $_FILES['ImageName']['name'][$key].' | '; 
                        } 
                    }else{ 
                        $errorUploadType .= $_FILES['ImageName']['name'][$key].' | '; 
                    } 
                } 

                // Error message 
                $errorUpload = !empty($errorUpload)?'Lỗi Upload: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'Lỗi định dạng File: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 

                if(!empty($insertValuesSQL)){ 
                    $insertValuesSQL = trim($insertValuesSQL, ','); 
                    // Insert image file name into database 
                    $query_img = "INSERT INTO ProductImage(ImageName, idProduct) VALUES $insertValuesSQL";
                    $result_img = $this->db->insert($query_img);
                    if($result_img) {
                        $alert = "<span class='text-success'>Thêm sản phẩm thành công!</span>";
                        return $alert;
                    }else {
                        $result_delete_pd = $this->db->delete($query_delete_pd);
                        $alert = "<span class='text-danger'>Có lỗi khi đang tải tệp lên!</span>";
                        return $alert;
                    }
                }else{ 
                    $result_delete_pd = $this->db->delete($query_delete_pd);
                    $alert = "<span class='text-danger'>Thêm sản phẩm thất bại! ".$errorMsg." <br>Chỉ có thể tải tệp: jpg, png, jpeg, gif.</span>";
                    return $alert;
                }
            }else{
                $result_delete_pd = $this->db->delete($query_delete_pd);
                $alert = "<span class='text-danger'>Thêm sản phẩm thất bại!</span>";
                return $alert;
            }
        }

        //Hiển thị danh sách sản phẩm, tên danh mục, tên thương hiệu
        public function show_product()
        {
            $query = "SELECT Product.*, Category.CategoryName, Brand.BrandName
                      FROM Product INNER JOIN Category ON Product.idCategory = Category.idCategory
                      INNER JOIN Brand ON Product.idBrand = Brand.idBrand
                      ORDER BY Product.idProduct DESC";
            
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị 1 hình ảnh sản phẩm theo mã sản phẩm
        public function show_image_pd($id)
        {
            $query = "SELECT ImageName, ProductImage.idProduct FROM ProductImage INNER JOIN Product ON ProductImage.idProduct = Product.idProduct WHERE Product.idProduct = '$id' LIMIT 1"; 
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị danh sách hình ảnh sản phẩm theo mã sản phẩm
        public function show_list_image_pd($id)
        {
            $query = "SELECT ImageName FROM ProductImage INNER JOIN Product ON ProductImage.idProduct = Product.idProduct WHERE Product.idProduct = '$id'"; 
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị sản phẩm mới
        public function show_new_pd()
        {
            $now = date('Y-m-d H:i:s');
            $query = "SELECT * FROM Product WHERE Date_Add >= '$now' -  interval 30 day AND Date_Add <= '$now' ORDER BY Date_Add DESC";       
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị sản phẩm mới (tối đa 20)
        public function show_new_pd_20()
        {
            $now = date('Y-m-d H:i:s');
            $query = "SELECT * FROM Product WHERE Date_Add >= '$now' -  interval 30 day AND Date_Add <= '$now' ORDER BY Date_Add DESC LIMIT 20";       
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị sản phẩm đang SALE
        public function show_sale_pd()
        {
            $now = date('Y-m-d H:i:s');
            $query = "SELECT * FROM Product INNER JOIN SaleProduct ON Product.idProduct = SaleProduct.idProduct WHERE SaleStart < '$now' AND SaleEnd > '$now'";       
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị sản phẩm theo danh mục
        public function show_product_by_cat($id)
        {
            $query = "SELECT Product.*, Category.CategoryName
                      FROM Product INNER JOIN Category ON Product.idCategory = Category.idCategory
                      WHERE Product.idCategory = '$id' ORDER BY Product.idProduct DESC";
            
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị sản phẩm theo thương hiệu
        public function show_product_by_brand($id)
        {
            $query = "SELECT Product.*, Brand.BrandName
                      FROM Product INNER JOIN Brand ON Product.idBrand = Brand.idBrand
                      WHERE Product.idBrand = '$id' ORDER BY Product.idProduct DESC";
            
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị sản phẩm bán chạy
        public function show_product_best_sell()
        {
            $query = "SELECT Product.* FROM Product ORDER BY Sold DESC LIMIT 20";
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị top sản phẩm bán chạy
        public function show_product_top_best_sell()
        {
            $query = "SELECT Product.* FROM Product ORDER BY Sold DESC LIMIT 3";
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị sản phẩm nổi bật
        public function show_product_featured()
        {
            $now = date('Y-m-d H:i:s');
            $query = "SELECT Product.* FROM Product WHERE Date_Add >= '$now' -  interval 30 day and Date_Add <= '$now' ORDER BY Sold DESC LIMIT 20";
            $result = $this->db->select($query);
            return $result;
        }

        //Hiển thị sản phẩm liên quan
        public function show_product_related($idProduct)
        {
            $query_pd_by_id = "SELECT * FROM Product WHERE idProduct = '$idProduct'";
            $result_pd_by_id = $this->db->select($query_pd_by_id)->fetch_assoc();
            $idBrand = $result_pd_by_id['idBrand'];
            $idCategory = $result_pd_by_id['idCategory']; 

            $query = "SELECT * FROM Product WHERE (idBrand = '$idBrand' OR idCategory ='$idCategory') AND NOT idProduct = '$idProduct' 
                        ORDER BY Sold DESC, Date_Add DESC LIMIT 10";
            $result = $this->db->select($query);
            return $result;
        }

        //Cập nhật sản phẩm
        public function update_product($data, $files, $id)
        {
            $ProductName = mysqli_real_escape_string($this->db->link, $data['ProductName']);
            $idCategory = mysqli_real_escape_string($this->db->link, $data['idCategory']);
            $idBrand = mysqli_real_escape_string($this->db->link, $data['idBrand']);
            $DesProduct = mysqli_real_escape_string($this->db->link, $data['DesProduct']);
            $Price = mysqli_real_escape_string($this->db->link, $data['Price']);
            $Quantity = mysqli_real_escape_string($this->db->link, $data['Quantity']);
            $ShortDes_Pro = mysqli_real_escape_string($this->db->link, $data['ShortDes_Pro']);

            $targetDir = "../assets/images/product/"; 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            
            $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
            $fileNames = array_filter($_FILES['ImageName']['name']); 

            foreach($_FILES['ImageName']['name'] as $key=>$val){ 
                // File upload path 
                $fileName = basename($_FILES['ImageName']['name'][$key]); 
                $targetFilePath = $targetDir . $fileName; 
                    
                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to server 
                    if(move_uploaded_file($_FILES["ImageName"]["tmp_name"][$key], $targetFilePath)){ 
                        // Image db insert sql 
                        $insertValuesSQL .= "('".$fileName."', '".$id."'),"; 
                    }else{ 
                        $errorUpload .= $_FILES['ImageName']['name'][$key].' | '; 
                    } 
                }else{ 
                    $errorUploadType .= $_FILES['ImageName']['name'][$key].' | '; 
                } 
            } 

            // Error message 
            $errorUpload = !empty($errorUpload)?'Lỗi Upload: '.trim($errorUpload, ' | '):''; 
            $errorUploadType = !empty($errorUploadType)?'Lỗi định dạng File: '.trim($errorUploadType, ' | '):''; 
            $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
            
            $query = "UPDATE Product SET
            ProductName = '$ProductName',
            idCategory = '$idCategory',
            idBrand = '$idBrand',
            DesProduct = '$DesProduct',
            Price = '$Price',
            Quantity = '$Quantity',
            ShortDes_Pro = '$ShortDes_Pro'
            WHERE idProduct = '$id'";  

            //Khi người dùng không chọn ảnh
            if(empty($fileNames)){
                $result = $this->db->update($query);
                if($result) {
                    $alert = "<span class='text-success'>Cập nhật sản phẩm thành công!</span>";
                    return $alert;
                }else {
                    $alert = "<span class='text-danger'>Cập nhật sản phẩm thất bại!</span>";
                    return $alert;
                }
            } //Khi người dùng chọn ảnh
            else{ 
                if(!empty($insertValuesSQL)){
                    $insertValuesSQL = trim($insertValuesSQL, ','); 
                    // Insert image file name into database 
                    $query_delete_img = "DELETE FROM ProductImage WHERE idProduct = '$id'";
                    $result_delete_img = $this->db->delete($query_delete_img);
                    $query_img = "INSERT INTO ProductImage(ImageName, idProduct) VALUES $insertValuesSQL";
                    $result_img = $this->db->insert($query_img);
                    $result = $this->db->update($query);
                    if($result_img && $result && $query_delete_img) {
                        $alert = "<span class='text-success'>Cập nhật sản phẩm thành công!</span>";
                        return $alert;
                    }else if(!($result_img && $result && $query_delete_img)) {
                        $alert = "<span class='text-danger'>Có lỗi khi đang tải tệp lên!</span>";
                        return $alert;
                    }
                }else {
                    $alert = "<span class='text-danger'>Cập nhật sản phẩm thất bại! ".$errorMsg." <br>Chỉ có thể tải tệp: jpg, png, jpeg, gif.</span>";
                    return $alert;
                }
            }
        }

        //Xóa sản phẩm theo mã sản phẩm
        public function del_product($id)
        {
            $query = "DELETE FROM Product WHERE idProduct = '$id' ";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='text-success'>Xoá sản phẩm thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='text-danger'>Xóa sản phẩm thất bại</span>";
                return $alert;
            }
        }

        //Hiển thị sản phẩm theo mã sản phẩm
        public function getproductbyId($id)
        {
            $query = "SELECT * FROM Product WHERE idProduct = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm
        public function getproduct_transpage()
        {
            $pd_perpage = 24;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;
            $query = "SELECT * FROM Product ORDER BY idProduct ASC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm đang SALE
        public function getproduct_transpage_sale_pd()
        {
            $pd_perpage = 24;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;

            $now = date('Y-m-d H:i:s');
            $query = "SELECT Product.*, SaleProduct.* FROM Product
                      INNER JOIN SaleProduct ON Product.idProduct = SaleProduct.idProduct
                      WHERE SaleStart < '$now' AND SaleEnd > '$now' AND Date_Add >= '$now' -  interval 30 day AND Date_Add <= '$now'
                      ORDER BY Sold DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm đang SALE giá thấp đến cao
        public function getproduct_transpage_sale_price_asc()
        {
            $pd_perpage = 24;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;

            $now = date('Y-m-d H:i:s');
            $query = "SELECT Product.*, SaleProduct.* FROM Product
                      INNER JOIN SaleProduct ON Product.idProduct = SaleProduct.idProduct
                      WHERE SaleStart < '$now' AND SaleEnd > '$now'
                      ORDER BY Price + 0 ASC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm đang SALE giá cao đến thấp
        public function getproduct_transpage_sale_price_desc()
        {
            $pd_perpage = 24;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;

            $now = date('Y-m-d H:i:s');
            $query = "SELECT Product.*, SaleProduct.* FROM Product
                      INNER JOIN SaleProduct ON Product.idProduct = SaleProduct.idProduct
                      WHERE SaleStart < '$now' AND SaleEnd > '$now'
                      ORDER BY Price + 0 DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm đang SALE & bán chạy
        public function getproduct_transpage_sale_bestsells()
        {
            $pd_perpage = 24;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;

            $now = date('Y-m-d H:i:s');
            $query = "SELECT Product.*, SaleProduct.* FROM Product
                      INNER JOIN SaleProduct ON Product.idProduct = SaleProduct.idProduct
                      WHERE SaleStart < '$now' AND SaleEnd > '$now'
                      ORDER BY Sold DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm đang SALE & mới đến cũ
        public function getproduct_transpage_sale_new()
        {
            $pd_perpage = 24;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;

            $now = date('Y-m-d H:i:s');
            $query = "SELECT Product.*, SaleProduct.* FROM Product
                      INNER JOIN SaleProduct ON Product.idProduct = SaleProduct.idProduct
                      WHERE SaleStart < '$now' AND SaleEnd > '$now'
                      ORDER BY Date_Add DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm đang SALE & cũ đến mới
        public function getproduct_transpage_sale_old()
        {
            $pd_perpage = 24;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;

            $now = date('Y-m-d H:i:s');
            $query = "SELECT Product.*, SaleProduct.* FROM Product
                      INNER JOIN SaleProduct ON Product.idProduct = SaleProduct.idProduct
                      WHERE SaleStart < '$now' AND SaleEnd > '$now'
                      ORDER BY Date_Add ASC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo giá thấp đến cao
        public function getproduct_transpage_price_asc()
        {
            $pd_perpage = 24;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;

            $query = "SELECT * FROM Product ORDER BY Price + 0 ASC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo giá cao đến thấp
        public function getproduct_transpage_price_desc()
        {
            $pd_perpage = 24;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ($page - 1)*$pd_perpage;

            $query = "SELECT * FROM Product ORDER BY Price + 0 DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo danh mục
        public function getproduct_bycat_transpage($id)
        {
            $now = date('Y-m-d H:i:s');
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idCategory = '$id' AND Date_Add >= '$now' -  interval 30 day AND Date_Add <= '$now'
                     ORDER BY Sold DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo danh mục & giá thấp đến cao
        public function getproduct_bycat_transpage_price_asc($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idCategory = '$id'
                     ORDER BY Price + 0 ASC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo danh mục & giá cao đến thấp
        public function getproduct_bycat_transpage_price_desc($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idCategory = '$id'
                     ORDER BY Price + 0 DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo danh mục & bán chạy
        public function getproduct_bycat_transpage_bestsells($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idCategory = '$id'
                     ORDER BY Sold DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo danh mục & mới nhất
        public function getproduct_bycat_transpage_new($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idCategory = '$id'
                     ORDER BY Date_Add DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo danh mục & cũ nhất
        public function getproduct_bycat_transpage_old($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idCategory = '$id'
                     ORDER BY Date_Add ASC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo thương hiệu
        public function getproduct_bybrand_transpage($id)
        {
            $now = date('Y-m-d H:i:s');
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idBrand = '$id' AND Date_Add >= '$now' -  interval 30 day AND Date_Add <= '$now'
                     ORDER BY Sold DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo thương hiệu & giá thấp đến cao
        public function getproduct_bybrand_transpage_price_asc($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idBrand = '$id'
                     ORDER BY Price + 0 ASC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo thương hiệu & giá cao đến thấp
        public function getproduct_bybrand_transpage_price_desc($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idBrand = '$id'
                     ORDER BY Price + 0 DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo thương hiệu & bán chạy
        public function getproduct_bybrand_transpage_bestsells($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idBrand = '$id'
                     ORDER BY Sold DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo thương hiệu & mới nhất
        public function getproduct_bybrand_transpage_new($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idBrand = '$id'
                     ORDER BY Date_Add DESC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        //Phân trang sản phẩm theo thương hiệu & mới nhất
        public function getproduct_bybrand_transpage_old($id)
        {
            $pd_perpage = 16;
            if(!isset($_GET['page'])){
                $page = 1;
            }else {
                $page = $_GET['page'];
            }
            $per_page = ((int)($page) - 1)*$pd_perpage;
            $query = "SELECT * FROM Product
                     WHERE idBrand = '$id'
                     ORDER BY Date_Add ASC LIMIT $per_page,$pd_perpage";
            $result = $this->db->select($query);
            return $result;
        }

        // Tổng số lượng sản phẩm
        public function total_product()
        {
            $query = "SELECT COUNT(idProduct) AS total_product FROM Product"; 
            $result = $this->db->select($query);
            return $result;    
        }
        
        // Thêm khuyến mãi cho sản phẩm 4-6
        public function insert_discount_product($data) 
        {
            // Kết nối dữ liệu với CSDL
            $SaleName = mysqli_real_escape_string($this->db->link, $data['SaleName']);
            $SaleStart = mysqli_real_escape_string($this->db->link, $data['datetime-start']);
            $SaleEnd = mysqli_real_escape_string($this->db->link, $data['datetime-end']);
            $Discount = mysqli_real_escape_string($this->db->link, $data['Discount']);

            foreach($data['chk_product'] as $key => $val){
                $Product[$key] = $val;

                $query_time_sale = "SELECT MAX(SaleEnd) AS MaxSaleEnd FROM SaleProduct WHERE idProduct = '$Product[$key]'";
                $result_time_sale = $this->db->select($query_time_sale);
                if($result_time_sale) $get_time_sale = $result_time_sale->fetch_assoc();

                $query_name_pd = "SELECT ProductName FROM Product WHERE idProduct = '$Product[$key]'";
                $result_name_pd = $this->db->select($query_name_pd)->fetch_assoc();
                $name_pd = $result_name_pd['ProductName'];

                if($get_time_sale['MaxSaleEnd'] && $get_time_sale['MaxSaleEnd'] >= $SaleStart){
                    $alert = "<span class='text-danger'>Thêm khuyến mãi thất bại, sản phẩm $name_pd đã có khuyến mãi trong thời gian trên.</span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO SaleProduct(idProduct, SaleName, SaleStart, SaleEnd, Discount) VALUES('$Product[$key]', '$SaleName', '$SaleStart', '$SaleEnd', '$Discount')";
                    $result = $this->db->insert($query);
                }
            }
            if($result){
                $alert = "<span class='text-success'>Thêm khuyến mãi thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='text-danger'>Thêm khuyến mãi thất bại</span>";
                return $alert;
            }
        }

        // Cập nhật khuyến mãi theo mã khuyến mãi
        public function update_discount_product($data, $idSale, $idProduct) {
            // Kết nối dữ liệu với CSDL
            $SaleName = mysqli_real_escape_string($this->db->link, $data['SaleName']);
            $SaleStart = mysqli_real_escape_string($this->db->link, $data['datetime-start']);
            $SaleEnd = mysqli_real_escape_string($this->db->link, $data['datetime-end']);
            $Discount = mysqli_real_escape_string($this->db->link, $data['Discount']);

            $query_count_sale = "SELECT COUNT(idProduct) AS total_sale_pd FROM SaleProduct WHERE idProduct = '$idProduct' AND NOT idSale = '$idSale'";
            $result_count_sale = $this->db->select($query_count_sale)->fetch_assoc();

            if($result_count_sale['total_sale_pd'] >= 1){
                $query_this_time = "SELECT SaleStart, SaleEnd FROM SaleProduct WHERE idSale = '$idSale'";
                $result_this_time = $this->db->select($query_this_time)->fetch_assoc();
                $this_start_time = $result_this_time['SaleStart'];
                $this_end_time = $result_this_time['SaleEnd'];

                $query_time_sale_max = "SELECT MAX(SaleEnd) AS MaxSaleEnd
                                    FROM SaleProduct WHERE idProduct = '$idProduct' AND SaleEnd < '$this_end_time'";
                $result_time_sale_max = $this->db->select($query_time_sale_max);
                if($result_time_sale_max) $get_time_sale_max = $result_time_sale_max->fetch_assoc();

                $query_time_sale_min = "SELECT MIN(SaleStart) AS MinSaleStart 
                                    FROM SaleProduct WHERE idProduct = '$idProduct' AND SaleStart > '$this_start_time'";
                $result_time_sale_min = $this->db->select($query_time_sale_min);
                if($result_time_sale_min) $get_time_sale_min = $result_time_sale_min->fetch_assoc();
    
                $query_name_pd = "SELECT ProductName FROM Product WHERE idProduct = '$idProduct'";
                $result_name_pd = $this->db->select($query_name_pd)->fetch_assoc();
                $name_pd = $result_name_pd['ProductName'];

                if(($get_time_sale_max['MaxSaleEnd'] && $get_time_sale_max['MaxSaleEnd'] >= $SaleStart) || ($get_time_sale_min['MinSaleStart'] && $SaleEnd >= $get_time_sale_min['MinSaleStart'])){
                    $alert = "<span class='text-danger'>Cập nhật khuyến mãi thất bại, sản phẩm $name_pd đã có khuyến mãi trong thời gian trên.</span>";
                    return $alert;
                }else{
                    $query = "UPDATE SaleProduct SET 
                        SaleName = '$SaleName',
                        SaleStart = '$SaleStart', 
                        SaleEnd = '$SaleEnd',
                        Discount = '$Discount'
                        WHERE idSale = '$idSale'";
                    $result = $this->db->update($query);
                }
            }else{
                $query = "UPDATE SaleProduct SET 
                        SaleName = '$SaleName',
                        SaleStart = '$SaleStart', 
                        SaleEnd = '$SaleEnd',
                        Discount = '$Discount'
                        WHERE idSale = '$idSale'";
                $result = $this->db->update($query);
            }
            
            if($result) {
                $alert = "<span class='text-success mt-10'>Cập nhật khuyến mãi sản phẩm thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger mt-10'>Cập nhật khuyến mãi sản phẩm thất bại</span>";
                return $alert;
            }
        }

        // Xóa đợt khuyến mãi của 1 sản phẩm
        public function delete_sale_pd($idSale)
        {
            $query = "DELETE FROM SaleProduct WHERE idSale = '$idSale'"; 
            $result = $this->db->delete($query);  

            if($result) {
                $alert = "<span class='text-success ml-3'>Xóa khuyến mãi sản phẩm thành công</span>";
                return $alert;
            }else {
                $alert = "<span class='text-danger ml-3'>Xóa khuyến mãi sản phẩm thất bại</span>";
                return $alert;
            }
        }

        // Lấy thời gian khuyến mãi của 1 sản phẩm theo mã sản phẩm
        public function get_time_sale($idProduct)
        {
            $now = date('Y-m-d H:i:s');
            $query = "SELECT SaleStart, SaleEnd, Discount FROM SaleProduct WHERE idProduct = '$idProduct' AND SaleStart < '$now' AND SaleEnd > '$now'"; 
            $result = $this->db->select($query);
            return $result;    
        }

        // Lấy danh sách các sản phẩm khuyến mãi
        public function show_list_discount()
        {
            $query = "SELECT Product.*, SaleProduct.* FROM SaleProduct
                      INNER JOIN Product ON SaleProduct.idProduct = Product.idProduct ORDER BY SaleName ASC"; 
            $result = $this->db->select($query);
            return $result;    
        }

        // Lấy khuyến mãi của 1 sản phẩm
        public function get_discount_product($idSale)
        {
            $query = "SELECT Product.*, SaleProduct.* FROM SaleProduct
                      INNER JOIN Product ON SaleProduct.idProduct = Product.idProduct
                      WHERE idSale = '$idSale'"; 
            $result = $this->db->select($query);
            return $result;    
        }

        // Lấy tổng đợt khuyến mãi
        public function get_total_discount()
        {
            $query = "SELECT COUNT(idSale) AS total_discount FROM SaleProduct"; 
            $result = $this->db->select($query);
            return $result;    
        }
    }
?>