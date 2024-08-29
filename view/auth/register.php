
<div class="container_login">
    <div class="box_login2">
         <div class="title_login">
        <a href="index.php?act=login" class="text-black"><button class="box_dangnhap2">ĐĂNG NHẬP</button></a>
        <a href="index.php?act=register" class="text-black"><button class="box_dangky2">ĐĂNG KÝ </button></a>
            </div>
        <div class="formtaikhoan">
        <form action="index.php?act=register" method="post">
        <input type="text" class="login_user" name="ho_ten" placeholder="Họ và tên" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>"> 
            <?php if (!empty($thongbao_ho_ten)) { ?>
                <span style="color: red;"><?php echo $thongbao_ho_ten; ?></span><br>
            <?php } ?>
            <input type="text" class="login_user" name="ten_dang_nhap" placeholder="Tên đăng nhập" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>"> 
            <?php if (!empty($thongbao_user)) { ?>
                <span style="color: red;"><?php echo $thongbao_user; ?></span><br>
            <?php } ?>
            <input type="password" class="login_user" name="mat_khau" id="" placeholder="Mật khẩu" value="<?php echo isset($_POST['pass']) ? htmlspecialchars($_POST['pass']) : ''; ?>"> 
            <?php if (!empty($thongbao_pass)) { ?>
                <span style="color: red;"><?php echo $thongbao_pass; ?></span><br>
            <?php } ?>
            <input type="email" class="login_user" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"> 
            <?php if (!empty($thongbao_email)) { ?>
                <span style="color: red;"><?php echo $thongbao_email; ?></span><br>
            <?php } ?>
            <input type="submit" class="button_submit" value="ĐĂNG KÝ" name="dangky">
        </form>

       </div>
      
    </div>
    </div>
