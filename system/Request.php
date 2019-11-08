<?php
class Request
{
  var $type;
  var $uri = null;
  var $params = null;

  public function __construct()
  {
    $this->type = $_SERVER['REQUEST_METHOD'];
    $this->uri = $_SERVER['QUERY_STRING'] ?? "";
    $this->params = json_decode(file_get_contents('php://input'));
    if("GET" == $this->type || "PATCH" == $this->type || "DELETE" == $this->type) {
      $this->parse_uri();
    }
  }

  public function get_route()
  {
    return $this->type.":".$this->uri;
  }

  private function parse_uri()
  {
    if($this->params == null) {
      $this->params = new stdClass();
    }
    $result = array();
    preg_match("/\d+$/", $this->uri, $result);
    $this->params->id = $result[0];
    $this->uri = preg_replace("/\d+$/", ":id", $this->uri);
  }

  private function check_for_id()
  {
    $this->uri = $this->uri;
    $this->params->id = $id;
  }
}