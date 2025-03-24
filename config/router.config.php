<?php
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\JsonResponse;
use Illuminate\Container\Container;

function RouterConfig()
{
   $container = new Container();

   $router = new Router(new \Illuminate\Events\Dispatcher(), $container);

   $routes = require __DIR__ . '/../routes/API.php';
   $routes($router);

   // Xử lý request
   $request = Request::createFromGlobals();
   $container->instance('Illuminate\Http\Request', $request);
   try {
      $response = $router->dispatch($request);
   } catch (NotFoundHttpException $e) {
      $response = new JsonResponse([
         'message' => 'Route not found',
         'status' => 404
      ], 404);
   }

   // Gửi response
   $response->send();
}

RouterConfig();