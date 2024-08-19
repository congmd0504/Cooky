<?php 
require_once("pdo.php");

function them_moi_san_pham($ten_san_pham,$price,$mo_ta,$hinh_anh,$luot_xem,$ngay_nhap,$id_danh_muc){
    $sql="INSERT INTO san_pham(ten_san_pham,price,mo_ta,hinh_anh,luot_xem,ngay_nhap,id_danh_muc) VALUES(?,?,?,?,?,?,?)";
    pdo_execute($sql,$ten_san_pham,$price,$mo_ta,$hinh_anh,$luot_xem,$ngay_nhap,$id_danh_muc);
}
function loadall_san_pham(){
    $sql="SELECT (ten_san_pham,price,mo_ta,hinh_anh,luot_xem,ngay_nhap,ten_danh_muc ";
}
?>