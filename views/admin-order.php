<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="list-group">
                <a href="/web2-php/admin" class="list-group-item list-group-item-action">Trang chủ</a>
                <a href="/web2-php/admin-pro" class="list-group-item list-group-item-action">Quản lý sản phẩm</a>
                <a href="/web2-php/admin-cate" class="list-group-item list-group-item-action">Quản lý danh mục</a>
                <a href="/web2-php/admin-user" class="list-group-item list-group-item-action">Quản lý người dùng</a>
                <a href="/web2-php/admin-order" class="list-group-item list-group-item-action active">Quản lý đơn hàng</a>
            </div>
        </div>

        <!-- Danh sách đơn hàng -->
        <div class="col-lg-9">
            <table class="table caption-top text-center">
                <caption>
                    <div class="row">
                        <div class="col-md-6">Quản lý đơn hàng</div>
                    </div>
                </caption>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Mã đơn</th>
                        <th scope="col">Người đặt</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <th scope="row">#<?= $order['id'] ?></th>
                            <td><?= $order['ten_nguoidung'] ?></td>
                            <td><?= $order['ngaydat'] ?></td>
                            <td><?= number_format($order['tongtien'], 0, ',', '.') ?>₫</td>
                            <td>
                                <span class="badge 
                                <?php
                                switch ($order['trangthai']) {
                                    case 'Chờ xác nhận':
                                        echo 'text-bg-warning';
                                        break;
                                    case 'Đang giao hàng':
                                        echo 'text-bg-primary';
                                        break;
                                    case 'Giao thành công':
                                        echo 'text-bg-success';
                                        break;
                                    case 'Đơn bị hủy':
                                        echo 'text-bg-danger';
                                        break;
                                    default:
                                        echo 'text-bg-secondary';
                                }
                                ?>">
                                    <?= ucfirst(str_replace('-', ' ', $order['trangthai'])) ?>
                                </span>
                            </td>

                            <td>
                                <div class="btn-group" role="group">
                                    <a href="/web2-php/admin-order-detail/<?= $order['id'] ?>">
                                        <button type="button" class="btn btn-info">Chi tiết</button>
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

<!-- Thông báo -->
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