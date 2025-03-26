<?php
namespace WorkSpace\Model;

class WorkSpace extends Entity
{
   protected $table = 'WORKSPACE';
   protected $primaryKey = 'IDWorkSpace';
   protected $fillable = ['IDUser', 'WorkSpaceName', 'WorkSpaceDescription', 'IsDeleted'];
   protected $attributes = [
      'IsDeleted' => false,
   ];

   public function owner()
   {
      return $this->belongsTo(User::class, 'IDUser', 'IDUser');
   }

   public function collaborators()
   {
      return $this->hasMany(WorkSpaceAccess::class, 'IDWorkSpace', 'IDWorkSpace');
   }

   public function widgets()
   {
      return $this->hasMany(Widget::class, 'IDWorkSpace', 'IDWorkSpace');
   }
}