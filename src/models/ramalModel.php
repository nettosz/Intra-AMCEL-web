<?php

namespace src\Models;

use src\Models\Model;
use src\models\usuarioModel;

class ramalModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function add(
    string $nome,
    string $ramal,
    string $celular
  ) {
    $usuario  = new usuarioModel();
    $queryBuilder = $this->conn->createQueryBuilder();

    $cod_usuario = $usuario->getID();

    $queryBuilder
      ->insert('ramais_numeros')
      ->setValue('nome', ':nome')
      ->setValue('ramal', ':ramal')
      ->setValue('celular', ':celular')
      ->setValue('cod_usuario', ':cod_usuario')
      ->setParameter('nome', $nome)
      ->setParameter('ramal', $ramal)
      ->setParameter('celular', $celular)
      ->setParameter('cod_usuario', $cod_usuario);

    try {
      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function edit(
    string $nome,
    string $ramal,
    string $celular,
    int $id
  ) {
    $usuario  = new usuarioModel();
    $queryBuilder = $this->conn->createQueryBuilder();

    $cod_usuario = $usuario->getID();

    $queryBuilder
      ->update('ramais_numeros')
      ->set('nome', ':nome')
      ->set('ramal', ':ramal')
      ->set('celular', ':celular')
      ->where('id = :id')
      ->setParameter('nome', $nome)
      ->setParameter('ramal', $ramal)
      ->setParameter('celular', $celular)
      ->setParameter('cod_usuario', $cod_usuario)
      ->setParameter('id', $id);

    try {
      $queryBuilder->execute();
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
        ->delete('ramais_numeros')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getRamalNumero($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    try {

      $ramalNumero = $queryBuilder
        ->select('*')
        ->from('ramais_numeros')
        ->where('id = :id')
        ->setParameter('id', $id)
        ->execute()
        ->fetch();
      return $ramalNumero;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getRamaisNumeros()
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('ramais_numeros');


    try {
      $ramaisNumeros = $queryBuilder->execute()
        ->fetchAll();
      return $ramaisNumeros;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
