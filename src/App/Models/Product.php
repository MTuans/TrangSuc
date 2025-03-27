<?php

namespace App\Models;

use App\Database;
use Framework\Model;

class Product extends Model
{
    protected $table = "sanpham";

    public function getNewProducts()
    {
        $sql = "SELECT * FROM {$this->table} WHERE ngaydang > ?";
        return $this->database->getAll($sql, '2025-02-01');
    }
    public function getAllProducts()
    {
        return $this->database->getAll("
        SELECT p.*, d.tendm 
        FROM {$this->table} p
        JOIN danhmuc d ON p.id_dm = d.id
    ");
    }
    public function getProRelate($id)
    {
        // Lấy id_dm của sản phẩm hiện tại
        $category = $this->database->getOne(
            "SELECT id_dm FROM {$this->table} WHERE id = ?",
            $id
        );
        // Nếu không tìm thấy sản phẩm, trả về mảng rỗng
        if (!$category || !isset($category['id_dm'])) {
            return [];
        }

        // Lấy danh sách sản phẩm cùng danh mục (trừ chính sản phẩm hiện tại)
        return $this->database->getAll(
            "SELECT * FROM {$this->table} WHERE id_dm = ? AND id <> ?",
            $category['id_dm'],
            $id
        );
    }

    public function getProductsByCategory($id_dm)
    {
        return $this->database->getAll("SELECT * FROM {$this->table} WHERE id_dm = ?", $id_dm);
    }

    public function searchByName($ten)
    {
        $sql = "SELECT * FROM {$this->table} WHERE ten LIKE ?";
        return $this->database->getAll($sql, "%$ten%");
    }








    public function createP($ten, $hinh, $gia, $mota, $ngaydang, $id_dm)
    {
        return $this->database->insert(
            "INSERT INTO {$this->table} (ten, hinh, gia, mota, ngaydang, id_dm) 
            VALUES (?, ?, ?, ?, ?, ?)",
            $ten,
            $hinh,
            $gia,
            $mota,
            $ngaydang,
            $id_dm
        );
    }

    public function updatePro($id, $ten, $hinh, $gia, $mota, $ngaydang, $id_dm)
    {
        return $this->database->update(
            "UPDATE {$this->table} SET ten = ?, hinh = ?, gia = ?, mota = ?, ngaydang = ?, id_dm = ? WHERE id = ?",
            $ten,
            $hinh,
            $gia,
            $mota,
            $ngaydang,
            $id_dm,
            $id
        );
    }


    public function deleteP($id)
    {
        return $this->database->delete("DELETE FROM {$this->table} WHERE id = ?", $id);
    }
    public function findByCategory($id_dm)
    {
        return $this->database->getOne(
            "SELECT * FROM {$this->table} WHERE id_dm = ?",
            $id_dm
        );
    }
}
