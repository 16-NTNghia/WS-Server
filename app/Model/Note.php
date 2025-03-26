<?php
namespace WorkSpace\Model;

class Note extends Entity
{
   protected $table = 'NOTE';
   protected $primaryKey = 'IDNote';
   protected $fillable = ['IDWidget', 'Author', 'Title', 'Content', 'CreatedAt', 'IsPublic', 'Thumbnail', 'IsDeleted'];
   protected $attributes = [
      'CreatedAt' => 'CURRENT_TIMESTAMP',
      'IsPublic' => false,
      'IsDeleted' => false,
   ];

   public function widget()
   {
      return $this->belongsTo(Widget::class, 'IDWidget', 'IDWidget');
   }

   public function author()
   {
      return $this->belongsTo(User::class, 'Author', 'IDUser');
   }

   public function attachments()
   {
      return $this->hasMany(NoteAttachment::class, 'IDNote', 'IDNote');
   }
}