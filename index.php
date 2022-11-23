<?php

require_once  'src/controllers/TaskController.php';
require_once  'src/controllers/UserController.php';

// monsite.fr/index.php?controller=task&action=index


$controller_name = ucfirst(strtolower($_GET['controller'])) . 'Controller';
$action_name = strtolower($_GET['action']);


$controller_instance = new $controller_name();

$controller_instance->$action_name();
