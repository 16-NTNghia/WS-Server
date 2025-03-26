<?php
namespace WorkSpace\Model;

class NoteAttachment extends Entity
{
   protected $table = 'NOTE_ATTACHMENT';
   protected $primaryKey = 'IDNoteAttachment';
   protected $fillable = ['IDNote', 'FileName', 'FileType', 'URL', 'IsDeleted'];
   protected $attributes = [
      'IsDeleted' => false,
   ];
   protected $timestamps = false;
   public function note()
   {
      return $this->belongsTo(Note::class, 'IDNote', 'IDNote');
   }
}