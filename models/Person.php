<?php
class Person extends Model
{
  public $first_name;
  public $last_name;
  public $phones = array();
  public $emails = array();

  public function __construct($first_name, $last_name, $id = null, $include = true)
  {
    $this->table_name = "people";
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->id = $id;
    if($this->id != null && $include)
    {
      $this->fetch_emails();
      $this->fetch_phones();
    }
  }

  public static function find($id, $include = true)
  {
    $db = new Db();
    $result = $db->select("people", "id, first_name, last_name", $id);
    if(0 == $result->num_rows)
      return null;
    $obj = $result->fetch_object();
    return new Person($obj->first_name, $obj->last_name, $obj->id, $include);
  }

  protected function prepare_params()
  {
    return array("first_name" => $this->first_name, "last_name" => $this->last_name);
  }

  private function fetch_emails()
  {
    $db = new Db();
    $ids = $db->get_by_parent_id("emails", $this->id);
    while($id = $ids->fetch_array())
    {
      $this->emails[] = Email::find($id["id"], false);
    }
  }

  private function fetch_phones()
  {
    $db = new Db();
    $ids = $db->get_by_parent_id("phones", $this->id);
    while($id = $ids->fetch_array())
    {
      $this->phones[] = Phone::find($id["id"], false);
    } 
  }
}