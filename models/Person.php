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

  protected function fill()
  {

  }

  public static function find($id)
  {

  }

  public function add_phone()
  {

  }

  public function add_email()
  {

  }
  
  public function save()
  {
    $db = new Db();
    $params = $this->prepare_params();
    $db->insert("people", $params);
  }

  public function delete()
  {

  }

  protected function prepare_params()
  {
    return array("first_name" => $this->first_name, "last_name" => $this->last_name);
  }
}