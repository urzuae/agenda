<?php
class Db
{
  private $ins;

  public function __construct()
  {
    require("config.php");
    $this->ins = new mysqli($host, $user, $pass, $db_n);
  }

  public function select($table, $fields, $id)
  {
    $query = "SELECT {$fields} FROM {$table} WHERE id = {$id}";

    return $this->ins->query($query);
  }

  public function insert($table, $params)
  {
    $keys = [];
    $values = [];
    foreach($params as $key => $value)
    {
      $keys[] = $key;
      $values[] = $value;
    }

    $keys = implode(",", $keys);
    $values = implode("','", $values);

    $sql = "INSERT INTO {$table} ({$keys}) VALUES ('{$values}')";

    $this->ins->query($sql);
  }

  public function update($table, $params, $id)
  {
    $query = "";
    foreach($params as $key => $value)
    {
      $query .= "{$key} = '{$value}'";
    }


    $sql = "UPDATE {$table} SET {$query} WHERE id = {$id}";

    $this->ins->query($sql);
  }

  public function delete($table, $id)
  {
    $query = "DELETE FROM {$table} WHERE id = {$id}";

    $this->ins->query($query);
  }
}