<?php
class Request
{
  var $request;
  var $uri;
  var $params;

  public function __construct()
  {
    $this->request = $_SERVER['REQUEST_METHOD'];
    $this->uri = $_SERVER['REQUEST_URI'];
    $this->params = json_decode(file_get_contents('php://input'));
  }
}