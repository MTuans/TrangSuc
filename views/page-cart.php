<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container-cart {
        width: 80%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .cart-table th,
    .cart-table td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .cart-table th {
        background-color: #f4f4f4;
    }

    .cart-table img {
        width: 80px;
        height: auto;
    }

    .cart-total {
        text-align: right;
        margin-top: 20px;
    }

    .cart-total span {
        font-size: 20px;
        font-weight: bold;
    }

    .btn-checkout {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
        border-radius: 5px;
    }

    .btn-checkout:hover {
        background-color: #218838;
    }

    .btn-remove {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-remove:hover {
        background-color: #c82333;
    }
</style>

<body>
    <h1>Giỏ Hàng Của Bạn</h1>

    <div class="container-cart">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng Tiền</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cartItems) && is_array($cartItems)): ?>
                    <?php foreach ($cartItems as $item): ?>
                        <?php $toTalOne = $item['gia'] * $item['soluong']; ?>
                        <tr>
                            <td><img src="public/image/<?= htmlspecialchars($item['hinh']) ?>" alt="Product Image"></td>
                            <td><?= htmlspecialchars($item['ten']) ?></td>
                            <td><?= number_format($item['gia'], 0, ',', '.') ?>₫</td>
                            <td><?= (int)$item['soluong'] ?></td>
                            <td><?= number_format($toTalOne, 0, ',', '.') ?>₫</td>
                            <td>
                                <a href="/web2-php/gio-hang/xoa/<?= (int)$item['id_sp'] ?>" class="btn-remove">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="cart-total">
            <?php if (!empty($cartItems)): ?>
                <p>Tổng Tiền: <span><?= number_format($tongTien, 0, ',', '.') ?>đ</span></p>
                <a href="/web2-php/gio-hang/check-out">
                    <button class="btn-checkout" style="background-color: orangered;">Thanh Toán</button>
                </a>
            <?php endif; ?>
        </div>
    </div>

</body>