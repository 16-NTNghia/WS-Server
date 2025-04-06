<?php
namespace WorkSpace\Service;
use Exception;
use WorkSpace\Model\Task;
use WorkSpace\Model\Project;

class TaskService
{
    private $taskModel;
    private $projectModel;

    public function __construct(Task $taskModel, Project $projectModel)
    {
        $this->taskModel = $taskModel;
        $this->projectModel = $projectModel;
    }

    public function ModifyTaskSDDD($data, $IDTask, $IDProject)
    {
        $existProject = $this->projectModel->where('IDProject', $IDProject)
            ->where('IsDeleted', false)->first();

        if (!$existProject) {
            throw new Exception('Project not found');
        }
        $task = $this->taskModel->where('IDTask', $IDTask)
            ->where('IDProject', $IDProject)
            ->where('IsDeleted', false)->first();

        if (!$task) {
            throw new Exception('Task not found');
        }

        //StartDay ở đây đang theo định dạng mm/dd/yyyy
        if(!empty($data['StartDay'])){
            $task->StartDay = date('Y-m-d H:i:s', strtotime($data['StartDay']));
        }

        //DueDay ở đây đang theo định dạng mm/dd/yyyy
        if(!empty($data['DueDay'])){
            $task->DueDay = date('Y-m-d H:i:s', strtotime($data['DueDay']));
        }

        $task->save();

        return $task;
    }
}