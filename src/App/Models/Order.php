<?php

namespace App\Models;

use App\Database;
use Framework\Model;

class Order extends Model
{
    protected $table = "donhang";

    public function createOrder($id_user, $soluongSP, $tongtien)
    {
        return $this->database->insert(
            "INSERT INTO donhang (id_user, soluongSP, tongtien) VALUES (?, ?, ?)",
            $id_user,
            $soluongSP,
            $tongtien
        );
    }


    public function getOrdersByUser($id_user)
    {
        $sql = "SELECT * FROM donhang WHERE id_user = ? ORDER BY ngaydat DESC";
        return $this->database->getAll($sql, $id_user);
    }

    public function getOrderDetail($id)
    {
        $sql = "SELECT * FROM donhang WHERE id = ?";
        $order = $this->database->getOne($sql, $id);

        if ($order) {
            $order['items'] = $this->getOrderItems($id);
        }

        return $order;
    }

    public function cancelOrder($id)
    {
        $sql = "UPDATE donhang SET trangthai = 'Đơn bị hủy' WHERE id = ?";
        return $this->database->update($sql, $id);
    }
    // Lấy danh sách đơn hàng kèm thông tin người dùng
    public function getAllOrders()
    {
        $sql = "SELECT donhang.*, user.username AS ten_nguoidung
                FROM donhang
                JOIN user ON donhang.id_user = user.id
                ORDER BY donhang.ngaydat DESC";
        return $this->database->getAll($sql);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE donhang SET trangthai = ? WHERE id = ?";
        return $this->database->update($sql, $status, $id);
    }


    public function getOrderById($id)
    {
        $sql = "SELECT donhang.*, user.username AS ten_nguoidung
            FROM donhang
            JOIN user ON donhang.id_user = user.id
            WHERE donhang.id = ?";
        return $this->database->getOne($sql, $id);
    }

    public function getOrderItems($id_order)
    {
        $sql = "SELECT chitietdonhang.*, sanpham.ten, sanpham.gia, sanpham.hinh
            FROM chitietdonhang
            JOIN sanpham ON chitietdonhang.id_sp = sanpham.id
            WHERE chitietdonhang.id_dh = ?";
        return $this->database->getAll($sql, $id_order);
    }
    public function addOrderItem($id_dh, $id_sp, $soluong, $giaban)
    {
        $this->database->insert(
            "INSERT INTO chitietdonhang (id_dh, id_sp, soluong, giaban) VALUES (?, ?, ?, ?)",
            $id_dh,
            $id_sp,
            $soluong,
            $giaban
        );
    }
    public function getOrderOneDetail($id)
    {
        $sql = "
        SELECT chitietdonhang.*, 
               sanpham.ten AS ten, 
               sanpham.gia AS gia,
               sanpham.hinh AS hinh
        FROM chitietdonhang
        JOIN sanpham ON chitietdonhang.id_sp = sanpham.id
        WHERE chitietdonhang.id_dh = ?";

        return $this->database->getAll($sql, $id);
    }
    public function getMonthlyOrderStatistics()
    {
        $sql = "SELECT MONTH(ngaydat) AS thang, COUNT(*) AS so_luong FROM donhang GROUP BY MONTH(ngaydat)";
        return $this->database->getAll($sql);
    }
}
