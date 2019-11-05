<?php
class Request
{
  var $type;
  var $uri;
  var $params;

  public function __construct()
  {
    $this->type = $_SERVER['REQUEST_METHOD'];
    $this->uri = $_SERVER['REQUEST_URI'];
    $this->params = json_decode(file_get_contents('php://input'));
  }

  public function get_route()
  {
    return $this->type.":".$this->uri;
  }
}