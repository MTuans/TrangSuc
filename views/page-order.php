<style>
    /* Định dạng bảng */
    table {
        width: 90%;
        border-collapse: collapse;
        margin: 20px auto;
        /* Căn giữa bảng */
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }


    /* Định dạng hàng tiêu đề */
    th {
        background: orangered;
        color: white;
        padding: 12px;
        text-align: left;
        font-weight: bold;
    }

    /* Định dạng hàng dữ liệu */
    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    /* Hiệu ứng hover */
    tr:hover {
        background: #f1f1f1;
    }

    /* Định dạng cột trạng thái */
    td:nth-child(4) {
        font-weight: bold;
        text-transform: capitalize;
    }

    /* Màu trạng thái */
    td:nth-child(4):contains("đã xác nhận") {
        color: green;
    }

    td:nth-child(4):contains("đơn bị hủy") {
        color: red;
    }

    td:nth-child(4):contains("chờ xác nhận") {
        color: orange;
    }

    /* Định dạng các liên kết */
    a {
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    a:hover {
        opacity: 0.8;
    }

    /* Nút xem */
    a[href*="chi-tiet"] {
        background: #2ecc71;
        color: white;
    }

    /* Nút hủy */
    a[href*="huy"] {
        background: #e74c3c;
        color: white;
    }
</style>

<h2 align="center" style="padding: 20px;">📦 Đơn hàng của bạn</h2>

<?php if (empty($orders)): ?>
    <p>Bạn chưa có đơn hàng nào.</p>
<?php else: ?>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>Mã đơn</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td>#<?= $order['id'] ?></td>
                <td><?= $order['ngaydat'] ?></td>
                <td><?= number_format($order['tongtien']) ?> đ</td>
                <td><?= ucfirst(str_replace('-', ' ', $order['trangthai'])) ?></td>
                <td>
                    <a href="/web2-php/don-hang/chi-tiet/<?= $order['id'] ?>">Xem</a>
                    <?php if ($order['trangthai'] == 'Chờ xác nhận'): ?>
                        <a href="/web2-php/don-hang/huy/<?= $order['id'] ?>">Hủy</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>