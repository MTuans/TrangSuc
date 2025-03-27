<div class="container mt-5">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="/web2-php/admin" class="list-group-item list-group-item-action">Trang chủ</a>
                <a href="/web2-php/admin-pro" class="list-group-item list-group-item-action">Quản lý sản phẩm</a>
                <a href="/web2-php/admin-cate" class="list-group-item list-group-item-action">Quản lý danh mục</a>
                <a href="/web2-php/admin-user" class="list-group-item list-group-item-action">Quản lý người dùng</a>
                <a href="/web2-php/admin-order" class="list-group-item list-group-item-action">Quản lý đơn hàng</a>

            </div>
        </div>
        <div class="col-lg-9">
            <table class="table caption-top text-center">

                <caption>
                    <div class="row">
                        <div class="col-md-4"> Quản lý người dùng</div>
                        <div class="col-md-4 offset-md-4">
                            <a href="/web2-php/admin-add-user">
                                <button class="btn btn-primary me-md-2" type="button">
                                    Thêm người dùng
                                </button>
                            </a>
                        </div>
                    </div>
                </caption>
                <thead>
                    <tr class="table-dark">
                        <th scope="col">STT</th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Vai trò</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $user): ?>
                        <tr>
                            <th scope="row"><?= $user['id'] ?></th>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['sdt'] ?></td>
                            <td><?= $user['vaitro'] ?></td>
                            <td>
                                <div
                                    class="btn-group"
                                    role="group"
                                    aria-label="Basic mixed styles example">
                                    <a href="/web2-php/admin-edit-user/<?= $user['id']?>">
                                        <button type="button" class="btn btn-warning">Sửa</button>
                                    </a>
                                    <a href="/web2-php/admin-delete-user/<?= $user['id']?>">
                                        <button type="button" class="btn btn-danger">Xóa</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
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