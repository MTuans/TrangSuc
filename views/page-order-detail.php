<style>

    /* Khung chứa chi tiết đơn hàng */
    .order-detail-container {
        width: 50%;
        margin: 50px auto;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    /* Tiêu đề */
    .order-detail-container h2 {
        color: orangered;
        margin-bottom: 20px;
        font-size: 26px;
    }

    /* Thông tin đơn hàng */
    .order-detail-container p {
        font-size: 18px;
        margin: 10px 0;
        color: #333;
    }

    .order-detail-container strong {
        color: #555;
    }

    /* Danh sách sản phẩm */
    .order-items {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .order-items th,
    .order-items td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .order-items th {
        background: orange;
        color: white;
    }

    /* Nút quay lại */
    .order-detail-container a {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 20px;
        background: orange;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .order-detail-container a:hover {
        background: orangered;
        transform: scale(1.05);
    }
</style>

<div class="order-detail-container">
    <h2>📝 Chi tiết đơn hàng #<?= $order['id'] ?></h2>
    <p><strong>Ngày đặt:</strong> <?= $order['ngaydat'] ?></p>
    <!-- <p><strong>Tổng tiền:</strong> <?= number_format($order['tongtien']) ?> đ</p> -->
    <p><strong>Trạng thái:</strong> <?= ucfirst(str_replace('-', ' ', $order['trangthai'])) ?></p>

    <h3>📦 Sản phẩm trong đơn hàng</h3>
    <table class="order-items">
        <tr>
            <th>Sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>
        <?php
        $tongTien = 0; // Khởi tạo biến tổng tiền
        ?>
        <?php if (!empty($orderDetail) && is_array($orderDetail)) : ?>
            <?php foreach ($orderDetail as $item) : ?>
                <?php
                $subtotal = $item['soluong'] * $item['gia'];
                $tongTien += $subtotal; // Cộng dồn tổng tiền
                ?>
                <tr>
                    <td><?= $item['ten'] ?></td>
                    <td>
                        <img src="/web2-php/public/image/<?= $item['hinh'] ?>" alt="" width="100" height="100">
                    </td>
                    <td><?= $item['soluong'] ?></td>
                    <td><?= number_format($item['gia']) ?> đ</td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Tổng tiền:</strong></td>
                <td><strong><?= number_format($tongTien) ?> đ</strong></td>
            </tr>
        <?php endif; ?>
    </table>

    <a href="/web2-php/don-hang">⬅ Quay lại danh sách đơn hàng</a>
</div>