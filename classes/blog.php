<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class blog {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        // Hiển thị danh sách bài viết
        public function get_blog(){
             $query = "SELECT * FROM Blog where HideShow=1 order by idBlog asc";
            $result = $this->db->select($query);
            return $result;
        }

        // Tổng số lượng bài viết
        public function total_blog()
        {
            $query = "SELECT COUNT(idBlog) AS total_blog FROM Blog"; 
            $result = $this->db->select($query);
            return $result;    
        }
    }
?>