<div class="container mt-5" style="padding:40px;">
    <h1 class="text-center">Thêm danh mục</h1>
    <form action="/web2-php/admin-add-cate" method="POST">
        <!-- <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Vai trò</label>
            <select
                class="form-select"
                aria-label="Default select example">
                    <option>
                    </option>
            </select>
        </div> -->
        <div class="mb-3">
            <label for="tendm" class="form-label">Tên danh mục</label>
            <input
                type="text"
                class="form-control"
                id="tendm"
                name="tendm" required />
        </div>
        <button type="submit" class="btn btn-primary" style="float:right;">Thêm sản phẩm</button>
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