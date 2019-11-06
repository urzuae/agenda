<?php
class MainController
{
  var $request = null;
  var $route = array();

  public function __construct($request)
  {
    $this->request = $request;
    $this->routes();
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

  private function routes()
  {
    $this->route["POST:/person"] = "create_person";
    $this->route["GET:/person/:id"] = "get_person";
    $this->route["PATCH:/person/:id"] = "update_person";
    $this->route["POST:/phone"] = "create_phone";
    $this->route["GET:/phone/:id"] = "get_person";
    $this->route["POST:/email"] = "create_email";
    $this->route["GET:/email/:id"] = "get_person";
  }

  private function verifyUrl()
  {
    if(!array_key_exists($this->request->get_route(), $this->route))
    {
      header("HTTP/1.0 404 Not Found");
      die();
    }

    $method = $this->route[$this->request->get_route()];

    if(!method_exists($this, $method))
    {
      header("HTTP/1.0 404 Not Found");
      die();
    }
  }
}