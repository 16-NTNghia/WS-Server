<?php
namespace WorkSpace\Service;
use Exception;

use WorkSpace\Model\User;

class UserService
{
   public function createUser($data)
   {
      if (User::where('Username', $data['username'])->exists()) {
         throw new Exception('Username đã tồn tại');
      }

      if (User::where('Email', $data['email'])->exists()) {
         throw new Exception('Email đã tồn tại');
      }

      return User::create([
         "Username" => $data["username"],
         "Email" => $data["email"],
         "DisplayName" => $data["displayName"],
         "Password" => $data["password"],
      ]);
   }

   public function findByUsername($username)
   {
      $user = User::where('Username', $username)
         ->where('IsDeleted', false)
         ->first();

      if (!$user) {
         throw new Exception('Tài khoản không tồn tại');
      }

      return $user;
   }
}