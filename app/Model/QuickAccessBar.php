<?php
namespace WorkSpace\Model;

class QuickAccessBar extends Entity
{
   protected $table = 'QUICK_ACCESS_BAR';
   protected $primaryKey = 'IDQuickAccessBar';
   protected $fillable = ['IDUser', 'URL', 'IsDeleted'];

   public function user()
   {
      return $this->belongsTo(User::class, 'IDUser', 'IDUser');
   }
}