<section class="container-slider">
    <div class="mySlides">
        <img src="./public/image/banner2.png" style="width:100%">
    </div>

    <div class="mySlides">
        <img src="public/image/banner3.png"
            style="width:100%">
    </div>
    <br>
    <div style="text-align:center">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>


</section>
<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 2000);
    }
</script>
<h1 class="heading"> Sản phẩm mới</h1>
<div class="containerr">

    <?php foreach ($productNew as $product): ?>
        <div id="products">
            <a href="/web2-php/trang-suc/chi-tiet/<?= $product['id'] ?>">
                <img src="public/image/<?= $product['hinh'] ?>" alt="" width="150px" height="170px">
            </a>
            <div class="name"><?= $product['ten'] ?></div>
            <div class="price"><?= number_format($product['gia'], 0, ',', '.') ?>₫</div>
            <a href="/web2-php/gio-hang/add/<?= $product['id'] ?>">
                <button id="btn">Thêm giỏ hàng</button>
            </a>
        </div>
    <?php endforeach; ?>


</div>



<div id="kq">
</div>
<script scr="index.php?page=productdetail.js"></script>
<section class="review" id="review">
    <h1 class="heading">Đánh Giá Của Khách Hàng</h1>
    <div class="box-container">
        <div class="box">
            <p>Sản phẩm của shop rất uy tín.
                Thời gian sắp tới mình sẽ ủng hộ shop thêm nhìu sản phẩm khác </p>
            <img src="/web2-php/public/image/kh1.webp" class="user" alt="">
            <h3>Kinh Thành</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>

        </div>
        <div class="box">
            <p>Sản phẩm của shop rất uy tín.
                Thời gian sắp tới mình sẽ ủng hộ shop thêm nhìu sản phẩm khác </p>
            <img src="/web2-php/public/image/kh2.jpg" class="user" alt="">
            <h3>Gia Bảo</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>

        </div>
        <div class="box">
            <p>Sản phẩm của shop rất uy tín.
                Thời gian sắp tới mình sẽ ủng hộ shop thêm nhìu sản phẩm khác </p>
            <img src="/web2-php/public/image/kh3.jpg" class="user" alt="">
            <h3>Viết Triều</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>

        </div>
    </div>
</section>

<section class="blogs" id="blogs">

    <h3 class="heading"> NHẬN XÉT</h3>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <img src="public/image/tintuc.webp" alt="">
            </div>
            <div class="content">
                <a href="#" class="title"></a>
                <span>10+ mẫu dây chuyền mặt thú ngộ nghĩnh, đáng yêu</span>
                <p>Bạn đang tìm kiếm những mẫu dây chuyền mặt thú ngộ nghĩnh ...</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="public/image/tintuc2.webp" alt="">
            </div>
            <div class="content">
                <a href="#" class="title"></a>
                <span>Top dây chuyền bạc mặt đá sang trọng, thời thượng</span>
                <p>Dây chuyền mặt đá sang trọng và thời thượng là những món trang sức ...</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="public/image/tintuc3.webp" alt="">
            </div>
            <div class="content">
                <a href="#" class="title"></a>
                <span>Khuyên vành tai là gì? Bí quyết phối đồ cá tính</span>
                <p>Cơm trắng chính là món ăn, thực phẩm dinh ...</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

    </div>

</section>

<!-- <h1 class="heading">Sản phẩm giảm giá</h1>
        <div class="container">
            
            <?php foreach ($data as $productSale): ?>
           <div id="products">
                <a href="index.php?page=home&id='.$value['id'].'&iddm='.$value['iddm'].'">
                <img src="public/image/<?= $product['hinh'] ?>" alt="" width="150px" height="170px">
                </a>
                <div class="name"><?= $product['ten'] ?></div>
                <div class="price"><?= $product['gia'] ?></div>
                <a href="index.php?page=cart" id="btn">Thêm giỏ hàng</a>
            </div>
            <?php endforeach; ?>

            
        </div> -->