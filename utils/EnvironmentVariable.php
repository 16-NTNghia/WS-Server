<?php
namespace Utils;

class EnvironmentVariable
{
   private static $config = [];
   private static $loaded = false;

   public static function load($envPath = null)
   {
      if (!self::$loaded) {
         $path = $envPath ?: __DIR__ . '/../config/env.config.php';
         self::$config = require $path;
         self::$loaded = true;
      }
      return self::$config;
   }

   public static function get($key, $default = null)
   {
      $config = self::load();
      $keys = explode('.', $key);
      $value = $config;

      foreach ($keys as $k) {
         if (isset($value[$k])) {
            $value = $value[$k];
         } else {
            return $default;
         }
      }
      return $value;
   }
}