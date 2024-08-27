<?php 

// print_r($_SESSION['login']);
$list_binh_luan = select_binh_luan($_GET['id']);
// print_r($list_binh_luan);
?>
<div class="border border-secondary-subtle p-4">
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
        role="tab" aria-controls="nav-home" aria-selected="true">
        <span class="fs-5 fw-medium">Bình luận</span>
      </button>
      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
        role="tab" aria-controls="nav-profile" aria-selected="false">
        <span class="fs-5 fw-medium">Đánh giá</span>
      </button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <!-- Tab Bình luận -->
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <?php if(isset($_SESSION['login']) && $_SESSION['login']) :
      extract($_SESSION['login']);
      $logo = !empty($hinh_anh) ? $imagePath . $hinh_anh : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
?>
      <form action="index.php?act=add-comment" method="post">
      <div class="mt-4 mb-5 d-flex justify-content-between">
        <img src="<?=$logo?>" alt="<?=$ho_ten?>" name="hinh_anh" class="rounded-circle" height="45px">
        <input type="hidden" name="id_khach_hang" value="<?=$id_khach_hang?>">
        <input type="hidden" name="id_san_pham" value="<?=$_GET['id']?>">
          <input type="text" class="form-control ms-2" name="noi_dung" placeholder="Viết bình luận...">
          <input style="width: 100px;" type="submit" name="submit" class="btn btn-info ms-2"></input>
        </form>
        <?php else: ?>
          <div class="no-login"><i class="fa-solid fa-circle-exclamation"></i> Vui lòng <a href="index.php?act=login">đăng nhập</a> để bình luận!</div>
          <?php endif ?>
      </div>
      <?php foreach($list_binh_luan as $binh_luan) : 
        ?>
      <div class="d-flex">
        <?php 
        $logo_user = $imagePath.$binh_luan['hinh_anh'];
        ?>
        <img src="<?=$logo_user?>" alt="<?=$binh_luan['ho_ten']?>" class="rounded-circle" height="45px">
        <div class="ms-2">
          <span class="fw-semibold"><?=$binh_luan['ho_ten']?></span><br>
          <p><?=$binh_luan['noi_dung']?></p>
          <p class="text-muted" style="font-size:10px; margin-top:-6px;"><?=$binh_luan['ngay_binh_luan']?></p>
        </div>
      </div>
      <hr class="text-secondary" style="margin-top:3px;">
        <?php endforeach; ?>
      
    <!-- Tab Đánh giá -->
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="review_address_inner mt-30">
        <div class="pro_review">
          <div class="review_thumb">
            <img src="./assets/images/logo/sri9li0oetshdwb4esa4.jpg" alt="name" class="rounded-circle" height="45px">
          </div>
          <div class="review_details ms-2">
            <div class="review_info mb-10">
              <h6>Mai Anh</h6>
              <ul class="product-rating d-flex" style="font-size: 10px;">
                <li><i class="fa fa-star"></i></li>
              </ul>
              <p class="text-muted" style="font-size:10px;">2023-07-10</p>
            </div>
            <p>Đẹp</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
