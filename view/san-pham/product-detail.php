<?php
// print_r($chi_tiet_san_pham);
extract($productDetail);
$showImage = !empty($hinh_anh) ? $imagePath . $hinh_anh : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
// Làm tròn tiền tiết kiệm
$saveMoney = round($price / 1000);
// formatCurrency
$formatCurrencyPrice = formatCurrency($price);

?>
<main class="page-container">
    <div class="page-wrapper">
        <div class="breadcrumb">
            <ul class="breadcrumb-list">
                <li class="breadcrumb-item"><a href="index.php">Cooky</a></li>
                <li class="breadcrumb-item"><a href="#"><?= $categoryDetail['ten_danh_muc'] ?></a></li>
                <li class="breadcrumb-item"><span><?= $ten_san_pham ?></span></li>
            </ul>
        </div>
        <div class="product-detail-container">
            <div class="product-common">
                <div class="photo-container">
                    <div class="photo-box">
                        <div class="main-photo">
                            <div class="avaBox">
                                <img src="<?= $showImage ?>" width="100%" class="img-fit" loading="lazy" alt="<?= $ten_san_pham ?>">
                            </div>
                        </div>
                        <div class="side">
                            <div class="side-item is-main"><img class="img-fit" src="https://image.cooky.vn/posproduct/g0/24648/s200x200/6b04075b-c514-43dd-8c4c-c1385cff3327.png">
                            </div>
                            <div class="side-item "><img class="img-fit" src="https://image.cooky.vn/posproduct/g0/24648/s200x200/2c3127b3-2ca2-4af6-af3d-cfd9d4a60c34.jpeg">
                            </div>
                            <div class="side-item "><img class="img-fit" src="https://image.cooky.vn/posproduct/g0/24648/s200x200/6ef8efd4-ae4b-4820-9a2d-bed5389c493e.jpeg">
                            </div>
                            <div class="side-item "><img class="img-fit" src="https://image.cooky.vn/posproduct/g0/24648/s200x200/d4484372-9a1e-4c56-868e-9aa53b0945cc.jpeg">
                            </div>
                            <div class="side-item "><img class="img-fit" src="https://image.cooky.vn/posproduct/g0/24648/s200x200/61647cd7-2c1c-4b3b-85e4-eb29aa7d7cfd.jpeg">
                            </div>
                            <div class="side-item "><img class="img-fit" src="https://image.cooky.vn/posproduct/g0/24648/s200x200/97ed220d-d160-43b7-b65d-01fbf65cf6e0.jpeg">
                            </div>
                            <div class="side-item "><img class="img-fit" src="https://image.cooky.vn/posproduct/g0/24648/s200x200/ec17c657-d2e0-4e1a-92c0-caab31494157.jpeg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="package-info">
                    <div class="basic-info-box">
                        <h1 class="name"><?= $ten_san_pham ?></h1>
                        <div class="stat">
                            <div class="type"><?= $categoryDetail['ten_danh_muc'] ?></div>
                            <div class="stat-info"><img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1696156306/cooky%20market%20-%20PHP/ztvphktbwsioothh6lqh.svg" width="20px">&nbsp;&nbsp; 50</div>
                        </div>
                        <div class="price-x">
                            <div class="price ">
                                <?php 
                                echo '
                                    <div>' . $formatCurrencyPrice . '</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="extra-info-box">
                        <div class="display-flex btn-cart-box">
                            <form action="index.php?act=add-to-cart" method="POST">
                                <input type="hidden" name="id_san_pham" value="<?= $id_san_pham ?>" />
                                <input type="hidden" name="ten_san_pham" value="<?= $ten_san_pham ?>" />
                                <input type="hidden" name="price" value="<?= $price ?>" />
                                <input type="hidden" name="hinh_anh" value="<?= $hinh_anh ?>" />
                                
                                <span>Size:</span><br>
                                    <?php foreach ($chi_tiet_san_pham as $value) : ?>
                                        <label >
                                            <input type="radio" name="id_size" value="<?=$value['id_size'] ?>" >
                                            <span><?php echo $value['size'] ?></span>
                                        </label>
                                    <?php endforeach ?> <br>
                                <span>Đồ ăn thêm(chọn 1):</span> <br>
                                <?php foreach ($chi_tiet_san_pham as $value) : ?>
                                    <label >
                                        <input type="radio" name="id_do_an_them" value="<?=$value['id_do_an_them'] ?>"  >
                                        <span><?php echo $value['do_an_them'] ?></span>
                                    </label>
                                <?php endforeach ?> <br>
                                <div style="width: 185%;" class="text-end">
                                    <button type="submit" name="add-to-cart" class="border rounded" style="height:54px ;width: 300px; background-color: #0a8dd8;" >
                                        <span class="text-white"><i class="fa-solid fa-cart-plus pe-2"></i>Thêm vào giỏ</span>
                                    </button>
                                    </div>
                            </form> 
                            <!-- <button class="add-item-wrapper n-btn btn-add-to-cart btn-add-to-collection ">
                                <span class="row-1">
                                    <div class="icon-total-save"><img class="icon" src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1696156375/cooky%20market%20-%20PHP/bccf379ix2tghofzflrk.svg">
                                    </div><span class="text display-block" style="color: rgb(172, 172, 172);">Lưu</span>
                                </span><span class="row-2"></span></button> -->
                        </div>
                        <div class="promo-desc-box"><img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1696156457/cooky%20market%20-%20PHP/n5zycywefbecp4oj3r7b.svg">
                            <div>Ưu đãi áp dụng cho đơn hàng
                                - Người dùng mới
                                - Tối thiểu 300k
                                - Tối đa 1 phần
                                - Nhận hàng từ 6h-20h ngày 30/09/2023 &amp; 01/10/2023</div>
                        </div>
                        <div class="promo popup-promo-app ">
                            <div class="popup-wrapper desc-wrapper">
                                <div class="popup-header"><button class="btn-close-popup"><img src="/React/Images/Icons/close.svg"></button></div>
                                <div class="popup-body">
                                    <div>
                                        <h4>Mô tả ưu đãi</h4>
                                        <div class="desc-content"><span>Ưu đãi áp dụng cho đơn hàng
                                                - Người dùng mới
                                                - Tối thiểu 300k
                                                - Tối đa 1 phần
                                                - Nhận hàng từ 6h-20h ngày 30/09/2023 &amp; 01/09/2023</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="brand-info-box">
                            <div class="brand-info-item">
                                <div class="brand-into-title">Định lượng</div>
                                <div class="brand-into-content"><?= $weight ?>g</div>
                            </div>
                            <div class="brand-info-item" style="position: relative;">
                                <div class="brand-into-title">Thương hiệu</div>
                                <div class="brand-into-content"><a href="https://cooky.vn/brand/ozzy-fresh-123">Ozzy Fresh</a></div>
                            </div>
                            <div class="brand-info-item">
                                <div class="brand-into-title">Xuất xứ</div>
                                <div class="brand-into-content">Việt Nam</div>
                            </div>
                        </div>
                        <div class="overview"><label class="title"><b>Thành phần</b></label>
                            <div class="container">
                                <div class="option"> 1. [Bò Úc] Shortplate Ba Chỉ Bò 250g</div>
                                <div class="option"> 2. Thịt Bò Cắt Mỏng (Nhúng Lẩu)</div>
                                <div class="option"> 3. (Lựa chọn) + Nấm Kim Châm 150g</div>
                                <div class="option"> 4. (Lựa chọn) + Bộ Xào Sa Tế (Hành Tây, Hành Tím, Tỏi Tép, Ớt Chỉ Thiên, Hành Lá, Xốt Xào Sa Tế CookyMADE) 120g</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Comment box -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#comment").load("view/comment-form.php", {
                        id_product: <?= $id ?>,
                        // Convert array to json
                        list_comment: <?= json_encode($list_comment) ?>
                    });
                });
            </script>
            <div id="comment"></div>
            <!-- Product related -->
            <div class="group-product-content">
                <div class="title">Sản phẩm liên quan</div>
                <div class="content-product-container">
                    <div class="promotion-box">
                        <?php
                        foreach ($productRelated as $product) {
                            $linkProduct = "index.php?act=product-detail&id=" . $product['id_san_pham'];
                            $showImageRelated = !empty($product['hinh_anh']) ? $imagePath . $product['hinh_anh'] : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';

                            $formatCurrencyPriceRelated = formatCurrency($product['price']);
                            echo '
                                <div class="product-basic-info">
                                    <a class="link-absolute" title="' .$product['ten_san_pham'] . '" href="' . $linkProduct . '"></a>
                                    <div class="cover-box">
                                        <div class="promotion-photo">
                                            <div class="package-default">
                                                <img src="' . $showImageRelated . '" alt="' . $product['ten_san_pham'] . '" loading="lazy" class="img-fit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="promotion-name two-lines ">' . $product['ten_san_pham'] . '</div>
                                    <div class="product-weight">?</div>
                                    <div class="d-flex justify-content-end">
                                        <div class="price-action">
                                            <div class="d-flex-align-items-baseline">
                                            <div class="sale-price ">' . $formatCurrencyPriceRelated . '</div>';
                            echo '
                                            </div>
                                        </div>
                                        <div class="button-add-to-cart" title="Thêm vào giỏ hàng">
                                            <div>
                                            <i class="fa-solid fa-circle-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>