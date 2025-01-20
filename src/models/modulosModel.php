<?php

namespace src\Models;

use src\Models\Model;

class modulosModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getModulos()
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('modulos');

    $modulos  = $queryBuilder->execute()->fetchAll();

    return $modulos;
  }

  public function getModuleByName(string $name)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('modulos')
      ->where('nome =:nome')
      ->setParameter('nome', $name);

    $modulos  = $queryBuilder->execute()->fetch();

    return $modulos;
  }
}
