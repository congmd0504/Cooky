<?php
session_start();
ob_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
$ngay_nhap_str = '19/08/2024 21:03:02';
include_once("../model/pdo.php");
include_once("../model/loai.php");
include_once("../model/san-pham.php");
include_once("../model/toast-message.php");
include_once("../model/detail-san-pham.php");
include_once("../model/do-an-them.php");
include_once("../model/size.php");
include_once("./view/header.php");
include_once("./view/sidebar.php");
if (isset($_GET['act']) && $_GET['act']) {
    $act = $_GET['act'];
    switch ($act) {
        // Quản lý danh mục start
        case 'adddm':
            if (isset($_POST['add-dm']) && $_POST['add-dm']) {
                $ten_danh_muc = $_POST['ten_danh_muc'];
                $anh_danh_muc = $_FILES['anh_danh_muc']['name'];
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["anh_danh_muc"]["name"]);
                if (move_uploaded_file($_FILES["anh_danh_muc"]["tmp_name"], $target_file)) {
                    loai_insert($ten_danh_muc, $anh_danh_muc);

                }

                showSuccessToast('Bạn đã thêm danh mục sản phẩm thành công!');
            }

            include_once 'view/danh-muc/add.php';
            break;
        case 'listdm':
            $list_danh_muc = loai_select_all();
            include_once 'view/danh-muc/list.php';
            break;
        case 'delete-dm':
            // Xoá 1
            if (isset($_GET['id-dm'])) {
                //   san_pham_delete_by_danh_muc_none($_GET['id-dm']);
                loai_delete($_GET['id-dm']);
                showSuccessToast('Bạn đã xoá danh mục sản phẩm thành công!');
            }
            // if (isset($_POST['delete-dm'])) {
            //     if (empty($_POST['checkAll'])) {
            //         showErrorToast('Chưa có mục nào được chọn!');
            //     } else {
            //         // san_pham_delete_by_danh_muc_none($_POST['checkAll']);
            //         loai_delete_none($_POST['checkAll']);
            //         showSuccessToast('Bạn đã xoá danh mục sản phẩm thành công!');
            //     }
            // }
            include_once 'view/danh-muc/list.php';
            break;
        // end delete danh mục
        case 'update-dm':
            if (isset($_GET['id-dm'])) {
                $danh_muc_one = loai_select_by_id($_GET['id-dm']);
            }
            if (isset($_POST['update-dm']) && $_POST['update-dm']) {
                $ten_danh_muc = $_POST['ten_danh_muc'];
                $id_danh_muc = $_POST['id_danh_muc'];
                $anh_danh_muc = $_FILES['anh_danh_muc']['name'];
                if (!empty($ten_danh_muc)) {
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($_FILES["anh_danh_muc"]["name"]);
                    if (move_uploaded_file($_FILES["anh_danh_muc"]["tmp_name"], $target_file)) {
                        loai_update($id_danh_muc, $ten_danh_muc, $anh_danh_muc);
                        showSuccessToast('Bạn đã sửa danh mục sản phẩm thành công!');
                        $list_danh_muc = loai_select_all();
                        include_once 'view/danh-muc/list.php';
                    }
                }
            } else
                include_once 'view/danh-muc/update.php';
            break;
        case 'addsp':
            if (isset($_POST['add-sp']) && $_POST['add-sp']) {
                $ten_san_pham = $_POST['ten_san_pham'];
                $price = $_POST['price'];
                $mo_ta = $_POST['mo_ta'];
                $ngay_nhap = date('Y-m-d H:i:s');
                $id_danh_muc = $_POST['id_danh_muc'];
                $hinh_anh = $_FILES['hinh_anh']['name'];
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["hinh_anh"]["name"]);
                if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file)) {
                    them_moi_san_pham($ten_san_pham, $price, $mo_ta, $hinh_anh, 0, $ngay_nhap, $id_danh_muc);
                }

                showSuccessToast('Bạn đã thêm sản phẩm thành công!');
            }

            include_once 'view/san-pham/add.php';
            break;
        case 'listsp':
            $list_san_pham = loadall_san_pham();
            include_once 'view/san-pham/list.php';
            break;
        case 'delete-sp':
            if (isset($_GET['id-sp'])) {
                // echo $_GET['id-sp'];
                xoa_san_pham($_GET['id-sp']);
                showSuccessToast('Bạn đã xoá sản phẩm thành công!');
            }
            $list_san_pham = loadall_san_pham();
            include_once 'view/san-pham/list.php';
            break;
        case 'update-sp':
            if (isset($_GET['id-sp'])) {
                $san_pham = load_san_pham_id($_GET['id-sp']);
            }
            if (isset($_POST['update-sp']) && $_POST['update-sp']) {
                $id_san_pham = $_POST['id_san_pham'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $price = $_POST['price'];
                $mo_ta = $_POST['mo_ta'];
                $id_danh_muc = $_POST['id_danh_muc'];
                $hinh_anh = $_FILES['hinh_anh']['name'];
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["hinh_anh"]["name"]);
                move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file);
                update_san_pham($id_san_pham,$ten_san_pham,$price,$mo_ta,$hinh_anh,$id_danh_muc);
                showSuccessToast('Bạn đã cập nhập sản phẩm thành công!');
                $list_san_pham = loadall_san_pham();
                include_once 'view/san-pham/list.php';
            } else
                include_once 'view/san-pham/update.php';
            break;
        case 'add-detail-sp':
            if(isset($_POST['add-detail-sp']) && $_POST['add-detail-sp']){
                $id_san_pham = $_POST['id_san_pham'];
                $so_luong = $_POST['so_luong'];
                $id_size = $_POST['id_size'];
                $id_do_an_them = $_POST['id_do_an_them'];
                $ngay_nhap = date('Y-m-d');
                insert_chi_tiet_sp($so_luong,$ngay_nhap,$id_san_pham,$id_size,$id_do_an_them);
                showSuccessToast('Bạn đã thêm mới thành công!');
            }
            $list_san_pham = loadall_san_pham();
            $list_size= loadall_size();
            $list_do_an_them= loadall_do_an_them();
            include_once 'view/san-pham/add-detail.php';
            break;
    }
}

include("./view/footer.php");

?>