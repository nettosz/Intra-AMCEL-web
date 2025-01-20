<?php

namespace src\Models;

use src\Models\Model;

class cargosModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getCargosDepartamento(int $cod_departamento)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $queryBuilder
      ->select('*')
      ->from('cargos')
      ->where('cod_departamento = :codDep')
      ->setParameter('codDep', $cod_departamento);

    try {
      $cargos = $queryBuilder->execute()->fetchAll();
      return $cargos;
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function getCargo(int $id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $cargo = $queryBuilder
        ->select('*')
        ->from('cargos')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->execute()
        ->fetch();
      return $cargo;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getCargos()
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {

      $cargos =
        $queryBuilder
        ->select('c.id, c.nome as nome_cargo, d.nome as nome_departamento')
        ->from('cargos', 'c')
        ->innerJoin('c', 'departamentos', 'd', 'd.id = c.cod_departamento')
        ->execute()
        ->fetchAll();

      return $cargos;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function add(string $cargo, string $id_departamento)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $queryBuilder
      ->insert('cargos')
      ->setValue('nome', ':nome')
      ->setValue('cod_departamento', ':cod')
      ->setParameter('nome', $cargo)
      ->setParameter('cod', $id_departamento);

    try {
      $queryBuilder->execute();
      return true;
    } catch (\Exception $th) {
      return false;
    }
  }

  public function edit(int $id, string $cargo, int $cod_departamento)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->update('cargos')
      ->set('nome', ':nome')
      ->set('cod_departamento', ':cod')
      ->where('id = :id')
      ->setParameter('nome', $cargo)
      ->setParameter('cod', $cod_departamento)
      ->setParameter('id', $id);

    try {
      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function delete(int $id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $queryBuilder
      ->delete('cargos')
      ->where('id = :id')
      ->setParameter('id', $id);
    try {
      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
