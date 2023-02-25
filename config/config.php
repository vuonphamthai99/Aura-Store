<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
// define("DB_PASS", "31/{*VA6)QAP(uQF");
define("DB_PASS", "");
define("DB_NAME", "aurashop");
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if($conn->connect_error){
    die("Kết nối không thành công". $conn->connect_error);
}
?>
