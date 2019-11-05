<?php
class MainController
{
  var $request = null;
  var $route = array();

  public function __construct($request)
  {
    $this->request = $request;
    $this->routes();
  }

  public function make_call()
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
    
    $this->$method($this->request->params);
  }

  private function create_person($params)
  {
    $person = new Person($params->first_name, $params->last_name);

    $person->save();
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
    $this->route["POST:/phone"] = "create_phone";
    $this->route["POST:/email"] = "create_email";
  }
}