<?php
namespace WorkSpace\Model;

class Status extends Entity
{
   protected $table = 'STATUS';
   protected $primaryKey = 'IDStatus';
   protected $fillable = ['IDProject', 'Status', 'StatusOrder', 'IsDeleted'];
   protected $attributes = [
      'IsDeleted' => false,
   ];

   public function project()
   {
      return $this->belongsTo(Project::class, 'IDProject', 'IDProject');
   }

   public function tasks()
   {
      return $this->hasMany(Task::class, 'IDStatus', 'IDStatus');
   }
}