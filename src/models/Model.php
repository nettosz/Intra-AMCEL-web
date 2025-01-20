<?php

namespace src\Models;

class Model
{
  protected $conn;

  function __construct()
  {
    $connectionParams = array(
      "dbname" => $_ENV['DB_NAME'],
      "user" => $_ENV['DB_USERNAME'],
      "password" => $_ENV['DB_PASS'],
      "host" => $_ENV['DB_HOST'],
      "driver" => "pdo_mysql"
    );
    $this->conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
  }
}
