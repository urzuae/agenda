<?php
class Controller
{
  protected $route = array();

  public function __construct($request)
  {
    $this->request = $request;
    $this->routes();
  }

  protected function routes()
  {
    $this->route["GET:"] = "root";

    $this->route["POST:/person"] = "create_person";
    $this->route["GET:/person/:id"] = "get_person";
    $this->route["PATCH:/person/:id"] = "update_person";
    $this->route["DELETE:/person/:id"] = "delete_person";

    $this->route["POST:/phone"] = "create_phone";
    $this->route["GET:/phone/:id"] = "get_phone";
    $this->route["PATCH:/phone/:id"] = "update_phone";
    $this->route["DELETE:/phone/:id"] = "delete_phone";

    $this->route["POST:/email"] = "create_email";
    $this->route["GET:/email/:id"] = "get_email";
    $this->route["PATCH:/email/:id"] = "update_email";
    $this->route["DELETE:/email/:id"] = "delete_email";
  }

  protected function verifyUrl()
  {
    if(!array_key_exists($this->request->get_route(), $this->route))
    {
      $this->not_found();
    }

    $method = $this->route[$this->request->get_route()];

    if(!method_exists($this, $method))
    {
      $this->not_found();
    }
  }

  public function not_found()
  {
    header("HTTP/1.0 404 Not Found");
    die();
  }

  public function success($object, $code)
  {
    header("HTTP/1.0 {$code} Success");
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($object);
  }

  public function no_content()
  {
    header("HTTP/1.0 204 No Response");
  }

}