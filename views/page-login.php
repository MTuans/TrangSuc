<link href="public/css/login.css" rel="stylesheet">

<div class="container-login">
    <h2 class="h2">Đăng Nhập</h2>


    <form class="form-login" action="/web2-php/dang-nhap" method="post">

        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Đăng nhập">

        <p>Chưa có tài khoản? <a href="/web2-php/dang-ky">Đăng Ký</a></p>

        <?php if (isset($errorMessage)) { ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php } ?>
    </form>
</div>