<?php
namespace WorkSpace\Service;
use Exception;
use WorkSpace\Model\Project;
use WorkSpace\Model\ProjectAccess;
use WorkSpace\Model\Team;
use WorkSpace\Model\TeamMember;
use WorkSpace\Model\User;

class ProjectAccessService
{
    private $projectAccessModel;
    private $projectModel;
    private $teamModel;
    private $teamMemberModel;
    private $userModel;

    public function __construct(ProjectAccess $projectAccessModel, Project $projectModel, Team $teamModel, TeamMember $teamMemberModel, User $userModel)
    {
        $this->projectAccessModel = $projectAccessModel;
        $this->projectModel = $projectModel;
        $this->teamModel = $teamModel;
        $this->teamMemberModel = $teamMemberModel;
        $this->userModel = $userModel;
    }

    public function ModifyProjectAccess($IDProject)
    {
        
        $existProject = $this->projectModel->where('IDProject', $IDProject)
        ->where('IsDeleted', false)->first();
        
        if (!$existProject) {
            throw new Exception("Project does not exist.");
        }
        
        $existTeam = $this->teamModel->where('IDTeam', $existProject->IDTeam)
        ->where('IsDeleted', false)->first();
        
        if (!$existTeam) {
            throw new Exception("Team does not exist.");
        }
        
        $teamMembers = $this->teamMemberModel->where('IDTeam', $existTeam->IDTeam)
        ->where('IsDeleted', false)->get();
        
        if (!$teamMembers) {
            throw new Exception("Team don't have members.");
        }

        global $projectAccess;
        
        $projectAccess = $this->projectAccessModel;

        foreach ($teamMembers as $member) {
            if(!$projectAccess->where('IDCollaborator', $member->IDUser)->where('IDProject', $existProject->IDProject)->first()) {  
                $projectAccess->create([
                    'IDProject' => $existProject->IDProject,
                    'IDCollaborator' => $member->IDUser,
                ]);
            }
        }

        return $projectAccess->where('IDProject', $existProject->IDProject)->get();
    }
}