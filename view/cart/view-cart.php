<?php
// print_r($gio_hang_all);
?>
<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <?php if (isset($gio_hang_all) && !empty($gio_hang_all)) { ?>
                <div class="title">🧡 Giỏ hàng của bạn 🧡</div>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên món</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tạm tính</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $totalAllCart = 0;
                        $totalPayPriceOriginal = 0;
                        $formatTotalAllCart = 0;
                        $tong = 0;

                        // Mảng lưu trữ tên sản phẩm đã hiển thị
                        $displayedProducts = [];

                        foreach ($gio_hang_all as $gio_hang) {
                            extract($gio_hang);
                            
                            // Kiểm tra xem sản phẩm đã được hiển thị hay chưa
                            if (array_key_exists($ten_san_pham, $displayedProducts)) {
                                // Nếu đã tồn tại, tăng số lượng
                                $displayedProducts[$ten_san_pham]['so_luong'] += $so_luong;
                            } else {
                                // Nếu chưa tồn tại, lưu sản phẩm vào mảng
                                $displayedProducts[$ten_san_pham] = [
                                    'hinh_anh' => $hinh_anh,
                                    'don_gia' => $don_gia,
                                    'so_luong' => $so_luong,
                                    'id_gio_hang' => $id_gio_hang
                                ];
                            }
                        }

                        // Duyệt qua mảng sản phẩm đã được xử lý
                        foreach ($displayedProducts as $ten_san_pham => $product) {
                            $showImage = $imagePath . $product['hinh_anh'];
                            // Format money
                            $formatPrice = formatCurrency($product['don_gia']);
                            $totalPrice = $product['don_gia'] * $product['so_luong'];
                            $formatTotalMoney = formatCurrency($totalPrice);
                            
                            // Tính tổng số tiền
                            $tong += $totalPrice;
                            $formatTotalAllCart = formatCurrency($tong);

                            // Remove item cart
                            $deleteItemCart = '<a href="index.php?act=delete-cart&id-cart=' . $product['id_gio_hang'] . '"><button class="remove-item-cart" value="Xóa khỏi giỏ hàng"><i class="fa-solid fa-trash-can"></i></button></a>';
                            
                            // Hiển thị sản phẩm
                            echo '<tr>
                                <td scope="row">
                                    <img src="' . $showImage . '" alt="Ảnh sản phẩm" width="100" height="100">
                                </td>
                                <td class="product-name"><strong>' . $ten_san_pham . '</strong></td>
                                <td class="price-product">' . $formatPrice . '</td>
                                <td class="quantity-product">' . $product['so_luong'] . '</td>
                                <td>' . $formatTotalMoney . '</td>
                                <td>' . $deleteItemCart . '</td>
                            </tr>';
                        }
                        ?>

                    </tbody>
                </table>
                <div class="shopping-cart-wrapper">
                    <div class="continue-shopping">
                        <a href="index.php?act=home">Tiếp tục mua hàng</a>
                    </div>
                    <div class="clear-cart-all">
                        <a href="index.php?act=delete-cart">Xóa giỏ hàng</a>
                    </div>
                </div>
                <div class="grand-total">
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title">Tổng tiền giỏ hàng</h4>
                    </div>
                    <h4 class="grand-total-title">Tổng cộng: <span><?= $formatTotalAllCart ?></span></h4>
                    <a href="index.php?act=checkout">Đặt hàng</a> ;
                </div>
            <?php } else { ?>
                <div class="no-cart"><img
                        src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1697029851/jbmsxvpg9wpkte8q5ds9.jpg"
                        alt="Hình ảnh giỏ hàng trống">
                    <div class="title">🖤 Giỏ hàng của bạn đang trống 🖤</div>
                    <p>Quay lại <a href="index.php">trang chủ</a> để lựa chọn món ăn</p>
                </div>
            <?php } ?>
        </div>
    </div>
</main>