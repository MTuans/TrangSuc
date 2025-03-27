<?php

namespace App\Models;

use App\Database;
use Framework\Model;

class User extends Model
{
    protected $table = "user";

    // Lấy tất cả người dùng
    public function getAll()
    {
        return $this->database->getAll("SELECT * FROM {$this->table}");
    }

    // Lấy người dùng theo ID
    public function getById($id)
    {
        return $this->database->getOne("SELECT * FROM {$this->table} WHERE id = ?", $id);
    }
    public function getByUsername($username)
    {
        return $this->database->getOne("SELECT * FROM {$this->table} WHERE username = ?", $username);
    }

    // Thêm người dùng mới
    public function create($username, $password, $email, $sdt, $vaitro = 'user')
    {
        return $this->database->insert(
            "INSERT INTO {$this->table} (username, password, email, sdt, vaitro) 
            VALUES (?, ?, ?, ?, ?)",
            $username,
            $password,
            $email,
            $sdt,
            $vaitro
        );
    }

    // Cập nhật thông tin người dùng
    public function updateUser($id, $username, $password, $email, $sdt, $vaitro)
    {
        return $this->database->update(
            "UPDATE {$this->table} SET username = ?, password = ?, email = ?, sdt = ?, vaitro = ? WHERE id = ?",
            $username,
            $password,
            $email,
            $sdt,
            $vaitro,
            $id

        );
    }

    // Xóa người dùng
    public function deleteUser($id)
    {
        return $this->database->delete("DELETE FROM {$this->table} WHERE id = ?", $id);
    }

    // Kiểm tra username có tồn tại không
    public function exists($username, $email)
    {
        return $this->database->getOne("SELECT id FROM {$this->table} WHERE username = ? OR email = ?", $username, $email);
    }

    // Đăng nhập người dùng
    public function login($username, $password)
    {
        return $this->database->getOne("SELECT * FROM {$this->table} WHERE username = ? AND password = ?", $username, $password);
    }
    public function adminCreate($username, $password, $email, $sdt, $vaitro = 'user')
    {
        return $this->database->insert(
            "INSERT INTO {$this->table} (username, password, email, sdt, vaitro) VALUES (?, ?, ?, ?, ?)",
            $username,
            $password,
            $email,
            $sdt,
            $vaitro
        );
    }
    public function getRoles()
    {
        return $this->database->getAll("SELECT DISTINCT vaitro FROM {$this->table}");
    }
}
