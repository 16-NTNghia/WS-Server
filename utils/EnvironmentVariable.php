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

      if (is_string($value) && preg_match('/^(\d+)([smhd])$/', $value, $matches)) {
         return self::parseDuration($value);
      }

      return $value;
   }

   private static function parseDuration($duration)
   {
      if (!preg_match('/^(\d+)([smhd])$/', $duration, $matches)) {
         throw new \Exception("Định dạng thời gian không hợp lệ: $duration");
      }

      $value = (int) $matches[1];
      $unit = $matches[2];

      switch ($unit) {
         case 's':
            return $value;
         case 'm':
            return $value * 60;
         case 'h':
            return $value * 3600;
         case 'd':
            return $value * 86400;
         default:
            throw new \Exception("Đơn vị thời gian không hợp lệ: $unit");
      }
   }
}