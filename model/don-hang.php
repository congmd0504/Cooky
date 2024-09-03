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
?>