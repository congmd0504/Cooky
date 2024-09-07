<?php 
include_once ("pdo.php");

function insert_danh_gia($id_khach_hang,$id_san_pham,$danh_gia,$noi_dung,$ngay_danh_gia){
    $sql = "INSERT INTO danh_gia (id_khach_hang,id_san_pham,danh_gia,noi_dung,ngay_danh_gia) VALUES (?,?,?,?,?)";
    pdo_execute($sql,$id_khach_hang,$id_san_pham,$danh_gia,$noi_dung,$ngay_danh_gia);
}
function kiem_tra_danh_gia($id_khach_hang,$id_san_pham){
    $sql = "SELECT * FROM danh_gia WHERE id_khach_hang=? and id_san_pham = ? ";
    return pdo_query($sql,$id_khach_hang,$id_san_pham);
}
?>