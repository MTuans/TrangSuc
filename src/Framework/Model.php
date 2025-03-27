<?php

namespace Framework;

use App\Database;

abstract class Model
{
  protected $table;
  protected Database $database;
  public function __construct()
  {
    $this->database = new Database("localhost", "wd19311-php2", "root", "");
    $this->database->getConnection();
  }
  public function find($id) 
  {
    return $this->database->getOne("SELECT * FROM $this->table WHERE id = ?", $id);
  }
  public function findAll(): array
  {
    return $this->database->getAll("SELECT * FROM $this->table");
  }
}
