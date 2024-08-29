<?php
include_once("./model/pdo.php");
include_once("./global.php");
include_once('./model/san-pham.php');
include_once('./model/loai.php');
include_once('./model/tai-khoan.php');
include_once('./model/khau-phan.php');
include_once('./model/do-an-them.php');
include_once('./model/detail-san-pham.php');
include_once('./model/binh-luan.php');
include_once('./model/gio-hang.php');
include_once('./model/tai-khoan.php');
include_once("./view/header-site.php");
$listdanhmuc = loadall_danhmuc_trangchu();
$listdanhmuc_all = loai_select_all();
$newProductList = san_pham_select_moi_nhat();
$topViewProductList = san_pham_top();
if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {

        case 'login':
            $kiem_tra_tai_khoan = "";
            if (isset($_POST['dangnhap']) && $_POST['dangnhap']) {
                $ten_dang_nhap = $_POST['ten_dang_nhap'];
                $mat_khau = $_POST['mat_khau'];
                $thongbao_user = ""; // Khởi tạo thông báo lỗi cho tên người dùng
                $thongbao_pass = "";
                if (empty($ten_dang_nhap)) {
                    displayToastrMessageError("Tên người dùng không được bỏ trống!");
                }
                // Kiểm tra trường mật khẩu
                if (empty($mat_khau)) {
                    displayToastrMessageError("Mật khẩu không được bỏ trống");
                } elseif (strlen($mat_khau) < 6) {
                    displayToastrMessageError("Mật khẩu phải chứa ít nhất 6 ký tự!");
                }
                // Nếu cả hai trường đều không rỗng, tiến hành kiểm tra người dùng
                if (!empty($ten_dang_nhap) && !empty($mat_khau) && strlen($mat_khau) >= 6) {
                    // Tiếp tục kiểm tra người dùng
                    // Đặt mã kiểm tra người dùng ở đây
                    $checkuser = checkuser($ten_dang_nhap, $mat_khau);
                    if (is_array($checkuser)) {
                        $_SESSION['login'] = $checkuser;
                        session_set_cookie_params(99999 * 60);
                        extract($_SESSION['login']);
                        if ($kich_hoat == 0) {
                            displayToastrMessageWarning("Đăng nhập thất bại .Tài khoản của bạn đã bị khóa");
                        } else {
                            header('Location: index.php');
                            exit;
                        }

                    } else {
                        displayToastrMessageError("Tên đăng nhập hoặc mật khẩu không chính xác!");
                    }
                }
            }
            include('./view/auth/login.php');
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
                $thongbao_ho_ten = "";
                if (empty($ho_ten)) {
                    displayToastrMessageError("Họ tên không được bỏ trống!");
                }
                if (empty($ten_dang_nhap)) {
                    displayToastrMessageError("Tên người dùng không được bỏ trống!");
                } else {
                    $user_exists = kiem_tra_nguoi_dung_ton_tai($ten_dang_nhap);
                    if ($user_exists) {
                    displayToastrMessageError("Tên người dùng đã tồn tại!");
                    }
                }
                if (empty($mat_khau) || strlen($mat_khau) < 6) {
                    displayToastrMessageError("Mật khẩu không được bỏ trống và >= 6 kí tự!");
                }
                if (empty($email)) {
                    displayToastrMessageError("Vui lòng nhập email!");
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    displayToastrMessageError("Email không hợp lệ!");
                }
                if (!empty($ten_dang_nhap) && !empty($mat_khau) && strlen($mat_khau) >= 6 && !empty($email) && !$user_exists) {
                    insert_tai_khoan($ho_ten, $ten_dang_nhap, $mat_khau, $email);
                    displayToastrMessageSuccess("Đã đăng ký thành công. Vui lòng đăng nhập!");
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
        case 'profile-edit':
            // Validate form profile-edit
            $error = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $ho_ten = $_POST['ho_ten'];
                $email = $_POST['email'];
                $dia_chi = $_POST['dia_chi'];
                $phone = $_POST['phone'];
                // Validate username
                if (empty($ho_ten)) {
                    displayToastrMessageError("Tên người dùng không được để trống");
                }
                // Validate email
                if (empty($email)) {
                    displayToastrMessageError("Email không được để trống");
                } else if (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email)) {
                    displayToastrMessageError(" Vui lòng nhập lại, email không đúng định dạng");
                }
                // Validate address
                if (empty($dia_chi)) {
                    displayToastrMessageError(" Địa chỉ người dùng không được để trống");
                }
                // Validate phone
                if (empty($phone)) {
                    displayToastrMessageError("Số điện thoại không được để trống");
                } else if (!preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $phone)) {
                    displayToastrMessageError("Vui lòng nhập lại, số điện thoại không đúng định dạng");
                }
                if (!$error) {
                    $id_khach_hang = $_POST['id_khach_hang'];
                    $ho_ten = $_POST['ho_ten'];
                    $email = $_POST['email'];
                    $dia_chi = $_POST['dia_chi'];
                    $phone = $_POST['phone'];

                    $hinh_anh = $_FILES['hinh_anh']['name'];
                    $target_dir = "./uploads/";
                    $target_file = $target_dir . basename($_FILES["hinh_anh"]["name"]);
                    move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file);
                    account_update($id_khach_hang, $ho_ten, $email, $phone, $hinh_anh, $dia_chi, );
                    displayToastrMessageSuccess("Cập nhật thông tin thành công");
                    $_SESSION['login'] = taikhoan_select_by_id($id_khach_hang);
                    header('Location: index.php?act=profile-edit');
                    exit;
                }
            }
            include("view/auth/profile-edit.php");
            break;
        case 'product':
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
                if ($category_id == 1) {
                    $categoryDetail['ten_danh_muc'] = 'Tất cả';
                    $productList = san_pham_select_all_no_param();
                    include("view/san-pham/product-list.php");
                } elseif ($category_id > 0) {
                    $categoryDetail = loai_select_by_id($category_id);
                    $productList = hang_hoa_select_all("", $category_id);
                    include("view/san-pham/product-list.php");
                }
            } else {
                include("view/homepage.php");
            }
            break;
        case 'product-detail':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_san_pham = $_GET['id'];
                $productDetail = load_san_pham_id($id_san_pham);
                if ($productDetail) {
                    extract($productDetail);
                    $categoryDetail = loai_select_by_id($id_danh_muc); // Sửa tham số truyền vào từ $id thành $iddm
                    $productRelated = san_pham_lien_quan($id_san_pham, $id_danh_muc);
                    $khau_phan = loadall_khau_phan();
                    $do_an_them = loadall_do_an_them();
                    $chi_tiet_san_pham = select_chi_tiet_san_pham($id_san_pham);
                    // $list_comment = comment_select_all($id);
                    include("view/san-pham/product-detail.php");
                } else {
                    include("view/homepage.php");
                }
            } else {
                include("view/homepage.php");
            }
            break;
        case 'add-comment':
            if (isset($_POST['submit']) && $_POST['submit']) {
                $id_khach_hang = $_POST['id_khach_hang'];
                $id_san_pham = $_POST['id_san_pham'];
                $noi_dung = $_POST['noi_dung'];
                $ngay_binh_luan = date('Y-m-d');
                insert_binh_luan($id_khach_hang, $id_san_pham, $noi_dung, $ngay_binh_luan);
                header("Location: index.php?act=product-detail&id=$id_san_pham");
            }
            // include_once ('view/san-pham/binh-luan-danh-gia.php');
            break;
        case 'search':
            if (isset($_GET['keyword']) && $_GET['keyword'] != "") {
                $key = $_GET['keyword'];
                $productList = product_search_by_keyword($key);
                include('./view/san-pham/search.php');
                break;
            }
            include('./view/homepage.php');
            break;
        case 'add-to-cart':
            if (isset($_POST['add-to-cart']) && $_POST['add-to-cart']) {
                $id_san_pham = $_POST['id_san_pham'];
                $id_khau_phan = $_POST['id_khau_phan'];
                $id_do_an_them = $_POST['id_do_an_them'];

                $check_id = check_id_chi_tiet_san_pham($id_khau_phan, $id_do_an_them);
                if (empty($check_id)) {
                    $thongbao = "error";
                    header("Location: index.php?act=product-detail&id=$id_san_pham&thongbao=" . urlencode($thongbao));
                    exit();
                } else {
                    extract($check_id);
                    $so_luong = 1;
                    insert_gio_hang($id_khach_hang, $id_chi_tiet_san_pham, $so_luong);
                    $thongbao = "success";
                    header("Location: index.php?act=product-detail&id=$id_san_pham&thongbao=" . urlencode($thongbao));
                }
            }
            break;
        case 'view-cart':
            if (!isset($_SESSION['login'])) {
                $thongbao = "Bạn cần đăng nhập để sử dụng chức năng giỏ hàng!";
                include_once 'view/auth/login.php';
            } else
                $id_khach_hang = $_SESSION['login']['id_khach_hang'];
            $gio_hang_all = select_gio_hang_by_id($id_khach_hang);
            include_once 'view/cart/view-cart.php';
            break;
        case 'delete-cart':
            if (isset($_GET['id-cart'])) {
                // Delete 1 item cart
                $id_chi_tiet_san_pham = $_GET['id-cart'];
                delete_gio_hang_by_id($id_chi_tiet_san_pham);
            } else {
                // Delete all cart
                $id_khach_hang =$_SESSION['login']['id_khach_hang'];
                delete_gio_hang_all($id_khach_hang);
            }
            header('Location: index.php?act=view-cart');
            break;
    }
} else {
    include_once("./view/homepage.php");
}
include_once('view/footer-site.php')
    ?>