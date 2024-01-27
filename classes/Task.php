<?php
require_once "StatusOfTask.php";

class Task
{
    private string $taskName;
    private int $taskPriority;
    private int $id;
    private StatusOfTask $status;

    public function __construct(int $id, int $taskPriority, string $taskName, StatusOfTask $status = StatusOfTask::notDone)
    {
        $this->taskName = $taskName;
        $this->taskPriority = $taskPriority;
        $this->id = $id;
        $this->status = $status;
    }




    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTaskName(): string
    {
        return $this->taskName;
    }

    /**
     * @param string $taskName
     */
    public function setTaskName(string $taskName): void
    {
        $this->taskName = $taskName;
    }

    /**
     * @return int
     */
    public function getTaskPriority(): int
    {
        return $this->taskPriority;
    }

    /**
     * @param int $taskPriority
     */
    public function setTaskPriority(int $taskPriority): void
    {
        $this->taskPriority = $taskPriority;
    }

    /**
     * @param StatusOfTask $status
     */
    public function setStatus(StatusOfTask $status): void
    {
        $this->status = $status;
    }

    /**
     * @return StatusOfTask
     */
    public function getStatus(): StatusOfTask
    {
        return $this->status;
    }

}