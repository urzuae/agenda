<?php
class Email extends Model
{
  public $address;
  public $type;
  public $person = null;

  public function __construct($address, $type, $person_id, $id = null, $include = true)
  {
    $this->table_name = "emails";
    $this->address = $address;
    $this->type = $type;
    $this->person = $person_id;
    if($include)
      $this->person = Person::find($person_id, false);
    $this->id = $id;
  }

  public static function find($id, $include = true)
  {
    $db = new Db();
    $result = $db->select("emails", "id, address, type, person_id", $id);
    if(0 == $result->num_rows)
      return null;
    $obj = $result->fetch_object();
    return new Email($obj->address, $obj->type, $obj->person_id, $obj->id, $include);
  }

  protected function prepare_params()
  {
    return array("address" => $this->address, "type" => $this->type, "person_id" => $this->person->id);
  }
}