<?php
namespace WorkSpace\Service;
use Exception;
use WorkSpace\Model\Project;
use WorkSpace\Model\ProjectAccess;
use WorkSpace\Model\User;

class ProjectAccessService
{
    private $projectAccessModel;
    private $projectModel;
    private $userModel;

    public function __construct(ProjectAccess $projectAccessModel, Project $projectModel, User $userModel)
    {
        $this->projectAccessModel = $projectAccessModel;
        $this->projectModel = $projectModel;
        $this->userModel = $userModel;
    }

    public function ModifyProjectAccess($data, $IDUser, $IDProject)
    {
        $existProject = $this->projectModel->where('IDProject', $IDProject)
            ->where('IsDeleted', false)->first();

        if (!$existProject) {
            throw new Exception("Project does not exist.");
        }

        $existUser = $this->userModel->where('IDUser', $IDUser)
            ->where('IsDeleted', false)->first();

        if (!$existUser) {
            throw new Exception("User does not exist.");
        }

        $projectAccess = $this->projectAccessModel
            ->where('IDProject', $IDProject)
            ->where('IDCollaborator', $IDUser)
            ->where('IsDeleted', false)->first();

        if (!$projectAccess) {
            throw new Exception("You don't have access to this project.");
        }

        if (!empty($data['Permission'])) {
            switch ($data['Permission']) {
                case "Owner":
                case "Edit":
                case "View":
                    $projectAccess->Permission = $data['Permission'];
                    break;
                default:
                    throw new Exception("Invalid permission.");
            }
        }

        $projectAccess->save();
        return $projectAccess;
    }
}