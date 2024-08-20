<?php 
include_once ("pdo.php");
function insert_chi_tiet_sp($so_luong,$ngay_nhap,$id_san_pham,$id_size,$id_do_an_them){
    $sql = "INSERT INTO chi_tiet_san_pham(so_luong,ngay_nhap,id_san_pham,id_size,id_do_an_them) VALUES (?,?,?,?,?)";
    pdo_execute($sql,$so_luong,$ngay_nhap,$id_san_pham,$id_size,$id_do_an_them);
}
?>