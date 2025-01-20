<?php

namespace src\Models;

use src\Models\Model;

class noticiasModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getNoticias()
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $noticias = $queryBuilder
      ->select('*')
      ->from('noticias')
      ->execute()
      ->fetchAll();

    return $noticias;
  }

  public function save($titulo, $file_name, $link, $slide)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->insert('noticias')
        ->setValue('titulo', ':titulo')
        ->setValue('nome_arquivo', ':nome_arquivo')
        ->setValue('link', ':link')
        ->setValue('slide', ':slide')
        ->setParameter('titulo', $titulo)
        ->setParameter('nome_arquivo', $file_name)
        ->setParameter('link', $link)
        ->setParameter('slide', $slide)
        ->execute();

      return $this->conn->lastInsertId();
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function update($titulo, $nome_arquivo, $slide, $link, $id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {
      $queryBuilder
        ->update('noticias')
        ->set('titulo', ':titulo')
        ->setParameter('titulo', $titulo);

      if (!!$nome_arquivo) {
        $queryBuilder
          ->set('nome_arquivo', ':nome_arquivo')
          ->setParameter('nome_arquivo', $nome_arquivo);
      }

      $queryBuilder
        ->set('slide', ':slide')
        ->setParameter('slide', $slide)
        ->set('link', ':link')
        ->setParameter('link', $link);

      $queryBuilder
        ->where('id = :id')
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
        ->delete('noticias')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getNoticia($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $politica = $queryBuilder
      ->select('*')
      ->from('noticias')
      ->where('id =:id')
      ->setParameter('id', $id)
      ->execute()
      ->fetch();

    return $politica;
  }
}
