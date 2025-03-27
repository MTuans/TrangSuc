<div class="detail-container">
    <!-- Hình ảnh sản phẩm -->
    <?php if ($detail): ?>
        <div class="product-gallery">
            <!-- <div class="thumbnail-list">
                <img src="image1.jpg" class="thumbnail active">
                <img src="image2.jpg" class="thumbnail">
                <img src="image3.jpg" class="thumbnail">
                <img src="image4.jpg" class="thumbnail">
            </div> -->
            <div class="main-image">
                <img src="/web2-php/public/image/<?= $detail['hinh'] ?>" id="mainImage">
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="product-info">
            <!-- <h4 class="highlight">Sustainable Materials</h4> -->
            <h1 class="product-name"><?= $detail['ten'] ?></h1>
            <!-- <p class="product-type">Men's Road Running Shoes</p> -->
            <p class="product-price"><?= number_format($detail['gia'], 0, ',', '.') ?>₫</p>
            <div class="size-section">
                <p class="size-title">Chọn chất liệu</p>
                <div class="size-options">
                    <button class="size-btn">Bạc</button>
                    <button class="size-btn">Vàng</button>
                </div>
            </div>
        <?php endif; ?>
        <a href="/web2-php/gio-hang/add/<?= $detail['id'] ?>">
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
        </a>
        </div>
</div>


<div class="related-products">
    <h2>Bạn có thể thích</h2>
    <div class="related-product-list">
        <?php foreach ($relate as $relate): ?>
            <div class="related-product-item">
                <a href="/web2-php/trang-suc/chi-tiet/<?= $relate['id'] ?>">
                    <img src="/web2-php/public/image/<?= $relate['hinh'] ?>" alt="<?= $relate['ten'] ?>">
                </a>
                <h3><?= $relate['ten'] ?></h3>
                <p class="related-price"><?= number_format($relate['gia'], 0, ',', '.') ?>₫</p>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<script src="public/js/script.js"></script>