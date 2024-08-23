<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooky Market | Cooky</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon/favicon-96x96.png">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/page-container.css">
    <link rel="stylesheet" href="./assets/css/product-detail.css">
    <link rel="stylesheet" href="./assets/css/checkout.css">
    <link rel="stylesheet" href="./assets/css/profile.css">
    <link rel="stylesheet" href="./assets/css/invoice.css">
    <link rel="stylesheet" href="./assets/css/view-cart.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/comment-form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="app">
        <header class="header">
            <div class="navigation-bar">
                <div class="logo">
                    <a href="./index.php">
                        <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695381181/cooky%20market%20-%20PHP/cva2ntghjzrlryixcojp.svg" alt="Logo Cooky">
                    </a>
                </div>
                <div class="search-input">
                    <img class="icon-search" src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695381877/cooky%20market%20-%20PHP/lieirqymxmairjpyhrwj.svg" alt="Magnifying Glass">
                    <input tabindex="0" type="text" id="search-input" placeholder="Tìm kiếm sản phẩm...">
                </div>
                <div class="user">
                    <a href="index.php?act=dowcooky" style="text-decoration: none;">
                    <div class="download-app-button">
                    Tải App Cooky
                        <div class="phone-hover">
                            <div class="phone-hover-text">
                                <span>- Đặt hàng dễ dàng hơn</span>
                                <span>- Theo dõi chi tiết đơn hàng</span>
                            </div>
                        </div>
                    </div>
                    </a>
                    <button class="cart-icon action n-btn" title="Giỏ hàng">
                        <a href="index.php?act=view-cart"><img class="icon" src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695386172/cooky%20market%20-%20PHP/fcmcexgvocebzmhuntfm.svg" alt="Cart"></a>
                    </button>
                    <div class="phone action n-btn">
                        <a href="tel:19002041">
                            <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695386173/cooky%20market%20-%20PHP/u5u581opcqe1nlesw2bn.svg" alt="Hotline" class="icon">
                            
                        </a>
                    </div>
                    <div class="hotline action view-city">
                        <span class="user-name">Hà Nội</span>
                        <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695387068/cooky%20market%20-%20PHP/ww9hqjdjddhfcrgdiokz.svg" alt="toggle" class="icon toggle">
                    </div>
                    
                    <?php 
                    if(isset($_SESSION['user'])){
                        extract($_SESSION['user']);
                    ?>
                    <div class="hotline action login ">
                            <a style="text-decoration: none; color:white" href="index.php?act=form_account"><img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695381877/cooky%20market%20-%20PHP/wb5pyhdq2alh6cx8ml82.svg" alt="Login" class="icon"><p><?=$user?></p></a>
                        </div>
                    <?php 
                }else{ 
                ?>
                    <div class="hotline action login">
                        <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695381877/cooky%20market%20-%20PHP/wb5pyhdq2alh6cx8ml82.svg" alt="Login" class="icon">
                        <a class="user-name" href="index.php?act=login">Đăng nhập</a>
                    </div>
                    <?php }?>
                </div>
            </div>
        </header>
        
</body>
</html>