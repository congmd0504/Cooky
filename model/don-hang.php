<?php
include_once("pdo.php");
function insert_don_hang($id_khach_hang, $phone, $dia_chi_giao, $id_trang_thai_don, $ngay_tao, $payment_method, $note)
{
    if ($payment_method == 1) {
        $id_trang_thai_don = 1;
    }
    if ($payment_method == 2) {
        $id_trang_thai_don = 7;
    }
    $sql = "INSERT INTO don_hang(id_khach_hang,phone,dia_chi_giao,id_trang_thai_don,ngay_tao,payment_method,note) VALUES (?,?,?,?,?,?,?)";
    return pdo_execute_return_lastInsertId($sql, $id_khach_hang, $phone, $dia_chi_giao, $id_trang_thai_don, $ngay_tao, $payment_method, $note);
}
function select_don_hang($id_don_hang){
    $sql = "SELECT don_hang.* ,user.ho_ten,user.phone FROM don_hang JOIN user ON user.id_khach_hang = don_hang.id_khach_hang WHERE id_don_hang = ?";
    return pdo_query_one($sql,$id_don_hang);
}
function select_don_hang_by_id($id_khach_hang){
    $sql = "SELECT * FROM don_hang WHERE id_khach_hang = ?";
    return pdo_query($sql,$id_khach_hang);
}
function update_don_hang($id_don_hang,$id_trang_thai_don){
    $sql= "UPDATE don_hang SET id_trang_thai_don = ? WHERE id_don_hang = ?";
    pdo_execute($sql,$id_trang_thai_don,$id_don_hang);
}
function huy_don_hang($id_don_hang){
    $sql= "UPDATE don_hang SET id_trang_thai_don = 6 WHERE id_don_hang = ?";
    pdo_execute($sql,$id_don_hang);
}
function loadall_don_hang(){
    $sql = "SELECT don_hang.*,user.ho_ten,user.email,user.phone,trang_thai_don.ten_trang_thai_don FROM don_hang JOIN user ON user.id_khach_hang = don_hang.id_khach_hang JOIN trang_thai_don ON trang_thai_don.id_trang_thai_don = don_hang.id_trang_thai_don";
    return pdo_query($sql);
}
function don_hang_select_all_by(){
    $sql = "SELECT don_hang.*,user.ho_ten,trang_thai_don.ten_trang_thai_don FROM don_hang JOIN user ON user.id_khach_hang = don_hang.id_khach_hang JOIN trang_thai_don ON trang_thai_don.id_trang_thai_don = don_hang.id_trang_thai_don WHERE don_hang.id_trang_thai_don = 1";
    return pdo_query($sql);
}
function don_hang_select_by_user(){
    $sql =  "SELECT don_hang.*,user.ho_ten,user.email,user.phone,trang_thai_don.ten_trang_thai_don,SUM(chi_tiet_don_hang.so_luong) AS tong_so_luong,chi_tiet_don_hang.tong_gia_tien FROM don_hang JOIN chi_tiet_don_hang ON don_hang.id_don_hang=chi_tiet_don_hang.id_don_hang JOIN user ON user.id_khach_hang = don_hang.id_khach_hang JOIN trang_thai_don ON trang_thai_don.id_trang_thai_don = don_hang.id_trang_thai_don GROUP BY don_hang.id_don_hang, user.ho_ten, user.email, user.phone, trang_thai_don.ten_trang_thai_don, chi_tiet_don_hang.tong_gia_tien";
    return pdo_query($sql);
}
