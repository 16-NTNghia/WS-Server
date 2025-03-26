<?php
namespace WorkSpace\Model;

class Project extends Entity
{
   protected $table = 'PROJECT';
   protected $primaryKey = 'IDProject';
   protected $fillable = ['IDTeam', 'ProjectName', 'ProjectDescription', 'IsDeleted'];
   protected $attributes = [
      'IsDeleted' => false,
   ];
   protected $timestamps = false;

   public function team()
   {
      return $this->belongsTo(Team::class, 'IDTeam', 'IDTeam');
   }

   public function access()
   {
      return $this->hasMany(ProjectAccess::class, 'IDProject', 'IDProject');
   }

   public function tags()
   {
      return $this->hasMany(Tag::class, 'IDProject', 'IDProject');
   }

   public function statuses()
   {
      return $this->hasMany(Status::class, 'IDProject', 'IDProject');
   }

   public function tasks()
   {
      return $this->hasMany(Task::class, 'IDProject', 'IDProject');
   }
}