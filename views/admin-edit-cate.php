<div class="container mt-5" style="padding:40px;">
    <h1 class="text-center">Cập nhật danh mục</h1>
    <form action="/web2-php/admin-edit-cate/<?= $editCate['id']  ?>" method="POST">
    <input type="hidden" name="id" value="<?= $editCate['id'] ?>">
        <div class="mb-3">
            <label for="tendm" class="form-label">Tên danh mục</label>
            <input
                value="<?= $editCate['tendm'] ?>"
                type="text"
                class="form-control"
                id="tendm"
                name="tendm" required />
        </div>
        <button type="submit" class="btn btn-primary" style="float:right;">Cập nhật sản phẩm</button>
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