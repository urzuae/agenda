<?php
class Phone
{
  public $id;
  public $number;
  public $type;
  public $person;

  public function __construct($number, $type, $person_id, $id = null)
  {
    $this->number = $number;
    $this->type = $type;
    $this->person = Person::find($person_id);
    $this->id = $id;
  }

  public static function find($id)
  {
    $db = new Db();
    $result = $db->select("phones", "id, number, type, person_id", $id);
    $obj = $result->fetch_object();
    return new Phone($obj->number, $obj->type, $obj->person_id, $obj->id);
  }

  public function save()
  {
    $db = new Db();
    $params = $this->prepare_params();
    if($this->id == null) {
      $db->insert("phones", $params);
    } else {
      $db->update("phones", $params, $this->id);
    }
  }

  public function delete()
  {
    $db = new Db();
    $db->delete("phones", $this->id);
  }

  protected function prepare_params()
  {
    return array("number" => $this->number, "type" => $this->type, "person_id" => $this->person->id);
  }
}