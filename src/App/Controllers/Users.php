<?php

namespace App\Controllers;

use App\Models\User;
use Framework\Viewer;

class Users
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new User();
  }

  // Đăng ký người dùng mới
  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';
      $email    = $_POST['email'] ?? '';
      $sdt      = $_POST['sdt'] ?? '';

      // Kiểm tra dữ liệu có đầy đủ không
      if (empty($username) || empty($password) || empty($email) || empty($sdt)) {
        echo "Vui lòng nhập đầy đủ thông tin!";
        return;
      }
      // Kiểm tra xem tên đăng nhập hoặc email đã tồn tại chưa
      if ($this->userModel->exists($username, $email)) {
        echo "Tên đăng nhập hoặc email đã tồn tại!";
        return;
      }

      // Thêm người dùng mới vào database
      $this->userModel->create($username, $password, $email, $sdt);

      echo "Đăng ký thành công!";
      header('Location: /web2-php/dang-nhap'); // Chuyển hướng đến trang đăng nhập
      exit;
    }

    // Include view đăng ký
    include_once "./views/page-register.php";
  }


  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $user = $this->userModel->login($username, $password);
      if ($user) {
        $_SESSION['user'] = $user;
        $_SESSION['login_success'] = "Đăng nhập thành công!";

        if ($user['vaitro'] === 'admin') {
          $_SESSION['admin'] = true;
          header('Location: /web2-php/admin');
        } else {
          header('Location: /web2-php/');
        }
        exit();
      } else {
        $errorMessage = "Tên đăng nhập hoặc mật khẩu không đúng!";
        include './views/page-login.php';
      }
    } else {
      include './views/page-login.php';
    }
  }

  public function logout()
  {
    // session_start();
    $_SESSION['logout_success'] = "Đăng xuất thành công!";

    // Xóa session
    session_unset();
    session_destroy();

    // Chuyển hướng người dùng về trang chính
    header("Location: /web2-php/");
    exit();
  }
}
