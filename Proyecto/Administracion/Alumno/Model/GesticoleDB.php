<?php

abstract class GesticoleDB {
  private static $server = 'mysql.hostinger.es';
  private static $db = 'u368726118_gesti';
  private static $user = 'u368726118_root';
  private static $password = 'gesti_root';

  public static function connectDB() {
    try {
      $connection = new PDO("mysql:host=".self::$server.";dbname=".self::$db.";charset=utf8", self::$user, self::$password);
    } catch (PDOException $e) {
      echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
      die ("Error: " . $e->getMessage());
    }
 
    return $connection;
  }
}
