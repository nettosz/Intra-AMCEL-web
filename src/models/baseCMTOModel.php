<?php

namespace src\Models;

use src\Models\Model;
use src\Schedules\Log;

class baseCMTOModel extends Model
{
  function __construct()
  {
    parent::__construct();
  }

  function setBaseCMTO($titulo, $desc_curta, $descricao, $cod_usuario, $cod_sub_categoria)
  {

    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->insert('base_cmto')
      ->setValue('titulo', '?')
      ->setValue('desc_curta', '?')
      ->setValue('descricao', '?')
      ->setValue('cod_usuario', '?')
      ->setValue('cod_bs_cmto_subcat', '?')
      ->setParameter('0', $titulo)
      ->setParameter('1', $desc_curta)
      ->setParameter('2', $descricao)
      ->setParameter('3', $cod_usuario)
      ->setParameter('4', $cod_sub_categoria);

    try {
      $queryBuilder->execute();
      return 0;
    } catch (\Throwable $th) {

      $errorDetails = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

      Log::addLog(
        $errorDetails['class'],
        $errorDetails['function'],
        $th->getLine(),
        $th->getMessage()
      );

      return $th;

    }
  }

  function getBaseConhecimento($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('base.id, u.nome nome_user,base.titulo, base.desc_curta, base.descricao, base.cod_usuario, base.dt_criacao, sub.id as id_subcat, sub.nome sub_cat, cat.nome, cat.id as id_cat')
      ->from('base_cmto', 'base')
      ->innerJoin('base', 'base_cmto_sub_cat', 'sub', 'sub.id = base.cod_bs_cmto_subcat')
      ->innerJoin('sub', 'base_cmto_cat', 'cat', 'cat.id = sub.cod_categoria')
      ->innerJoin('base', 'usuario', 'u', 'u.id = base.cod_usuario')
      ->where('base.id = :id')
      ->setParameter('id', $id);
    
    return $queryBuilder->execute()->fetch();
  }

  function getTodosBaseConhecimento()
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('base.id, base.titulo, base.desc_curta, base.descricao, base.cod_usuario, base.dt_criacao, sub.nome sub_cat, cat.nome')
      ->from('base_cmto', 'base')
      ->innerJoin('base', 'base_cmto_sub_cat', 'sub', 'sub.id = base.cod_bs_cmto_subcat')
      ->innerJoin('sub', 'base_cmto_cat', 'cat', 'cat.id = sub.cod_categoria')
      ->orderBy('base.dt_criacao', 'DESC');

    return $queryBuilder->execute()->fetchAll();
  }

  function getSearchBaseConhecimento($param)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('base.id, base.titulo, base.desc_curta, base.dt_criacao, sub.nome sub_cat, cat.nome')
      ->from('base_cmto', 'base')
      ->innerJoin('base', 'base_cmto_sub_cat', 'sub', 'sub.id = base.cod_bs_cmto_subcat')
      ->innerJoin('sub', 'base_cmto_cat', 'cat', 'cat.id = sub.cod_categoria')
      ->where('(base.titulo LIKE :param OR  base.desc_curta LIKE :param)')
      ->orWhere('sub.nome LIKE :param')
      ->orWhere('cat.nome LIKE :param')
      ->setParameter(':param', '%' . $param . '%')
      ->orderBy('base.dt_criacao', 'DESC');

    return $queryBuilder->execute()->fetchAll();
  }

  function updateBase($id, $nome, $desc_curta, $descricao, $sub_categoria)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->update('base_cmto')
      ->set('titulo', '?')
      ->set('desc_curta', '?')
      ->set('descricao', '?')
      ->set('cod_bs_cmto_subcat', '?')
      ->where('id = ?')
      ->setParameter('0', $nome)
      ->setParameter('1', $desc_curta)
      ->setParameter('2', $descricao)
      ->setParameter('3', $sub_categoria)
      ->setParameter('4', $id);

    try {
      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  function delete($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->delete('base_cmto')
      ->where('id = ?')
      ->setParameter('0', $id);

    try {
      $queryBuilder->execute();
      return 0;
    } catch (\Throwable $th) {
      return $th;
    }
  }
}
