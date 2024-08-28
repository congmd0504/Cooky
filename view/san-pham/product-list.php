<!-- Danh sách sản phẩm theo danh mục -->
<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <!-- Category List -->
            <div class="short-link-list">
                <div class="swiper-container swiper-container-pointer-events">
                    <div class="swiper-wrapper">
                        <div class="category-slider category-list-product-page">
                            <?php
                            $selectedCategoryId = isset($_GET['id_danh_muc']) ? $_GET['id_danh_muc'] : null;
                            foreach ($listdanhmuc_all as $danhmuc) {
                                extract($danhmuc);
                                $showImage = !empty($anh_danh_muc) ? $imagePath . $anh_danh_muc : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
                                $linkCategory = "index.php?act=product&category_id=" . $id_danh_muc;
                                $categoryActiveImage = ($id_danh_muc == $selectedCategoryId) ? 'img-fit active' : 'img-fit';
                                $categoryActiveName = ($id_danh_muc == $selectedCategoryId) ? 'label text-ellipsis-two-lines font-weight-bold' : 'label text-ellipsis-two-lines';
                                echo '<div class="category-item category-item-product-page" id="' . $id_danh_muc . '">
                                        <div class="icon">
                                            <a href="' . $linkCategory . '">
                                                <img class="' . $categoryActiveImage . '" src="' . $showImage . '" alt="' . $anh_danh_muc . '">
                                            </a>
                                        </div>
                                        <div class="' . $categoryActiveName . '">' . $ten_danh_muc . '</div>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product List -->
            <div class="group-product-content">
                <div class="title">✨ Thực đơn - <?= $categoryDetail['ten_danh_muc'] ?> ✨&nbsp;<small
                        class="total-product"><b><?= count($productList) ?></b> sản phẩm</small></div>
                <div class="content-product-container">
                    <div class="promotion-box">
                        <?php
                        $productListLength = count($productList);
                        if ($productListLength == 0) {
                            echo '<div class="no-data-image">
                            <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695886519/cooky%20market%20-%20PHP/e2i0tysgmmogurexye75.jpg" width="505px" alt="No data" />
                            </div>';
                        } else {
                            foreach ($productList as $product) {
                                extract($product);
                                $linkProduct = "index.php?act=product-detail&id=" . $id_san_pham;
                                $showImage = !empty($hinh_anh) ? $imagePath . $hinh_anh : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
                                $formatCurrencyPrice = formatCurrency($price);
                                // $formatCurrencyDiscount = formatCurrency($discount);
                                echo '
                                    <div class="product-basic-info">
                                        <a class="link-absolute" title="' . $ten_san_pham . '" href="' . $linkProduct . '"></a>
                                        <div class="cover-box">
                                            <div class="promotion-photo">
                                                <div class="package-default">
                                                    <img src="' . $showImage . '" alt="' . $ten_san_pham . '" loading="lazy" class="img-fit">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="promotion-name two-lines">' . $ten_san_pham . '</div>
                                        <div class="d-flex-center-middle">
                                            <div class="price-action">
                                                <div class="d-flex-align-items-baseline">
                                                <div class="sale-price">' . $formatCurrencyPrice . '</div>';
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
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Món ăn yêu thích theo view -->
            <div class="group-product-content">
                <div class="title">❤️️ Món ăn yêu thích ❤️️</div>
                <div class="content-product-container">
                    <div class="promotion-box">
                        <?php
                        foreach ($topViewProductList as $product) {
                            $linkProduct = "index.php?act=product-detail&id=" . $product['id_san_pham'];
                            $showImage = !empty($product['hinh_anh']) ? $imagePath . $product['hinh_anh'] : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
                            $formatCurrencyPrice = formatCurrency($product['price']);

                            echo '
                                    <div class="product-basic-info">
                                    <a class="link-absolute" title="' . $product['ten_san_pham'] . '" href="' . $linkProduct . '"></a>
                                    <div class="cover-box">
                                        <div class="promotion-photo">
                                            <div class="package-default">
                                                <img src="' . $showImage . '" alt="' . $product['ten_san_pham'] . '" loading="lazy" class="img-fit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="promotion-name two-lines ">' . $product['ten_san_pham'] . '</div>
                                    <div class="product-weight">'.$product['ten_danh_muc'].'</div>
                                    <div class="d-flex justify-content-end">
                                        <div class="price-action">
                                            <div class="d-flex-align-items-baseline">
                                            <div class="sale-price ">' . $formatCurrencyPrice . '</div>';
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