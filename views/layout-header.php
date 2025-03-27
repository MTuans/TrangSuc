<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang sức bạc</title>
    <link href="/web2-php/public/css/index.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<?php

if (isset($_SESSION['login_success'])) {
    echo "<script>alert('{$_SESSION['login_success']}');</script>";
    unset($_SESSION['login_success']); // Xóa thông báo sau khi hiển thị
}
if (isset($_SESSION['logout_success'])) {
    echo "<script>alert('{$_SESSION['logout_success']}');</script>";
    unset($_SESSION['logout_success']); // Xóa thông báo sau khi hiển thị
}
?>

<body>
    <nav id="wrapper">
        <div id="header">
            <a href="/web2-php" class="logo">
                <img src="/web2-php/public/image/logo1.png" alt="" width="150" height="120">
            </a>
            <div id="menu">
                <div class="item">
                    <a href="/web2-php">Trang chủ</a>
                </div>
                <div class="item">
                    <a href="/web2-php/trang-suc">Trang Sức</a>
                </div>
                <div class="item">
                    <a href="/web2-php/gioi-thieu">Giới Thiệu</a>
                </div>
                <div class="item">
                    <a href="/web2-php/lien-he">Liên hệ</a>
                </div>
                <div class="icon">
                    <form class="d-flex" role="search" action="/web2-php/trang-suc/tim-kiem" method="GET">
                        <input class="form-control me-2" name="search" placeholder="Tìm kiếm sản phẩm..."
                            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                        <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>

            <div id="actions">
                <div class="icon">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (isset($_SESSION['user']) && is_array($_SESSION['user'])): ?>
                                <?= htmlspecialchars($_SESSION['user']['username'] ?? 'Tài khoản') ?>
                            <?php else: ?>
                                Tài khoản
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['user'])): ?>
                                <li><a class="dropdown-item" href="/web2-php/dang-xuat">Đăng Xuất</a></li>
                                <li><a class="dropdown-item" href="/web2-php/don-hang">Theo dõi đơn hàng</a></li>
                                <?php if ($_SESSION['user']['vaitro'] === 'admin'): ?>
                                    <li><a class="dropdown-item" href="/web2-php/admin">Trang quản trị</a></li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="/web2-php/dang-nhap">Đăng Nhập</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </div>
                <!-- Hiển thị nút đăng xuất nếu người dùng đã đăng nhập -->

                <div class="icon">
                    <a href="/web2-php/gio-hang"><span class="fa-solid fa-cart-shopping" style="color: #000000;"></span></a>
                </div>
            </div>
            <script>
                var elements = document.querySelectorAll(".item");
                elements.forEach(function(element) {
                    element.addEventListener("mouseover", function() {
                        this.style.backgroundColor = "orangered";
                        this.style.transform = "scale(1)";
                        this.style.borderRadius = "15px";
                        this.style.color = "#fff";
                    });
                    element.addEventListener("mouseout", function() {
                        this.style.backgroundColor = "#fff";
                        this.style.transform = "scale(1)";
                        this.style.borderRadius = "15px";
                    });
                });
            </script>

        </div>