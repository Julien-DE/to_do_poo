<?php

require_once 'models/Task.php';

$task = new Task();

$t = $task->getOneById('7');
var_dump($t);
