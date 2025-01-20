<?php

namespace src\Models;

use src\Models\Model;

class politicasModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getPoliticas()
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $politicas = $queryBuilder
      ->select('*')
      ->from('politicas')
      ->execute()
      ->fetchAll();

    return $politicas;
  }


  public function save($titulo, $file_name_pt, $file_name_en)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->insert('politicas')
        ->setValue('titulo', ':titulo')
        ->setValue('nome_arquivo', ':nome_arquivo')
        ->setValue('nome_arquivo_en', ':nome_arquivo_en')
        ->setParameter('titulo', $titulo)
        ->setParameter('nome_arquivo', $file_name_pt)
        ->setParameter('nome_arquivo_en', $file_name_en)
        ->execute();

      return $this->conn->lastInsertId();
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function update($titulo, $nome_arquivo, $nome_arquivo_en, $id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->update('politicas')
        ->set('titulo', ':titulo');

      if (!!$nome_arquivo) {
        $queryBuilder
          ->set('nome_arquivo', ':nome_arquivo')
          ->setParameter('nome_arquivo', $nome_arquivo);
      }

      if (!!$nome_arquivo_en) {
        $queryBuilder
          ->set('nome_arquivo_en', ':nome_arquivo_en')
          ->setParameter('nome_arquivo_en', $nome_arquivo_en);
      }

      $queryBuilder
        ->where('id = :id')
        ->setParameter('titulo', $titulo)
        ->setParameter('id', $id)
        ->execute();

      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function delete($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $queryBuilder
        ->delete('politicas')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getPolitica($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $politica = $queryBuilder
      ->select('*')
      ->from('politicas')
      ->where('id =:id')
      ->setParameter('id', $id)
      ->execute()
      ->fetch();

    return $politica;
  }
}
