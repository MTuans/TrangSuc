<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;

use Framework\Viewer;

class Categorys
{
    public function adminCate()
    {
        $model = new Category();
        $data['cate'] = $model->getDM();
        $viewer = new Viewer();
        echo $viewer->render("admin-cate.php", $data);
    }
    public function adminAddCate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tendm = trim($_POST['tendm']);

            $model = new Category();
            $success = $model->createC($tendm);
            if ($success) {
                $_SESSION['success'] = "Thêm danh mục thành công!";
            } else {
                $_SESSION['error'] = "Thêm danh mục thành công!";
            }

            header("Location: /web2-php/admin-cate");
            exit();
        }
        $viewer = new Viewer();
        echo $viewer->render("admin-add-cate.php");
    }

    public function adminEditCate($id)
    {
        $model = new Category();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tendm = trim($_POST['tendm']);

            if ($model->updateCate($id, $tendm)) {
                $_SESSION['success'] = "Cập nhật danh mục thành công!";
            } else {
                $_SESSION['error'] = "Cập nhật thất bại!";
            }
            header("Location: /web2-php/admin-cate");
            exit();
        }


        $data['editCate'] = $model->find($id);
        $viewer = new Viewer();
        echo $viewer->render("admin-edit-cate.php", $data);
    }

    public function deleteC($id)
    {
        $model = new Category();

        $category = $model->find($id);
        if (!$category) {
            $_SESSION['error'] = "Danh mục không tồn tại!";
            header("Location: /web2-php/admin-cate");
            exit();
        }


        $productModel = new Product();
        $products = $productModel->findByCategory($id);

        if (!empty($products)) {
            $_SESSION['error'] = "Không thể xóa! Danh mục này đang chứa sản phẩm.";
            header("Location: /web2-php/admin-cate");
            exit();
        }

        $success = $model->deleteC($id);

        if ($success) {
            $_SESSION['success'] = "Xóa danh mục thành công!";
        } else {
            $_SESSION['error'] = "Xóa danh mục thất bại!";
        }
        header("Location: /web2-php/admin-cate");
        exit();
    }
}
