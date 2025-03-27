<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use Framework\Viewer;

class Admins
{
  public function index()
  {
    $model = new Order();
    $orderStats = $model->getMonthlyOrderStatistics();
    $viewer = new Viewer();
    echo $viewer->render('admin.php', [
      'orderStats' => $orderStats,
    ]);
  }

  public function adminUser()
  {
    $model = new User();
    $data['user'] = $model->getAll();
    $viewer = new Viewer();
    echo $viewer->render("admin-user.php", $data);
  }

  public function addUser()
  {
    $this->requireAdmin(); // Kiểm tra quyền admin

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = trim($_POST['username']);
      $password = $_POST['password'];
      $email = trim($_POST['email']);
      $sdt = trim($_POST['sdt']);
      $vaitro = $_POST['vaitro'] ?? 'user';

      // Kiểm tra đầu vào
      if (empty($username) || empty($password) || empty($email) || empty($sdt)) {
        $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin.";
      }

      $model = new User();

      // Kiểm tra username hoặc email đã tồn tại
      if ($this->isUserExists($model, $username, $email)) {
        $_SESSION['error'] = "Tên người dùng hoặc email đã tồn tại.";
      }

      // Thêm người dùng mới
      if ($this->createUser($model, $username, $password, $email, $sdt, $vaitro)) {
        $_SESSION['success'] = "Thêm người dùng thành công!";
      } else {
        $_SESSION['error'] = "Thêm người dùng thành công!";
      }

      header("Location: /web2-php/admin-user");
      exit();
    }

    $model = new User();
    $data['vaitro'] = $model->getRoles();
    $viewer = new Viewer();
    echo $viewer->render("admin-add-user.php", $data);
  }


  // ✅ Kiểm tra quyền admin
  private function requireAdmin()
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['vaitro'] !== 'admin') {
      die("Bạn không có quyền thêm người dùng.");
    }
  }

  // ✅ Kiểm tra user đã tồn tại hay chưa
  private function isUserExists($model, $username, $email)
  {
    return $model->exists('username', $username) || $model->exists('email', $email);
  }

  // ✅ Tạo user mới
  private function createUser($model, $username, $password, $email, $sdt, $vaitro)
  {
    return $model->adminCreate(
      $username,
      $password,
      $email,
      $sdt,
      $vaitro
    );
  }


  public function editAdminUser($id)
  {
    $this->requireAdmin(); // Kiểm tra quyền admin

    $model = new User();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Lấy dữ liệu từ form
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      $email = trim($_POST['email']);
      $sdt = trim($_POST['sdt']);
      $vaitro = $_POST['vaitro'] ?? 'user';

      // Kiểm tra đầu vào
      if (empty($username) || empty($email) || empty($sdt)) {
        $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin.";
        header("Location: /web2-php/admin-edit-user/$id");
        exit();
      }

      // Cập nhật thông tin user
      if ($model->updateUser($id, $username, $password, $email, $sdt, $vaitro)) {
        $_SESSION['success'] = "Cập nhật thông tin thành công!";
      } else {
        $_SESSION['error'] = "Cập nhật thất bại!";
      }

      header("Location: /web2-php/admin-user");
      exit();
    }

    // Lấy thông tin user để hiển thị trong form
    $data['edituser'] = $model->find($id);
    $viewer = new Viewer();
    echo $viewer->render("admin-edit-user.php", $data);
  }

  public function deleteU($id)
  {


    $model = new User();

    if ($model->deleteUser($id)) {
      $_SESSION['success'] = "Xóa người dùng thành công!";
    } else {
      $_SESSION['error'] = "Xóa người dùng thất bại!";
    }

    header("Location: /web2-php/admin-user");
    exit();
  }

  public function adminOrders()
  {
    $model = new Order();
    $data['orders'] = $model->getAllOrders();
    $viewer = new Viewer();
    echo $viewer->render("admin-order.php", $data);
  }

  public function updateOrderStatus($id)
  {
    $this->requireAdmin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $status = $_POST['status'];
      $model = new Order();

      if ($model->updateStatus($id, $status)) {
        $_SESSION['success'] = "Cập nhật trạng thái đơn hàng thành công!";
      } else {
        $_SESSION['error'] = "Cập nhật trạng thái thất bại!";
      }

      header("Location: /web2-php/admin-order");
      exit();
    }
  }

  public function confirmOrder($id)
  {
    $this->requireAdmin(); // Kiểm tra quyền admin

    $model = new Order();
    if ($model->updateStatus($id, 'da-duyet')) {
      $_SESSION['success'] = "Đơn hàng đã được duyệt!";
    } else {
      $_SESSION['error'] = "Duyệt đơn hàng thất bại!";
    }

    header("Location: /web2-php/admin-order");
    exit();
  }

  public function cancelOrder($id)
  {
    $this->requireAdmin(); // Kiểm tra quyền admin

    $model = new Order();
    if ($model->updateStatus($id, 'Đơn bị hủy')) {
      $_SESSION['success'] = "Đơn hàng đã bị hủy!";
    } else {
      $_SESSION['error'] = "Hủy đơn hàng thất bại!";
    }

    header("Location: /web2-php/admin-order");
    exit();
  }
  public function adminOrderDetail($id)
  {
    $this->requireAdmin(); // Kiểm tra quyền admin

    $model = new Order();
    $data['order'] = $model->getOrderById($id); // Lấy đơn hàng theo ID
    $data['order_items'] = $model->getOrderItems($id); // Lấy sản phẩm trong đơn hàng
    $data['orderDetail'] = $model->getOrderOneDetail($id);
    if (!$data['order']) { // Nếu không tìm thấy đơn hàng
      $_SESSION['error'] = "Không tìm thấy đơn hàng!";
      header("Location: /web2-php/admin-order");
      exit();
    }

    $viewer = new Viewer();
    echo $viewer->render("admin-order-detail.php", $data);
  }
}
