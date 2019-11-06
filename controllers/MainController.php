<?php
class MainController extends Controller
{
  var $request = null;
  var $route = array();

  public function __construct($request)
  {
    parent::__construct($request);
    $this->verifyUrl();
  }

  public function make_call()
  {
    $method = $this->route[$this->request->get_route()];
    
    $this->$method($this->request->params);
  }

  private function create_person($params)
  {
    $person = new Person($params->first_name, $params->last_name);

    $person->save();
  }

  private function get_person()
  {
    $person = Person::find($this->request->params->id);

    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($person);
  }

  private function update_person()
  {
    $person = Person::find($this->request->params->id);

    $person->first_name = $this->request->params->first_name;
    $person->last_name = $this->request->params->last_name;

    $person->save();

    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($person);
  }

  private function delete_person()
  {
    $person = Person::find($this->request->params->id);

    $person->delete();

    header("HTTP/1.0 204 No Response");
  }

  private function create_phone($params)
  {
    $phone = new Phone($params->number, $params->type, $params->user_id);

    $phone->save();
  }

  private function create_email($params)
  {
    $email = new Email($params->address, $params->type, $params->user_id);

    $email->save();
  }
}