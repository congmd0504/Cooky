<?php 
include_once('pdo.php');
function insert_tai_khoan($ho_ten,$ten_dang_nhap,$mat_khau,$email){
    $sql="INSERT INTO user (ho_ten,ten_dang_nhap,mat_khau,email) VALUE (?,?,?,?) ";
    return pdo_execute($sql,$ho_ten,$ten_dang_nhap,$mat_khau,$email);
}
function checkuser($ten_dang_nhap,$mat_khau)
{
    $sql = "SELECT * FROM user where ten_dang_nhap= ? AND mat_khau= ?";
    $sp = pdo_query_one($sql,$ten_dang_nhap,$mat_khau);
    return $sp;
}
function kiem_tra_nguoi_dung_ton_tai($ten_dang_nhap)
{
    $sql = "SELECT count(*) FROM user WHERE ten_dang_nhap=?";
    return pdo_query_value($sql, $ten_dang_nhap) > 0;
}
function account_update($id_khach_hang, $ho_ten, $email, $phone, $hinh_anh, $dia_chi) {
    if ($hinh_anh != "") {
        $sql = "UPDATE user SET ho_ten = ?, email = ?, phone = ?, hinh_anh = ?, dia_chi = ? WHERE id_khach_hang = ?";
        pdo_query($sql, $ho_ten, $email, $phone, $hinh_anh, $dia_chi, $id_khach_hang);
    } else {
        $sql = "UPDATE user SET ho_ten = ?, email = ?, phone = ?, dia_chi = ? WHERE id_khach_hang = ?";
        pdo_query($sql, $ho_ten, $email, $phone, $dia_chi, $id_khach_hang);
    }
}

function taikhoan_select_by_id($id_khach_hang){
    $sql = "SELECT * FROM user WHERE id_khach_hang =?";
    return pdo_query_one($sql,$id_khach_hang);
}
?>