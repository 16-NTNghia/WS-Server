<?php
namespace WorkSpace\Model;

class WorkSpaceAccess extends Entity
{
   protected $table = 'WORKSPACE_ACCESS';
   protected $primaryKey = 'IDWorkSpaceAccess';
   protected $fillable = ['IDWorkSpace', 'IDCollaborator', 'Permission', 'IsDeleted'];
   protected $attributes = [
      'Permission' => 'View'
   ];
   
   public function workspace()
   {
      return $this->belongsTo(Workspace::class, 'IDWorkSpace', 'IDWorkSpace');
   }

   public function collaborator()
   {
      return $this->belongsTo(User::class, 'IDCollaborator', 'IDUser');
   }
}