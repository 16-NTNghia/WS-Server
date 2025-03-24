<?php
use Illuminate\Routing\Router;
use WorkSpace\Controller\AuthController;
use WorkSpace\Controller\HomeController;

return function (Router $router) {
   $router->group(['prefix' => '/'], function (Router $router) {
      $router->get('/', [HomeController::class, 'root']);
   });

   $router->group(['prefix' => 'auth'], function (Router $router) {
      $router->post('/register', [AuthController::class, 'Register']);
      $router->post('/login', [AuthController::class, 'Login']);
   });
};