<?php

namespace src\Models;

use src\Models\Model;

class departamentoModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getDepartamentos()
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $queryBuilder
      ->select('*')
      ->from('departamentos');
    try {
      $departamentos = $queryBuilder->execute()->fetchAll();
      return $departamentos;
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function getDepartamento(int $id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $queryBuilder
        ->select('*')
        ->from('departamentos')
        ->where('id = :id')
        ->setParameter('id', $id);
      $departamento  = $queryBuilder->execute()->fetch();

      return $departamento;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function add($nome): bool
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $queryBuilder
        ->insert('departamentos')
        ->setValue('nome', ':nome')
        ->setParameter('nome', $nome)
        ->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function edit(int $id, string $nome): bool
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $queryBuilder
      ->update('departamentos')
      ->set('nome', ':nome')
      ->where('id = :id')
      ->setParameter('nome', $nome)
      ->setParameter('id', $id);
    try {
      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function delete(int $id): bool
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $queryBuilder
        ->delete('departamentos')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
