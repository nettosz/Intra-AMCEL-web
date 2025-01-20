<?php

use src\Models\Model;

class Perfil extends Model
{
  private function __construct()
  {
    parent::__construct();
  }

  public function add($name, $emails)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->insert('perfil')
        ->setValue('nome', ':nome')
        ->setParameter('nome', $name)
        ->execute();

      return $queryBuilder;
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function update($id, $nome, $status)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->update('perfil')
        ->set('nome', ':nome')
        ->set('status', ':status')
        ->where('id', ':id')
        ->setParameter('nome', $nome)
        ->setParameter('status', $status)
        ->setParameter('id', $id)
        ->execute();
      return 1;
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function delete($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->delete('perfil')
        ->where('id', ':id')
        ->setParameter('id', $id)
        ->execute();
      return 1;
    } catch (\Throwable $th) {
      return 0;
    }
  }
}
