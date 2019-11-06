<?php
class Email
{
  public $id;
  public $address;
  public $type;
  public $person = null;

  public function __construct($address, $type, $person_id, $id = null)
  {
    $this->address = $address;
    $this->type = $type;
    $this->person = Person::find($person_id);
    $this->id = $id;
  }

  public static function find($id)
  {
    $db = new Db();
    $result = $db->select("emails", "id, address, type, person_id", $id);
    $obj = $result->fetch_object();
    return new Email($obj->address, $obj->type, $obj->person_id, $obj->id);
  }

  public function save()
  {
    $db = new Db();
    $params = $this->prepare_params();
    if($this->id == null) {
      $db->insert("emails", $params);
      $this->id = $db->insert_id();
    } else {
      $db->update("emails", $params, $this->id);
    }
  }

  public function delete()
  {
    $db = new Db();
    $db->delete("emails", $this->id);
  }

  protected function prepare_params()
  {
    return array("address" => $this->address, "type" => $this->type, "person_id" => $this->person->id);
  }
}