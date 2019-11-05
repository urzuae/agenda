<?php
class Request
{
  var $request_method;

  public function __construct()
  {
    $this->request = $_SERVER['REQUEST_METHOD']
  }
}