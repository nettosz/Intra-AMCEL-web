<?php

namespace src\Models;

use src\Models\Model;
use src\utils\jwtAuth;

class loginModel extends Model
{
  function __construct()
  {
    parent::__construct();
  }

  function getUser($login, $senha)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('users')
      ->where('login = ? and senha = ? ')
      ->setParameter('0', $login)
      ->setParameter('2', $senha);

    $result = $queryBuilder->execute()->fetch();

    if ($result) {
      $token = jwtAuth::encode($result, 'oloco');
      setcookie('USER_TOKEN', $token);

      header("Location: http://" . $_ENV['HOST'] . "/intra-amcel-web/home");
    }

    return $this->userExists($login);
  }

  function userExists($login)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('users')
      ->where('login = ? ')
      ->setParameter('0', $login);

    $result = $queryBuilder->execute()->fetch();

    if (!$result) {
      return 'Usário não existe!';
    } else {
      return 'Senha Inválida!';
    }
  }
}
