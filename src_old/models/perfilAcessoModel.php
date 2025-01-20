<?php

namespace src\Models;

use src\Models\Model;

class perfilAcessoModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function add($cod_perfil, $cod_modulo, $cod_modulo_op)
  {
    $queryBuilder = $this->conn->createQueryBuilder();


    try {
      $queryBuilder
        ->insert('perfil_acessos')
        ->setValue('cod_perfil', ':codPerfil')
        ->setValue('cod_modulo', ':codModulo')
        ->setValue('cod_modulo_opcao', ':codModuloOp')
        ->setParameter('codPerfil', $cod_perfil)
        ->setParameter('codModulo', $cod_modulo)
        ->setParameter('codModuloOp', $cod_modulo_op)
        ->execute();

      return;
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function getPerfilAcesso($cod_perfil)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      return $queryBuilder
        ->select('cod_modulo, cod_modulo_opcao')
        ->from('perfil_acessos')
        ->where('cod_perfil = :cod_perfil')
        ->setParameter('cod_perfil', $cod_perfil)
        ->execute()
        ->fetchAll();
    } catch (\Throwable $th) {
      return;
    }
  }

  public function delete($cod_perfil)
  {

    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->delete('perfil_acessos')
        ->where('cod_perfil = :cod_perfil')
        ->setParameter('cod_perfil', $cod_perfil);

      $queryBuilder->execute();
    } catch (\Throwable $th) {
      return;
    }
  }
}
