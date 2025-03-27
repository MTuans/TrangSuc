<div class="container mt-5" style="padding:40px;">
    <h1 class="text-center">Thêm sản phẩm</h1>
    <form action="/web2-php/admin-add-pro" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="id_dm" class="form-label">Danh mục</label>
            <select
                class="form-select"
                aria-label="Default select example" id="id_dm" name="id_dm">
                <?php foreach ($categories as $dm): ?>
                    <option value="<?= $dm['id'] ?>">
                        <?= ($dm['tendm']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="ten" class="form-label">Tên sản phẩm</label>
            <input

                type="text"
                class="form-control"
                id="ten"
                name="ten" required />
        </div>
        <div class="mb-3">
            <label for="gia" class="form-label">Giá sản phẩm</label>
            <input

                type="number"
                class="form-control"
                id="gia"
                name="gia" required />
        </div>
        <div class="mb-3">
            <label for="mota" class="form-label">Mô tả</label>
            <input
                type="text"
                class="form-control"
                id="mota"
                name="mota" required />
        </div>
        <div class="mb-3">
            <label for="hinh" class="form-label">Hình của sản phẩm</label>
            <input
                type="file"
                class="form-control"
                id="hinh"
                name="hinh" required />
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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