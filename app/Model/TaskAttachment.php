<?php
namespace WorkSpace\Model;

class TaskAttachment extends Entity
{
   protected $table = 'TASK_ATTACHMENT';
   protected $primaryKey = 'IDTaskAttachment';
   protected $fillable = ['IDTask', 'UploadedBy', 'FileName', 'FileType', 'URL', 'UploadedAt', 'IsFinalFile', 'IsDeleted'];
   protected $attributes = [
      'UploadedAt' => 'CURRENT_TIMESTAMP',
      'IsFinalFile' => false,
      'IsDeleted' => false,
   ];
   protected $timestamps = false;

   public function task()
   {
      return $this->belongsTo(Task::class, 'IDTask', 'IDTask');
   }

   public function uploader()
   {
      return $this->belongsTo(User::class, 'UploadedBy', 'IDUser');
   }
}