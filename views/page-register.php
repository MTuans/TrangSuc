<link href="public/css/login.css" rel="stylesheet">

<div class="container-login">
    <h2 class="h2">Đăng Ký Tài Khoản</h2>
    <form class="form-login" action="/web2-php/dang-ky" method="post" onsubmit="return validateForm()">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="sdt">Số điện thoại:</label>
        <input type="text" id="sdt" name="sdt" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Nhập lại mật khẩu:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" value="Đăng Ký">
        <p>Đã có tài khoản? <a href="/web2-php/dang-nhap">Đăng Nhập</a></p>
    </form>
</div>

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;

        if (password !== confirmPassword) {
            alert("Mật khẩu và nhập lại mật khẩu không khớp!");
            return false; 
        }
        return true;
    }
</script>
