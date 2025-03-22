<?php
namespace WorkSpace\Controller;
use WorkSpace\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController
{
   private AuthService $AuthService;

   public function __construct(AuthService $AuthService)
   {
      $this->AuthService = $AuthService;
   }

   public function Register(Request $request): JsonResponse
   {
      $user = $this->AuthService->registerAccount($request->json()->all());
      return new JsonResponse([
         'message' => 'Tạo tài khoản thành công',
         'data' => $user
      ], 201);
   }

}