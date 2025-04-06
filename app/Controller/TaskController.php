<?php

namespace WorkSpace\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;
use WorkSpace\Service\TaskService;

class TaskController
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function ModifyTaskSDDD(Request $request, $IDProject, $IDTask)
    {
        $data = $request->all();
        try {
            $task = $this->taskService->ModifyTaskSDDD($data, $IDTask, $IDProject);
            return new JsonResponse([
                'message' => 'Modify Task Successfully',
                'data' => $task
            ], 200);
        } catch (Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], 400);
        }
    }
}