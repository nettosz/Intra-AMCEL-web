<?php

namespace src\Models;

use src\Models\Model;

class SalaReuniao extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function add($number)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->insert('salas_reuniao')
      ->setValue('numero', ':num')
      ->setParameter('num', $number);
    try {
      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function edit($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->update('salas_reuniao')
      ->set('numero', ':numero')
      ->where('id = :id ')
      ->setParameter('id', $id);

    try {
      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getSalas()
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $queryBuilder
      ->select('id, numero')
      ->from('salas_reuniao');

    try {
      $salas  = $queryBuilder->execute()->fetchAll();
      return $salas;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getSala($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('salas_reuniao')
      ->where('id = :id')
      ->setParameter('id', $id);

    try {
      $sala = $queryBuilder->execute()->fetch();
      return $sala;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function delete($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->delete('salas_reuniao')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
