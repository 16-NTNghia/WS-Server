<?php
use Illuminate\Routing\Router;
use WorkSpace\Controller\AnhMoiController;
use WorkSpace\Controller\AuthController;

return function (Router $router) {
   $router->group(['prefix' => 'anh-moi'], function (Router $router) {
      $router->get('/', [AnhMoiController::class, 'getAnhMois']);
      $router->get('/{id}', [AnhMoiController::class, 'getAnhMoiByID']);
      $router->post('/', [AnhMoiController::class, 'createAnhMoi']);
   });

   $router->group(['prefix' => 'auth'], function (Router $router) {
      $router->post('/register', [AuthController::class, 'Register']);
   });
};