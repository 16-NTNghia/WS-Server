<?php
namespace WorkSpace\Service;
use WorkSpace\Service\UserService;
use Firebase\JWT\JWT;
use Utils\EnvironmentVariable;
use Exception;
use WorkSpace\Model\User;
use Firebase\JWT\Key;

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

   private function generateRefreshToken($user)
   {
      $payload = [
         'iss' => EnvironmentVariable::get('APP.HOST'),
         'iat' => time(),
         'exp' => time() + (int) EnvironmentVariable::get('JWT.REFRESH_TOKEN.EXPIRES_IN'),
         'sub' => $user->IDUser
      ];

      return JWT::encode(
         $payload,
         EnvironmentVariable::get('JWT.REFRESH_TOKEN.SECRET'),
         'HS256'
      );
   }

   private function generateAccessToken($user)
   {
      $payload = [
         'iss' => EnvironmentVariable::get('APP.HOST'),
         'iat' => time(),
         'exp' => time() + (int) EnvironmentVariable::get('JWT.ACCESS_TOKEN.EXPIRES_IN'),
         'sub' => $user->IDUser,
         'username' => $user->Username,
         'email' => $user->Email,
      ];

      return JWT::encode(
         $payload,
         EnvironmentVariable::get('JWT.ACCESS_TOKEN.SECRET'),
         'HS256'
      );
   }

   public function login($data)
   {
      $requiredFields = [
         'username' => 'Username không được để trống',
         'password' => 'Password không được để trống',
      ];

      foreach ($requiredFields as $field => $message) {
         if (empty($data[$field])) {
            throw new Exception($message);
         }
      }

      $user = $this->userService->findByUsername($data['username']);

      if (!password_verify($data['password'], $user->Password)) {
         throw new Exception('Password không đúng');
      }

      $accessToken = $this->generateAccessToken($user);
      $refreshToken = $this->generateRefreshToken($user);

      return [
         'access_token' => $accessToken,
         'refresh_token' => $refreshToken,
      ];
   }

   public function refreshAccessToken($refreshToken)
   {
      if (empty($refreshToken)) {
         throw new Exception('Refresh token không được để trống');
      }

      try {
         $key = new Key(EnvironmentVariable::get('JWT.REFRESH_TOKEN.SECRET'), 'HS256');
         $decoded = JWT::decode($refreshToken, $key);

         if ($decoded->iss !== EnvironmentVariable::get('APP.HOST')) {
            throw new Exception('Refresh token không hợp lệ');
         }

         $userId = $decoded->sub;
         $user = User::find($userId);

         if (!$user || $user->IsDeleted) {
            throw new Exception('User không tồn tại hoặc đã bị xóa');
         }

         $newAccessToken = $this->generateAccessToken($user);

         return [
            'access_token' => $newAccessToken
         ];
      } catch (Exception $e) {
         throw new Exception('Refresh token không hợp lệ hoặc đã hết hạn : ' . $e->getMessage());
      }
   }

}