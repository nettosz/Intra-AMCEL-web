<?php

namespace src\Models;

use src\Models\Model;
use src\Models\usuarioModel;

class permissaoModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getPermissao($modulo = null)
  {

    $queryBuilder = $this->conn->createQueryBuilder();


    if (!empty($_SESSION['user'])) {
      $usuario = new usuarioModel();
      $perfil = $usuario->getUserPerfil();
      $queryBuilder
        ->select('pa.cod_modulo, pa.cod_modulo_opcao, p.tp_perfil')
        ->from('perfil_acessos', 'pa');
      $queryBuilder
        ->join('pa', 'perfil', 'p', 'p.id = pa.cod_perfil')
        ->where('p.id = :id')
        ->setParameter('id', $perfil);
    } else {
      $queryBuilder
        ->select('pa.*, p.tp_perfil')
        ->from('perfil_acessos', 'pa');
      $queryBuilder
        ->join('pa', 'perfil', 'p', 'p.id = pa.cod_perfil')
        ->where('p.tp_perfil = :tp')
        ->setParameter('tp', 'V');
    }

    if (is_string($modulo)) {
      $queryBuilder
        ->join('pa', 'modulos', 'm', 'm.id = pa.cod_modulo')
        ->andWhere('m.nome = :nome')
        ->setParameter('nome', $modulo);
    }

    return $queryBuilder->execute()->fetchAll();;
  }
}
