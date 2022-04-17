<?php

namespace App\Config;

use Exception;
use PDO;

class DBConnector
{

  private static $pdo;

  public static function connect()
  {
    try {
      $host = $_ENV['DB_HOST'];
      $db = $_ENV['DB_DATABASE'];
      $user = $_ENV['DB_USER'];
      $password = $_ENV['DB_PASSWORD'];
      $port = $_ENV['DB_PORT'];

      self::$pdo = new PDO("mysql:dbname=$db;host=$host;port=$port;charset=utf8", $user, $password);
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return self::$pdo;
    } catch (\Throwable $th) {
      throw new Exception('Database Error: ' . $th);
    }
  }

  public static function close()
  {
    self::$pdo = null;
  }
}
