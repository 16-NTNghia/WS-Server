<?php
namespace WorkSpace\Service;
use WorkSpace\Service\UserService;

class AuthService
{
   private $userService;
   public function __construct(UserService $userService)
   {
      $this->userService = $userService;
   }

   public function registerAccount($data)
   {
      return $this->userService->createUser($data);
   }

}