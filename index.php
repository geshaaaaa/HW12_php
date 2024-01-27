<?php

    define('APP_DIR', __DIR__ . '/');
    require_once APP_DIR . "classes/TaskService.php";
    require_once APP_DIR . "classes/Task.php";
try {
    $service = new TaskService("notebookForTasks.json");
    $service->addTask("Зробити завдання 1", 5);
    $service->addTask("Зробити завдання 2", 4);
    $service->addTask("Зробити завдання 3", 3);
    $service->deleteTask(3);
    $service->completeTask(1);
    $service->getTasks();
} catch (Exception $exception)
{
    $exception->getMessage();
}

