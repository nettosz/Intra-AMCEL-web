<?php

namespace src\Models;

use \Exception;
use src\Models\Model;
use src\Schedules\Log;

class videoModel extends Model
{
  function __construct()
  {
    parent::__construct();
  }

  function setVideo($nome, $descricao, $sub_categoria, $url, $id_usuario)
  {

    $queryBuilder = $this->conn->createQueryBuilder();

    $newUrl = $this->getURLEmbed($url);

    $queryBuilder
      ->insert('videos')
      ->setValue('nome', '?')
      ->setValue('descricao', '?')
      ->setValue('cod_sub_categoria', '?')
      ->setValue('url', '?')
      ->setValue('id_usuario', '?')
      ->setParameter('0', $nome)
      ->setParameter('1', $descricao)
      ->setParameter('2', $sub_categoria)
      ->setParameter('3', $newUrl)
      ->setParameter('4', $id_usuario);

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

  function getVideo($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('v.id, v.nome , v.dt_criacao, v.url, v.descricao, sub.id id_sub, cat.id id_cat')
      ->from('videos', 'v')
      ->innerJoin('v', 'video_sub_categoria', 'sub', 'sub.id = v.cod_sub_categoria')
      ->innerJoin('sub', 'video_categoria', 'cat', 'cat.id = sub.cod_categoria')
      ->where('v.id = :id')
      ->setParameter('id', $id);

    return $queryBuilder->execute()->fetch();
  }

  function getAllVideos()
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('v.id, v.nome as nome_video, v.dt_criacao, v.url, v.descricao, v.id_usuario, sub.nome sub_cat, cat.nome')
      ->from('videos', 'v')
      ->innerJoin('v', 'video_sub_categoria', 'sub', 'sub.id = v.cod_sub_categoria')
      ->innerJoin('sub', 'video_categoria', 'cat', 'cat.id = sub.cod_categoria');
    return $queryBuilder->execute()->fetchAll();
  }

  function updateVideo($id, $nome, $descricao, $sub_categoria, $url)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->update('videos')
      ->set('nome', ':nome')
      ->set('descricao', ':desc')
      ->set('cod_sub_categoria', ':cod');

    if ($url !== '') {
      $queryBuilder->set('url', ':url')
        ->setParameter('url', $url);
    }

    $queryBuilder
      ->where('id = :id')
      ->setParameter('nome', $nome)
      ->setParameter('desc', $descricao)
      ->setParameter('cod', $sub_categoria)
      ->setParameter('id', $id);

    try {
      $queryBuilder->execute();
      return 0;
    } catch (\Throwable $th) {
      return $th;
    }
  }
  function searchVideo($param)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $videos =
      $queryBuilder
      ->select('v.id, v.nome as nome_video, v.dt_criacao, v.url, v.descricao, v.id_usuario, sub.nome sub_cat, cat.nome')
      ->from('videos', 'v')
      ->innerJoin('v', 'video_sub_categoria', 'sub', 'sub.id = v.cod_sub_categoria')
      ->innerJoin('sub', 'video_categoria', 'cat', 'cat.id = sub.cod_categoria')
      ->where('(v.nome LIKE :param OR  v.descricao LIKE :param)')
      ->orWhere('sub.nome LIKE :param')
      ->orWhere('cat.nome LIKE :param')
      ->setParameter(':param', '%' . $param . '%')
      ->orderBy('v.dt_criacao', 'DESC')
      ->execute()->fetchAll();

    return $videos;
  }
  function deleteVideo($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->delete('videos')
      ->where('id = ?')
      ->setParameter('0', $id);

    try {
      $queryBuilder->execute();
      return 0;
    } catch (Exception $th) {

      $errorDetails = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

      Log::addLog(
        $errorDetails['class'],
        $errorDetails['function'],
        $th->getLine(),
        $th->getMessage()
      );

      return false;
    }
  }

  function getURLEmbed($url)
  {
    $url = str_replace('watch?v=', 'embed/', $url);
    return $url;
  }
}
