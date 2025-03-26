<?php
namespace WorkSpace\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SystemController
{
   public function root()
   {
      return '🚀 WS-Server is running 🚀';
   }

   public function getUserInfoFromRequest(Request $request): JsonResponse
   {
      $user = $request->get('USER');
      $IDUser = $request->get('USER')['IDUser'];
      return new JsonResponse([
         'message' => 'User Inf',
         'user' => $user,
         'IDUser' => $IDUser
      ], 200);
   }
}