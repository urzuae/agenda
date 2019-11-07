<?php
class Phone extends Model
{
  public $id;
  public $number;
  public $type;
  public $person;

  public function __construct($number, $type, $person_id, $id = null, $include = true)
  {
    $this->table_name = "phones";
    $this->number = $number;
    $this->type = $type;
    $this->person = $person_id;
    if($include)
      $this->person = Person::find($person_id, false);
    $this->id = $id;
  }

  public static function find($id, $include = true)
  {
    $db = new Db();
    $result = $db->select("phones", "id, number, type, person_id", $id);
    if(0 == $result->num_rows)
      return null;
    $obj = $result->fetch_object();
    return new Phone($obj->number, $obj->type, $obj->person_id, $obj->id, $include);
  }

  protected function prepare_params()
  {
    return array("number" => $this->number, "type" => $this->type, "person_id" => $this->person->id);
  }
}