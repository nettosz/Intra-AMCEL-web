<?php

namespace src\Models;

use src\Models\Model;

class categoriasModel extends Model
{

  public $tableParam;


  function __construct()
  {
    parent::__construct();
    $this->setTableName(isset($_GET['table']) ? $_GET['table']  : '');
  }

  function setTableName($tableName)
  {
    $this->tableName = $tableName;
  }

  function tableName()
  {
    $tableName = '';
    if ($this->tableName === 'video') {
      $tableName = 'video_categoria';
    } else if ($this->tableName === 'base_conhecimento') {
      $tableName = 'base_cmto_cat';
    }

    return $tableName;
  }

  function setCategoria($nome)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->insert($this->tableName())
      ->setValue('nome', '?')
      ->setParameter('0', $nome);

    try {
      $queryBuilder->execute();
    } catch (\Throwable $th) {
      return $th;
    }
  }

  function deleteCategoria($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->delete($this->tableName())
      ->where('id = ?')
      ->setParameter('0', $id);

      
    try {
        $queryBuilder->execute();
    } catch (\Throwable $th) {
      return $th;
    }
  }

  function updateCategoria($id, $nome)
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
      return $th;
    }
  }

  function getCategoria($id, $tableName)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $table = '';
    if ($this->tableName() <> '') {
      $table = $this->tableName();
    } else {
      $table = $tableName;
    }

    $queryBuilder
      ->select('*')
      ->from($table)
      ->where('id = ?')
      ->setParameter('0', $id);

    $categoria = $queryBuilder->execute()->fetchAll();

    try {
      return $categoria;
    } catch (\Throwable $th) {
      return $th;
    }
  }

  function getTodasCategorias($tableName)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $table = '';
    if ($this->tableName() <> '') {
      $table = $this->tableName();
    } else {
      $table = $tableName;
    }
    $queryBuilder
      ->select('*')
      ->from($table);

    $dados = $queryBuilder->execute()->fetchAll();
    try {
      return $dados;
    } catch (\Throwable $th) {
      return $th;
    }
  }
}
