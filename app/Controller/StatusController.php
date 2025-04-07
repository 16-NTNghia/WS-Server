<?php

namespace WorkSpace\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;
use WorkSpace\Service\StatusService;

class StatusController{
    private $statusService;

    public function __construct(StatusService $statusService){
        $this->statusService = $statusService;
    }

    public function ModifyOrderStatus(Request $request, $IDProject) {
        try {
            $data = $request->json()->all();
            $response = $this->statusService->ModifyOrderStatus($data, $IDProject);
            return new JsonResponse([
                'message' => 'Modify Status Successfully',
                'data' => $response
            ], 200);
        } catch (Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], 400);
        }
    }
}