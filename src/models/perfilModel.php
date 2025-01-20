<?php

namespace src\Models;

use src\Models\Model;
use src\Models\perfilAcessoModel;

class perfilModel extends Model
{
  public  function __construct()
  {
    parent::__construct();
  }

  public function getPerfis()
  {
    $queryBuilder =  $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->select('*')
        ->from('perfil')
        ->where('id != :id')
        ->setParameter('id', 48);
      $perfis  =  $queryBuilder->execute()->fetchAll();

      return $perfis;
    } catch (\Throwable $th) {
      return;
    }
  }

  public function getPerfil($id)
  {
    $queryBuilder =  $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->select('*')
        ->from('perfil')
        ->where('id = :id')
        ->setParameter('id', $id);
      $perfil  =  $queryBuilder->execute()->fetch();

      return $perfil;
    } catch (\Throwable $th) {
      return;
    }
  }

  public function add($name, $tp_perfil)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $perfil =  $queryBuilder
        ->insert('perfil')
        ->setValue('nome', ':nome')
        ->setValue('tp_perfil', ':tp')
        ->setParameter('nome', $name)
        ->setParameter('tp', $tp_perfil)
        ->execute();

      return $this->conn->lastInsertId();
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function update($id, $nome, $tp_perfil)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->update('perfil')
      ->set('nome', ':nome')
      ->set('tp_perfil', ':tp_perfil')
      ->where('id = :id')
      ->setParameter('nome', $nome)
      ->setParameter('tp_perfil', $tp_perfil)
      ->setParameter('id', $id)
      ->execute();

    // try {
    //   return 'Perfil Alterado com sucesso';
    // } catch (\Throwable $th) {
    //   return 0;
    // }
  }

  public function isExistUsersInPerfil($cod_perfil)
  {
    var_dump($cod_perfil);
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $user = $queryBuilder
        ->select('*')
        ->from('usuario')
        ->where('cod_perfil_acesso = :cod')
        ->setParameter('cod', $cod_perfil)
        ->execute()
        ->fetch();
      if ($user) return true;
      else return false;
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function delete($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    if (!$this->isExistUsersInPerfil($id)) {
      $perfilAcesso = new perfilAcessoModel();
      $perfilAcesso->delete($id);

      $queryBuilder
        ->delete('perfil')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->execute();
      return 1;
    }
    return 'Existem usuários que usam esse perfil, impossivel deletar!';
    // try {


    // } catch (\Throwable $th) {
    //   return 0;
    // }
  }
}
