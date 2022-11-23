<?php

require_once 'src/models/Task.php';
require_once 'utilities/Controller.php';

class TaskController extends Controller
{
    /**
     * afficher la liste des tâches
     * @return void
     */
    public function index(): void
    {
        // instance
        $task = new Task();
        // récupérer la liste des tâches

        $tasks = $task->findAllBy(['id_user' => 1], 'Task');
        $message = 'hello';
        /*
         * [
            'tasks' => $tasks,
            'message' => $message
        ]
         */
        $this->renderView('task/index', compact('tasks', 'message'));
    }

    public function insert()
    {
        $this->renderView('task/insert');
    }

    public function delete()
    {

        echo "Task controller " . __FUNCTION__;
    }

    public function edit()
    {
        echo "Task controller " . __FUNCTION__;
    }
}
