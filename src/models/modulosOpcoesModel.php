<?php

namespace src\Models;

use src\Models\Model;

class modulosOpcoesModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getModulosOpcoes()
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('modulos_opcoes');

    $modulosOpcoes  = $queryBuilder->execute()->fetchAll();

    return $modulosOpcoes;
  }
}
