<?php

namespace src\utils;

use \Firebase\JWT\JWT;

class jwtAuth
{

  static function decode($token)
  {
    return JWT::decode($token, $_ENV['SECRET'], array('HS256'));
  }
  static function encode($data)
  {

    return JWT::encode($data, $_ENV['SECRET'], 'HS256');
  }
}
