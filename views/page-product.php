<!-- <section class="container-slider">
    <div class="mySlides">
        <img src="/web2-php/public/image/banner2.png" style="width:100%">
    </div>

    <div class="mySlides">
        <img src="/web2-php/public/image/banner3.png"
            style="width:100%">
    </div>
    <br>
    <div style="text-align:center">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>


</section> -->
<!-- <script>
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
        setTimeout(showSlides, 2000); // Change image every 2 seconds
    }
</script> -->

<div class="container-danhmuc">
    <div class="danhmuc">
        <h2>Danh Mục</h2>
        <ul>
            <?php foreach ($danhmuc as $dm): ?>
                <li>
                    <a href="/web2-php/trang-suc/danh-muc/<?= $dm['id'] ?>"><?= $dm['tendm'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="containerr">

    <?php foreach ($product as $sp): ?>
        <div id="products">
            <a href="/web2-php/trang-suc/chi-tiet/<?= $sp['id'] ?>">
                <img src="/web2-php/public/image/<?= $sp['hinh'] ?>" alt="" width="150px" height="170px">
            </a>
            <div class="name"><?= $sp['ten'] ?></div>
            <div class="price"><?= number_format($sp['gia'], 0, ',', '.') ?>₫</div>
            <a href="/web2-php/gio-hang/add/<?= $sp['id'] ?>">
                <button id="btn">Thêm giỏ hàng</button>
            </a>
        </div>
    <?php endforeach; ?>


</div>