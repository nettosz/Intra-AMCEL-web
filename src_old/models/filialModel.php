<?php

use src\Models\Model;

class filialModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function add(string $nome, int $numero)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->insert('filiais')
      ->setValue('nome', ':nome')
      ->setValue('numero', ':numero')
      ->setParameter(':nome', $nome)
      ->setParameter(':numero', $numero);

    try {

      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function edit(int $id, string $nome, int $numero)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $queryBuilder
      ->update('filiais')
      ->set('nome', ':nome')
      ->set('numero', ':numero')
      ->where('id = :id')
      ->setParameter(':nome', $nome)
      ->setParameter(':numero', $numero)
      ->setParameter(':id', $id);

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
      ->delete('filiais')
      ->where('id = :id')
      ->setParameter(':id', $id);
    try {
      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getFiliais()
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('filiais');
    try {

      $filiais = $queryBuilder->execute()->fetchAll();
      return $filiais;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getFilial(int $id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('filiais')
      ->where('id = :id')
      ->setParameter(':id', $id);
    try {

      $filial = $queryBuilder->execute()->fetch();
      return $filial;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
