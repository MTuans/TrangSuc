<?php

namespace App;

use PDO;

class Database
{

  public function __construct(
    private string $host,
    private string $name,
    private string $user,
    private string $password,
  ) {}

  public function getConnection(): PDO
  {
    $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8;port=3306";
    return new PDO($dsn, $this->user, $this->password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
  }

  private function query($sql, $param = [])
  {
    $stmt = $this->getConnection()->prepare($sql);
    if ($param) {
      $stmt->execute($param);
    } else {
      $stmt->execute();
    }
    return $stmt;
  }
  // getAll($sql, $MaTK, $MaDM,....)
  public function getAll($sql)
  {
    $param = array_slice(func_get_args(), 1);
    $stmt = $this->query($sql, $param);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOne($sql,)
  {
    $param = array_slice(func_get_args(), 1);
    $stmt = $this->query($sql, $param);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($sql)
  {
    $pdo = $this->getConnection(); // Lấy kết nối trước
    $param = array_slice(func_get_args(), 1);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($param);
    return $pdo->lastInsertId(); // Lấy ID từ cùng kết nối
  }


  public function update($sql)
  {
    $param = array_slice(func_get_args(), 1);
    $stmt = $this->query($sql, $param);
    return $stmt->rowCount();
  }

  public function delete($sql)
  {
    $param = array_slice(func_get_args(), 1);
    $stmt = $this->query($sql, $param);
    return $stmt->rowCount();
  }
}
