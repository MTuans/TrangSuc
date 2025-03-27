<?php

namespace App\Models;

use App\Database;
use Framework\Model;

class Cart extends Model
{
    protected $table = "giohang";

    public function addToCart($id_user, $id_sp, $soluong = 1)
    {
        $cartItem = $this->database->getOne("SELECT soluong FROM giohang WHERE id_user = ? AND id_sp = ?", $id_user, $id_sp);

        if ($cartItem) {
            $newSoluong = $cartItem['soluong'] + $soluong;
            $this->database->update("UPDATE giohang SET soluong = ? WHERE id_user = ? AND id_sp = ?", $newSoluong, $id_user, $id_sp);
        } else {
            $this->database->insert("INSERT INTO giohang (id_user, id_sp, soluong) VALUES (?, ?, ?)", $id_user, $id_sp, $soluong);
        }
    }

    public function removeFromCart($id_user, $id_sp)
    {
        $this->database->delete("DELETE FROM giohang WHERE id_user = ? AND id_sp = ?", $id_user, $id_sp);
    }

    public function getCart($id_user)
    {
        return $this->database->getAll("SELECT g.id_sp, p.ten, p.gia, p.hinh, g.soluong 
                                    FROM giohang g
                                    JOIN sanpham p ON g.id_sp = p.id
                                    WHERE g.id_user = ?", $id_user); // Phải là mảng []
    }

    public function getTotalPrice($id_user)
    {
        return $this->database->getOne("SELECT SUM(p.gia * g.soluong) AS total 
                                    FROM giohang g 
                                    JOIN sanpham p ON g.id_sp = p.id 
                                    WHERE g.id_user = ?", $id_user); // Phải truyền mảng []
    }


    public function clearCart($id_user)
    {
        return $this->database->delete("DELETE FROM giohang WHERE id_user = ?", $id_user);
    }
}
