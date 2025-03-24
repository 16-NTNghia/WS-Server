<?php
namespace WorkSpace\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController
{
   public function root(Request $request)
   {
      print_r($request->attributes->get('user'));
      return $request->attributes->get('user');
      // return '🚀 WS-Server is running 🚀';
   }
}