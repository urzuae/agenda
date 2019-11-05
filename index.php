<?php
require("./loader.php");

$req = new Request();

if($req->uri == '/person') {
  $req->params;
  $person = new Person($req->params->first_name, $req->params->last_name);

  $person->save();
}