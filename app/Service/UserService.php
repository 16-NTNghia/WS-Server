<?php
namespace WorkSpace\Service;

use WorkSpace\Model\User;

class UserService
{
   public function createUser($data)
   {
      return User::create([
         "Username" => $data["username"],
         "Email" => $data["email"],
         "Password" => $data["password"],
      ]);
   }
}