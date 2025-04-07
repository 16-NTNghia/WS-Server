<?php

namespace WorkSpace\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;
use WorkSpace\Service\ProjectAccessService;

class ProjectAccessController
{
    private $projectAccessService;
    public function __construct(ProjectAccessService $projectAccessService)
    {
        $this->projectAccessService = $projectAccessService;
    }

    public function modifyProjectAccess($IDProject) {
        try {
            $response = $this->projectAccessService->ModifyProjectAccess($IDProject);
            return new JsonResponse([
                'message' => 'Modify Project Access Successfully',
                'data' => $response
            ], 200);
        } catch (Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], 400);
        }
    }
}