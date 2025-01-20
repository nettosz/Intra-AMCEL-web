<?php

namespace src\Models;

use src\Models\Model;

class agendamentoSalaEmailModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAgendamentoEmails()
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $emails = $queryBuilder
      ->select('*')
      ->from('agendamento_sala_emails')
      ->execute()->fetchAll();

    return $emails;
  }

  public function getAgendamentoEmail($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $email = $queryBuilder
      ->select('*')
      ->from('agendamento_sala_emails')
      ->where('id = :id')
      ->setParameter('id', $id)
      ->execute()
      ->fetch();

    return $email;
  }

  public function isExistEmail($email)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $email = $queryBuilder
      ->select('*')
      ->from('agendamento_sala_emails')
      ->where('email = :email')
      ->setParameter('email', $email)
      ->execute()
      ->fetch();

    if ($email) return true;
    else return false;
  }
  public function add($email)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->insert('agendamento_sala_emails')
      ->setValue('email', ':email')
      ->setParameter('email', $email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return 'Email Inválido';
    if ($this->isExistEmail($email)) return 'Email já existe';

    try {
      $queryBuilder->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function edit($email, $id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->update('agendamento_sala_emails')
      ->set('email', ':email')
      ->where('id = :id')
      ->setParameter('email', $email)
      ->setParameter('id', $id);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return 'Email Inválido';
    if ($this->isExistEmail($email)) return 'Email já existe';

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
        ->delete('agendamento_sala_emails')
        ->where('id =:id')
        ->setParameter('id', $id)
        ->execute();

      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
