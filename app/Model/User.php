<?php
namespace WorkSpace\Model;

class User extends Entity
{
   protected $table = 'USERS';
   protected $primaryKey = 'IDUser';
   public $timestamps = false;
   protected $fillable = ['Username', 'Email', 'Password', 'DisplayName', 'Avatar', 'Cover', 'IsDeleted'];
   protected $attributes = [
      'IsDeleted' => false,
   ];

}