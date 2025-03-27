<?php

namespace App\Models;

use App\Database;
use Framework\Model;

class Category extends Model
{
  protected $table = "danhmuc";

  public function getDM()
  {
    return $this->findAll();
  }
  // public function getOneDM($id)
  // {
  //   $sql = "SELECT * FROM products WHERE id_dm = ?";
  //   return $this->database->getAll($sql, $id);
  // }
  // public function getOneDM($id)
  //   {
  //       return $this->find($id); // Lấy danh mục theo ID
  //   }
  public function getOneDM($id)
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = id_dm";
    $result = $this->database->getAll($sql, $id);

    if (!$result) {
      return [];
    }
    return $result;
  }
  public function createC($tendm)
  {
    return $this->database->insert("INSERT INTO {$this->table} (tendm) VALUES (?)", $tendm,);
  }
  public function updateCate($id, $tendm)
  {
    return $this->database->update(
      "UPDATE {$this->table} SET tendm = ? WHERE id = ?",
      $tendm,$id
    );
  }

  public function deleteC($id)
  {
    return $this->database->delete("DELETE FROM {$this->table} WHERE id = ?", $id);
  }
}
