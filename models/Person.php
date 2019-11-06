<?php
class Person
{
  public $id;
  public $first_name;
  public $last_name;
  public $phones = array();
  public $emails = array();

  public function __construct($first_name, $last_name, $id = null)
  {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->id = $id;
  }

  public static function find($id)
  {
    $db = new Db();
    $result = $db->select("people", "id, first_name, last_name", $id);
    $obj = $result->fetch_object();
    return new Person($obj->first_name, $obj->last_name, $obj->id);
  }

  public function save()
  {
    $db = new Db();
    $params = $this->prepare_params();
    if($this->id == null) {
      $db->insert("people", $params);
      $this->id = $db->insert_id();
    } else {
      $db->update("people", $params, $this->id);
    }
  }

  public function delete()
  {
    $db = new Db();
    $db->delete("people", $this->id);
  }

  protected function prepare_params()
  {
    return array("first_name" => $this->first_name, "last_name" => $this->last_name);
  }
}