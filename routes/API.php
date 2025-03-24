<?php
use Illuminate\Routing\Router;
use WorkSpace\Controller\AuthController;
use WorkSpace\Controller\HomeController;
use Middleware\Authenticate;

return function (Router $router) {
   $router->aliasMiddleware('auth', Authenticate::class);
   
   $router->group(['prefix' => '/', 'middleware' => 'auth'], function (Router $router) {
      $router->get('/', [HomeController::class, 'root']);
   });

   $router->group(['prefix' => 'auth'], function (Router $router) {
      $router->post('/register', [AuthController::class, 'Register']);
      $router->post('/login', [AuthController::class, 'Login']);
      $router->post('/refresh-token', [AuthController::class, 'RefreshToken']);
   });
};