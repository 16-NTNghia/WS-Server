<?php
namespace WorkSpace\Service;
use Exception;
use WorkSpace\Model\Status;
use WorkSpace\Model\Project;

class StatusService
{
    private $statusModel;
    private $projectModel;

    public function __construct(Status $statusModel, Project $projectModel)
    {
        $this->statusModel = $statusModel;
        $this->projectModel = $projectModel;
    }

    public function ModifyOrderStatus($data, $IDProject)
    {
        $existProject = $this->projectModel->where('IDProject', $IDProject)
            ->where('IsDeleted', false)->first();

        if (!$existProject) {
            throw new Exception('Project not found');
        }

        if(empty($data['StatusOrderPresent']) || empty($data['StatusOrderReplace'])) {
            throw new Exception('choose position');
        }

        if($data['StatusOrderPresent'] == $data['StatusOrderReplace']) {
            throw new Exception('Same position');
        }

        $statuses = $this->statusModel->where('IDProject', $IDProject)
            ->where('IsDeleted', false)->get();
        
        $statusExist = $this->statusModel->where('IDProject', $IDProject)
            ->where('IsDeleted', false)
            ->where('StatusOrder', $data['StatusOrderPresent'])
            ->first();
        
        $statusExist2 = $this->statusModel->where('IDProject', $IDProject)
            ->where('IsDeleted', false)
            ->where('StatusOrder', $data['StatusOrderReplace'])
            ->first();

        if(empty($statusExist) || empty($statusExist2)) {
            throw new Exception('Status not found');
        }

        foreach($statuses as $status) {
            foreach($statuses as $status2) {
                if($status->StatusOrder == $data['StatusOrderPresent'] && $status2->StatusOrder == $data['StatusOrderReplace']) {
                    $status->StatusOrder = $data['StatusOrderReplace'];
                    $status2->StatusOrder = $data['StatusOrderPresent'];
                    $status->save();
                    $status2->save();
                    return $statuses;
                }
            }
        }

        return $statuses;
    }
}