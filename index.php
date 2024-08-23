<?php 
include_once ("./model/pdo.php");
include_once ("./global.php");
include_once ('./model/san-pham.php');
include_once ('./model/loai.php'); 
include_once ("./view/header-site.php");
$listdanhmuc = loadall_danhmuc_trangchu();
$listdanhmuc_all = loai_select_all();
$newProductList = san_pham_select_moi_nhat();
$topViewProductList = san_pham_top();
if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {

    }
}
else {
    include_once ("./view/homepage.php");
}
include_once ('view/footer-site.php')
?>