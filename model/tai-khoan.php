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

?>