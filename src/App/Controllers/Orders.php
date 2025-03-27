<?php

namespace App\Controllers;

use App\Models\Order;
use Framework\Viewer;

class Orders
{
    private $order;
    private $viewer;

    public function __construct()
    {
        $this->order = new Order();
        $this->viewer = new Viewer();
    }

    // Trang danh sách đơn hàng
    public function index()
    {
        $id_user = $_SESSION['user']['id'] ?? null;
        if (!$id_user) {
            header("Location: /web2-php/dang-nhap");
            exit;
        }

        $orders = $this->order->getOrdersByUser($id_user);
        echo $this->viewer->render("page-order.php", ["orders" => $orders]);
    }

    // Trang chi tiết đơn hàng
    public function detail($id)
    {
        $id_user = $_SESSION['user']['id'] ?? null;
        if (!$id_user) {
            header("Location: /web2-php/dang-nhap");
            exit;
        }

        $order = $this->order->getOrderDetail($id);
        $orderDetail = $this->order->getOrderOneDetail($id);

        // Kiểm tra nếu đơn hàng không tồn tại hoặc không thuộc về user hiện tại
        if (!$order || $order['id_user'] != $id_user) {
            die("Bạn không có quyền xem đơn hàng này!");
        }

        echo $this->viewer->render(
            "page-order-detail.php",
            [
                "order" => $order,
                "orderDetail" => $orderDetail
            ]
        );
    }

    // Hủy đơn hàng
    public function cancel($id)
    {
        $id_user = $_SESSION['user']['id'] ?? null;
        if (!$id_user) {
            header("Location: /web2-php/dang-nhap");
            exit;
        }

        $order = $this->order->getOrderDetail($id);

        // Kiểm tra nếu đơn hàng không tồn tại hoặc không thuộc về user hiện tại
        if (!$order || $order['id_user'] != $id_user) {
            die("Bạn không có quyền hủy đơn hàng này!");
        }

        // Hủy đơn hàng
        $this->order->cancelOrder($id);

        // Chuyển hướng về trang danh sách đơn hàng
        header("Location: /web2-php/don-hang?message=Đã hủy đơn hàng thành công!");
        exit;
    }

   
}
