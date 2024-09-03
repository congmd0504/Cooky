<?php 
include_once ("pdo.php");
function insert_chi_tiet_don_hang($id_don_hang,$id_chi_tiet_san_pham,$so_luong,$tong_gia_tien){
    $sql= "INSERT INTO chi_tiet_don_hang(id_don_hang,id_chi_tiet_san_pham,so_luong,tong_gia_tien) VALUES (?,?,?,?)";
    pdo_execute($sql,$id_don_hang,$id_chi_tiet_san_pham,$so_luong,$tong_gia_tien);
}
?>