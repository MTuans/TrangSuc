<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;

use Framework\Viewer;

class Products
{
  public function index($id = null)
  {
    $model = new Product();
    $modelDM = new Category();

    // Lấy danh sách sản phẩm dựa theo danh mục (nếu có)
    $data['product'] = ($id !== null) ? $model->getProductsByCategory($id) : $model->findAll();

    $data['danhmuc'] = $modelDM->getDM();

    $viewer = new Viewer();
    echo $viewer->render('page-product.php', $data);
  }


  public function search()
  {
    $model = new Product();
    $modelDM = new Category();

    // Lấy từ khóa tìm kiếm từ query string, loại bỏ khoảng trắng
    $keyword = trim($_GET['search'] ?? '');

    // Kiểm tra nếu có từ khóa tìm kiếm
    if (!empty($keyword)) {
      // Truy vấn danh sách sản phẩm theo từ khóa
      $data['product'] = $model->searchByName($keyword);
    } else {
      $data['product'] = [];
    }

    // Lấy danh mục sản phẩm
    $data['danhmuc'] = $modelDM->getDM();

    // Render view
    $viewer = new Viewer();
    echo $viewer->render('page-product.php', $data);
  }




  public function detail($id)
  {
    $model = new Product();
    $data['detail'] = $model->find($id);

    $data['relate'] = $model->getProRelate($id);
    $viewer = new Viewer();
    echo $viewer->render('page-detail.php', $data);
  }

  public function adminPro()
  {
    $model = new Product();
    $data['product'] = $model->getAllProducts();
    $viewer = new Viewer();
    echo $viewer->render("admin-pro.php", $data);
  }
  public function adminAddPro()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $ten = trim($_POST['ten']);
      $gia = trim($_POST['gia']);
      $mota = trim($_POST['mota']);
      $ngaydang = date("Y-m-d");
      $id_dm = trim($_POST['id_dm']);

      // Kiểm tra file upload
      if (isset($_FILES['hinh']) && $_FILES['hinh']['error'] === 0) {
        $targetDir = "public/image/";
        $fileName = basename($_FILES['hinh']['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['hinh']['tmp_name'], $targetFilePath)) {
          $hinh = $fileName;
        } else {
          $_SESSION['error'] = "Lỗi khi upload ảnh!";
          header("Location: /web2-php/admin-add-pro");
          exit();
        }
      } else {
        $hinh = "";
      }

      $model = new Product();
      $success = $model->createP($ten, $hinh, $gia, $mota, $ngaydang, $id_dm);

      if ($success) {
        $_SESSION['success'] = "Thêm sản phẩm thành công!";
      } else {
      }


      header("Location: /web2-php/admin-pro");
      exit();
    }

    $cateModel = new Category();
    $data['categories'] = $cateModel->getDM();

    $viewer = new Viewer();
    echo $viewer->render("admin-add-pro.php", $data);
  }

  public function adminEditPro($id)
  {
    $model = new Product();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Lấy dữ liệu từ form
      $ten = trim($_POST['ten']);
      $gia = trim($_POST['gia']);
      $mota = trim($_POST['mota']);
      $ngaydang = date("Y-m-d");
      $id_dm = trim($_POST['id_dm']);

      // Kiểm tra xem có upload ảnh mới không
      if (isset($_FILES['hinh']) && $_FILES['hinh']['error'] === 0) {
        $targetDir = "public/image/";
        $fileName = basename($_FILES['hinh']['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['hinh']['tmp_name'], $targetFilePath)) {
          $hinh = $fileName; // Lưu tên file vào DB
        } else {
          $_SESSION['error'] = "Lỗi khi upload ảnh!";
          header("Location: /web2-php/admin-edit-pro/$id");
          exit();
        }
      } else {
        // Nếu không có ảnh mới, giữ nguyên ảnh cũ
        $oldProduct = $model->find($id);
        $hinh = $oldProduct['hinh'];
      }

      // Cập nhật sản phẩm
      if ($model->updatePro($id, $ten, $hinh, $gia, $mota, $ngaydang, $id_dm)) {
        $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
      } else {
        $_SESSION['error'] = "Cập nhật sản phẩm thất bại!";
      }

      header("Location: /web2-php/admin-pro");
      exit();
    }

    // Lấy thông tin sản phẩm để hiển thị trong form
    $data['editproduct'] = $model->find($id);

    // Lấy danh sách danh mục để chọn
    $cateModel = new Category();
    $data['categories'] = $cateModel->getDM();

    $viewer = new Viewer();
    echo $viewer->render("admin-edit-pro.php", $data);
  }


  public function deleteP($id)
  {
    $model = new Product();

    $product = $model->find($id);
    if (!$product) {
      $_SESSION['error'] = "Sản phẩm không tồn tại!";
      header("Location: /web2-php/admin-pro");
      exit();
    }

    $imagePath = "public/image/" . $product['hinh'];
    $success = $model->deleteP($id);

    if ($success) {
      if (file_exists($imagePath)) {
        unlink($imagePath);
      }
      $_SESSION['success'] = "Xóa sản phẩm thành công!";
    } else {
      $_SESSION['error'] = "Xóa sản phẩm thất bại!";
    }

    header("Location: /web2-php/admin-pro");
    exit();
  }
}
