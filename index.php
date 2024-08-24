<?php
include_once("./model/pdo.php");
include_once("./global.php");
include_once('./model/san-pham.php');
include_once('./model/loai.php');
include_once('./model/tai-khoan.php');
include_once('./model/detail-san-pham.php');
include_once("./view/header-site.php");
$listdanhmuc = loadall_danhmuc_trangchu();
$listdanhmuc_all = loai_select_all();
$newProductList = san_pham_select_moi_nhat();
$topViewProductList = san_pham_top();
if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        case 'product-detail':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_san_pham = $_GET['id'];
                $productDetail = load_san_pham_id($id_san_pham);
                if ($productDetail) {
                    extract($productDetail);
                    $categoryDetail = loai_select_by_id($id_danh_muc); // Sửa tham số truyền vào từ $id thành $iddm
                    $productRelated = san_pham_lien_quan($id_san_pham, $id_danh_muc);

                    $chi_tiet_san_pham = select_chi_tiet_san_pham($id_san_pham);
                    // $list_comment = comment_select_all($id);
                    include("view/san-pham//product-detail.php");
                } else {
                    include("view/homepage.php");
                }
            } else {
                include("view/homepage.php");
            }
            break;
        case 'login':
            $kiem_tra_tai_khoan ="";
            if(isset($_POST['dangnhap']) && $_POST['dangnhap']){
                $ten_dang_nhap = $_POST['ten_dang_nhap'];
                $mat_khau  =$_POST['mat_khau'];
                $thongbao_user = ""; // Khởi tạo thông báo lỗi cho tên người dùng
                $thongbao_pass = "";
                if (empty($ten_dang_nhap)) {
                    $thongbao_user = "Tên người dùng không được bỏ trống!";
                }
                // Kiểm tra trường mật khẩu
                if (empty($mat_khau)) {
                    $thongbao_pass = "Mật khẩu không được bỏ trống";
                } elseif (strlen($mat_khau) < 6) {
                    $thongbao_pass = "Mật khẩu phải chứa ít nhất 6 ký tự";
                }
                // Nếu cả hai trường đều không rỗng, tiến hành kiểm tra người dùng
                if (!empty($ten_dang_nhap) && !empty($mat_khau) && strlen($mat_khau) >= 6) {
                    // Tiếp tục kiểm tra người dùng
                    // Đặt mã kiểm tra người dùng ở đây
                    $checkuser = checkuser($ten_dang_nhap, $mat_khau);
                    if (is_array($checkuser)) {
                        $_SESSION['login'] = $checkuser;
                        extract($_SESSION['login']);
                        if($kich_hoat == 0){
                            $thongbao = "Đăng nhập thất bại .Tài khoản của bạn đã bị khóa";
                        } else{
                            header('Location: index.php');
                            exit;
                        }
                        
                    } else {
                        $thongbao = "Đăng nhập thất bại. Vui lòng kiểm tra lại hoặc điền email đăng ký để lấy lại mật khẩu!";
                    }
                }
            }
            include ('./view/auth/login.php');
            break;
            case 'register':
                if (isset($_POST['dangky']) && ($_POST['dangky'])) {
                    $email = $_POST['email'];
                    $ten_dang_nhap = $_POST['ten_dang_nhap'];
                    $mat_khau = $_POST['mat_khau'];
                    $ho_ten = $_POST['ho_ten'];
                    $thongbao_user = ""; // Khởi tạo thông báo lỗi cho tên người dùng
                    $thongbao_pass = ""; // Khởi tạo thông báo lỗi cho mật khẩu
                    $thongbao_email = ""; // Khởi tạo thông báo lỗi cho mật khẩu
                    $thongbao_ho_ten ="";
                    if (empty($ho_ten)) {
                        $thongbao_ho_ten = "Họ tên không được bỏ trống!";
                    }
                    if (empty($ten_dang_nhap)) {
                        $thongbao_user = "Tên người dùng không được bỏ trống!";
                    } else {
                        $user_exists = kiem_tra_nguoi_dung_ton_tai($ten_dang_nhap);
                        if ($user_exists) {
                            $thongbao_user = "Tên người dùng đã tồn tại!";
                        }
                    }
                    if (empty($mat_khau) || strlen($mat_khau) < 6) {
                        $thongbao_pass = "Mật khẩu không được bỏ trống và >= 6 kí tự!";
                    }
                    if (empty($email)) {
                        $thongbao_email .= "Vui lòng nhập email!";
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $thongbao_email .= "Email không hợp lệ!";
                    }
                    if (!empty($ten_dang_nhap) && !empty($mat_khau) && strlen($mat_khau) >= 6 && !empty($email) && !$user_exists) {
                        insert_tai_khoan($ho_ten,$ten_dang_nhap,$mat_khau,$email);
                        $thongbao = "Đã đăng ký thành công. Vui lòng đăng nhập!";
                    }
                }
    
                include "view/auth/register.php";
                break;
        case 'form_account':
            include("view/auth/form_account.php");
            break;
        case 'logout':
                session_unset();
                header('Location: index.php');
                include "view/auth/login.php";
                break;
    }
} else {
    include_once("./view/homepage.php");
}
include_once('view/footer-site.php')
    ?>