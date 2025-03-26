<?php
namespace WorkSpace\Model;

class Tag extends Entity
{
   protected $table = 'TAG';
   protected $primaryKey = 'IDTag';
   protected $fillable = ['IDProject', 'TagName', 'IsDeleted'];
   protected $attributes = [
      'IsDeleted' => false,
   ];
   protected $timestamps = false;

   public function project()
   {
      return $this->belongsTo(Project::class, 'IDProject', 'IDProject');
   }

   public function tasks()
   {
      return $this->hasMany(Task::class, 'IDTag', 'IDTag');
   }
}