<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use Framework\Viewer;

class Carts
{
    private $cart;
    private $viewer;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->viewer = new Viewer();
    }
    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            // header("Location: /web2-php/dang-nhap");
            echo "Bạn cần đăng nhập!";
            exit;
        }

        $cartItems = $this->cart->getCart($userId);
        $tongTienResult = $this->cart->getTotalPrice($userId);
        $tongTien = $tongTienResult['total'] ?? 0;
        echo $this->viewer->render("page-cart.php", [
            "cartItems" => $cartItems,
            "tongTien" => $tongTien
        ]);
    }

    public function addToCart($id)
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            header("Location: /web2-php/dang-nhap");
            exit;
        }

        $this->cart->addToCart($userId, $id);
        header("Location: /web2-php/gio-hang");
        exit;
    }

    public function removeFromCart($id)
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            header("Location: /web2-php/dang-nhap");
            exit;
        }

        $this->cart->removeFromCart($userId, $id);
        header("Location: /web2-php/gio-hang");
        exit;
    }
    public function checkout()
    {
        $id_user = $_SESSION['user']['id'] ?? null;
        if (!$id_user) {
            die("Bạn cần đăng nhập để thanh toán.");
        }

        $cartItems = $this->cart->getCart($id_user);
        $tongTien = (float)($this->cart->getTotalPrice($id_user)['total'] ?? 0);
        $tongSoLuong = (int)array_sum(array_column($cartItems, 'soluong'));

        if ($tongTien <= 0 || $tongSoLuong <= 0) {
            die("Giỏ hàng trống, không thể thanh toán!");
        }

        $orderModel = new Order();
        $orderId = $orderModel->createOrder($id_user, $tongSoLuong, $tongTien);

        if (!$orderId) {
            die("Lỗi khi tạo đơn hàng!");
        }

        // Sau khi tạo đơn hàng thành công, thêm chi tiết đơn hàng
        foreach ($cartItems as $item) {
            $orderModel->addOrderItem($orderId, $item['id_sp'], $item['soluong'], $item['gia']);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        $this->cart->clearCart($id_user);
        header("Location: /web2-php/don-hang");
        exit;
    }
}
