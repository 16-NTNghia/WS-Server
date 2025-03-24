<?php
namespace Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response; // Import Response
use Utils\EnvironmentVariable;
use WorkSpace\Service\UserService;

class Authenticate
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handle(Request $request, Closure $next): Response|JsonResponse
    {
        try {
            // Lấy token từ header Authorization
            $authHeader = $request->header('Authorization');
            if (!$authHeader) {
                throw new Exception('Thiếu header Authorization');
            }

            // Kiểm tra định dạng Bearer token
            if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                throw new Exception('Định dạng token không hợp lệ');
            }

            $token = $matches[1];

            // Giải mã token
            $key = new Key(EnvironmentVariable::get('JWT.ACCESS_TOKEN.SECRET'), 'HS256');
            $decoded = JWT::decode($token, $key);

            // Kiểm tra issuer
            if ($decoded->iss !== EnvironmentVariable::get('APP.HOST')) {
                throw new Exception('Token không hợp lệ');
            }

            // Kiểm tra user trong database
            $user = $this->userService->findUser('IDUser', $decoded->sub);

            // Lưu thông tin user vào request để sử dụng ở controller
            $request->attributes->set('user', [
                'id' => $decoded->sub,
                'username' => $decoded->username,
                'email' => $user->Email,
                'display_name' => $user->DisplayName
            ]);

            // Tiếp tục xử lý request
            return $next($request);
        } catch (Exception $e) {
            return new JsonResponse([
                'message' => 'Unauthorized: ' . $e->getMessage(),
            ], 401);
        }
    }
}