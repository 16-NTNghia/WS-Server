<?php
namespace WorkSpace\Model;

class ProjectAccess extends Entity
{
   protected $table = 'PROJECT_ACCESS';
   protected $primaryKey = 'IDProjectAccess';
   protected $fillable = ['IDProject', 'IDCollaborator', 'Permission', 'IsDeleted'];
   protected $attributes = [
      'Permission' => 'View',
      'IsDeleted' => false,
   ];
   protected $timestamps = false;

   public function project()
   {
      return $this->belongsTo(Project::class, 'IDProject', 'IDProject');
   }

   public function collaborator()
   {
      return $this->belongsTo(User::class, 'IDCollaborator', 'IDUser');
   }
}