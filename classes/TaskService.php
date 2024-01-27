<?php

require_once ("StatusOfTask.php");
require_once ("Task.php");


class TaskService
{
    private string $filePath;
    private array $tasks = [];
    private int $counter;

    public function __construct($filePath)
    {
        $this->setFilePath($filePath);

    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw new Exception("File doesnt exist");
        } else {
            $this->fileToArray($filePath);
        }
    }
    private function fileToArray($filePath)
    {
        $this->filePath = $filePath;
        if (filesize($filePath) == 0) {
            $this->counter = 0;
            $this->tasks = [];
        } else {
            $serializedData = file_get_contents($this->filePath);
            $this->tasks = unserialize($serializedData);
            $this->counter = end($this->tasks)->getId();
        }
    }
    public function addTask(string $taskName, string $taskPriority) : void
    {
        $this->counter++;
        $taskPriority = $taskPriority ? $taskPriority : 0;
        $task = new Task($this->counter, $taskPriority, $taskName);
        $this->tasks[] = $task;
    }

    public function deleteTask(int $taskId)
    {
        $deleteCounter = 0;
        foreach ($this->tasks as $key => $task) {
            if ($task->getId() == $taskId) {
                unset($this->tasks[$key]);
                $deleteCounter++;
            }
        }
        if ($deleteCounter == 0)
        {
            throw new Exception("Cant delete task with this id. Id doesnt exist");
        }
    }

    public function getTasks() : void
    {
        $this->tasks = $this->sortTasks();
        print_r($this->tasks);

    }

    private function sortTasks(): array
    {
        if (empty($this->tasks)) {
            return $this->tasks;
        }

        usort($this->tasks, function ($a, $b) {
            $priorityA = $a ? $a->getTaskPriority() : 0;
            $priorityB = $b ? $b->getTaskPriority() : 0;

            return $priorityB - $priorityA;
        });

        return $this->tasks;
    }

    public function completeTask($taskId) : void
    {
        $completeCounter = 0;
        foreach ($this->tasks as $key => $task) {
            if ($task->getId() == $taskId) {
                $task->setStatus(StatusOfTask::Done);
                $this->tasks[$key] = $task;
                $completeCounter++;
            }
        }
        if ($completeCounter == 0)
        {
            throw new Exception("Task with this id doesnt exist");
        }
    }

    public function __destruct()
    {
        $filePath = $this->getFilePath();
        file_put_contents($filePath, serialize($this->tasks));
    }
}
