<?php
class Phone
{
  var $id;
  var $number;
  var $person;
  var $type;

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
    return array("number" => $this->number, "type" => $this->type, "user_id" => $this->person->id);
  }
}