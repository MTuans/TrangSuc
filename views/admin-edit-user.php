<div class="container mt-5" style="padding:40px;">
    <h1 class="text-center">Cập nhật người dùng</h1>
    <form action="/web2-php/admin-edit-user/<?= $edituser['id']  ?>" method="POST">
        <div class="mb-3">
            <label for="vaitro" class="form-label">Vai trò</label>
            <select
                class="form-select"
                aria-label="Default select example" name="vaitro" id="vaitro">
                <?php foreach (['user', 'admin'] as $role): ?>
                    <option value="<?= $role ?>" <?= $edituser['vaitro'] === $role ? 'selected' : '' ?>><?= ucfirst($role) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input
                value="<?= $edituser['username'] ?>"
                type="text"
                class="form-control"
                id="username"
                name="username" required
                placeholder="Nhập tên đăng nhập" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                value="<?= $edituser['password'] ?>"
                type="password"
                class="form-control"
                id="password"
                name="password" required
                placeholder="Nhập mật khẩu" />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                value="<?= $edituser['email'] ?>"
                type="email"
                class="form-control"
                id="email"
                name="email" required
                placeholder="Nhập email" />
        </div>
        <div class="mb-3">
            <label for="sdt" class="form-label">Phone</label>
            <input
                value="<?= $edituser['sdt'] ?>"
                type="number"
                class="form-control"
                id="sdt"
                name="sdt" required
                placeholder="Nhập số điện thoại" />
        </div>
        <button type="submit" class="btn btn-primary" style="float:right;">Cập nhật sản phẩm</button>
    </form>
</div>
<?php if (isset($_SESSION['success'])): ?>
    <script>
        alert("<?= $_SESSION['success'] ?>");
    </script>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <script>
        alert("<?= $_SESSION['error'] ?>");
    </script>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>