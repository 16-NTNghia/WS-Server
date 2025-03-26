<?php
namespace WorkSpace\Model;

class User extends Entity
{
   protected $table = 'USERS';
   protected $primaryKey = 'IDUser';
   protected $fillable = ['Username', 'Email', 'Password', 'DisplayName', 'Avatar', 'Cover', 'IsDeleted'];
   protected $attributes = [
      'IsDeleted' => false,
   ];

   public $timestamps = false;
   protected $hidden = ['Password'];

   public function setPasswordAttribute($value)
   {
      $this->attributes['Password'] = password_hash($value, PASSWORD_BCRYPT);
   }

}