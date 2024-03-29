<?php
class Db
{
  private $ins;

  public function __construct()
  {
    require("config.php");
    $this->ins = new mysqli($host, $user, $pass, $db_n);
  }

  public function get_by_parent_id($table, $parent_id)
  {
    $query = "SELECT id FROM {$table} WHERE person_id = {$parent_id}";

    return $this->ins->query($query); 
  }

  public function get($table, $fields)
  {
    $query = "SELECT {$fields} FROM {$table}";

    return $this->ins->query($query);
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

    return $this->ins->query($sql);
  }

  public function update($table, $params, $id)
  {
    $query = array();
    foreach($params as $key => $value) {
      $query[] = "{$key} = '{$value}'";
    }

    $query = implode(",", $query);

    $sql = "UPDATE {$table} SET {$query} WHERE id = {$id}";

    $this->ins->query($sql);
  }

  public function delete($table, $id)
  {
    $query = "DELETE FROM {$table} WHERE id = {$id}";

    $this->ins->query($query);
  }

  public function insert_id()
  {
    return $this->ins->insert_id;
  }
}