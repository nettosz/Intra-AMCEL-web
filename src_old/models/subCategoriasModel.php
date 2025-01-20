<?php

namespace src\Models;

use src\Models\Model;

class subCategoriasModel extends Model
{

  protected $tableParam;


  function __construct()
  {
    parent::__construct();
    $this->setTableName($_GET['table']);
  }

  function setTableName($tableName)
  {
    $this->tableName = $tableName;
  }

  function tableName()
  {
    $tableName = '';
    if ($this->tableName === 'video') {
      $tableName = 'video_sub_categoria';
    } else if ($this->tableName === 'base_conhecimento') {
      $tableName = 'base_cmto_sub_cat';
    }

    return $tableName;
  }

  function setSubCategoria($nome, $id_categoria)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->insert($this->tableName())
      ->setValue('nome', '?')
      ->setValue('cod_categoria', $id_categoria)
      ->setParameter('0', $nome);

    try {
      $queryBuilder->execute();
    } catch (\Throwable $th) {
      return 0;
    }
  }

  function deleteSubCategoria($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->delete($this->tableName())
      ->where('id = ?')
      ->setParameter('0', $id);

    try {
      $queryBuilder->execute();
    } catch (\Throwable $th) {
      return 0;
    }
  }

  function updateSubCategoria($id, $nome)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $queryBuilder
      ->update($this->tableName())
      ->set('nome', '?')
      ->where('id = ?')
      ->setParameter('0', $nome)
      ->setParameter('1', $id);

    try {
      $queryBuilder->execute();
    } catch (\Throwable $th) {
      return 0;
    }
  }

  function getSubCategoria($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from($this->tableName())
      ->where('id = ?')
      ->setParameter('0', $id);

    try {
      $queryBuilder->execute();
    } catch (\Throwable $th) {
      return $th;
    }
  }

  function getTodasSubCategorias($id_categoria)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from($this->tableName())
      ->where('cod_categoria = ?')
      ->setParameter('0', $id_categoria);

    $sub_categorias = $queryBuilder->execute()->fetchAll();
    try {
      return $sub_categorias;
    } catch (\Throwable $th) {

      return 0;
    }
  }
}
