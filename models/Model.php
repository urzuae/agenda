<?php
abstract class Model
{
  protected $table_name;

  public $id;

  public static abstract function find($id);

  public function save()
  {
    $db = new Db();
    $params = $this->prepare_params();
    if($this->id == null) {
      $db->insert($this->table_name, $params);
      $this->id = $db->insert_id();
    } else {
      $db->update($this->table_name, $params, $this->id);
    }
  }

  public function delete()
  {
    $db = new Db();
    $db->delete($this->table_name, $this->id);
  }

  protected abstract function prepare_params();
}
