<?php

require("./loader.php");

$req = new Request();

$controller = new MainController($req);

$controller->make_call();
