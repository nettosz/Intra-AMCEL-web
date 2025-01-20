<?php

namespace src\Models;

use src\Models\Model;
use src\models\usuarioModel;
use src\Models\agendamentoSalaEmailModel;

class agendamentoSalaModel extends Model
{
  public function  __construct()
  {
    parent::__construct();
  }

  public function isExistAgendamento($data_inicio, $sala, $id_agendamento = null)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('agendamento_sala', 'agenda')
      ->where('(agenda.dt_fim BETWEEN :dataInicio AND agenda.dt_fim or agenda.dt_inicio BETWEEN :dataInicio AND agenda.dt_inicio) AND agenda.cod_sala_reuniao = :sala and agenda.deletado is null');

    if ($id_agendamento <> null) {
      $queryBuilder
        ->andWhere('id <> :id')
        ->setParameter('id', $id_agendamento);
    }

    $queryBuilder
      ->setParameter('dataInicio', $data_inicio)
      ->setParameter('sala', $sala);

    try {
      $agendamento = $queryBuilder->execute()->fetch();
      if ($agendamento) return true;
      else return false;
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function getAgendamentos()
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $agendamentos  = $queryBuilder
      ->select('agenda.*, u.nome, sl.numero')
      ->from('agendamento_sala', 'agenda')
      ->join('agenda', 'usuario', 'u', 'u.id = agenda.cod_usuario')
      ->join('agenda', 'salas_reuniao', 'sl', 'sl.id = agenda.cod_sala_reuniao')
      ->where('agenda.deletado is null')
      ->execute()->fetchAll();

    return $agendamentos;
  }

  public function getAgendamento($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $agendamento  = $queryBuilder
      ->select('agenda.*')
      ->from('agendamento_sala', 'agenda')
      ->where('agenda.deletado is null and id =:id')
      ->setParameter('id', $id)
      ->execute()->fetch();

    return $agendamento;
  }

  public function add($data_inicio, $hora_inicio, $data_fim, $hora_fim, $sala)
  {
    $loader = new \Twig\Loader\FilesystemLoader(TEMPLATES_PATH);
    $twig = new \Twig\Environment($loader);

    $usuario = new usuarioModel();
    $agendamentoEmails = new agendamentoSalaEmailModel();

    $queryBuilder = $this->conn->createQueryBuilder();
    $data_inicio_hora = $data_inicio . ' ' . $hora_inicio . ':00';
    $data_fim_hora = $data_fim . ' ' . $hora_fim . ':00';

    $emailAgendamento = $agendamentoEmails->getAgendamentoEmails();
    $emails = [];

    if ($emailAgendamento) {
      foreach ($emailAgendamento as $email) {
        array_push($emails, $email['email']);
      }
    }

    $user = unserialize($_SESSION['user']);
    $userID = $usuario->getID();
    $usuarioNome = $user->getName();

    try {

      $queryBuilder
        ->insert('agendamento_sala')
        ->setValue('dt_inicio', ':dataInicio')
        ->setValue('dt_fim', ':dataFim')
        ->setValue('cod_usuario', ':usuario')
        ->setValue('cod_sala_reuniao', ':sala')
        ->setParameter('dataInicio', $data_inicio_hora)
        ->setParameter('dataFim', $data_fim_hora)
        ->setParameter('usuario', $userID)
        ->setParameter('sala', $sala)
        ->execute();

      if (isset($emails[0])) {
        $transport = (new \Swift_SmtpTransport($_ENV['EMAIL_SMTP'], 465, 'ssl'))
          ->setUsername($_ENV['EMAIL_USERNAME'])
          ->setPassword($_ENV['EMAIL_PASSWORD']);

        $mailer = new \Swift_Mailer($transport);

        $message = (new \Swift_Message('Agendamento de sala'))
          ->setFrom([$_ENV['EMAIL_USERNAME']])
          ->setTo($emails)
          ->setBody('Solicitação de criação de perfil')
          ->addPart($twig->render(
            'emails\agendamento-criado.html',
            [
              'data_inicio' => date('d/m/Y', strtotime($data_inicio)),
              'data_fim' => date('d/m/Y', strtotime($data_fim)),
              'hora_inicio' => date('H:i:s', strtotime($hora_inicio)),
              'hora_fim' => date('H:i:s', strtotime($hora_fim)),
              'sala' => $sala,
              'usuario' => $usuarioNome
            ]
          ), 'text/html');

        $result = $mailer->send($message);
      }

      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function update($cod_agendamento, $data_inicio, $hora_inicio, $data_fim, $hora_fim, $sala)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $data_inicio_hora = $data_inicio . ' ' . $hora_inicio . ':00';
    $data_fim_hora = $data_fim . ' ' . $hora_fim . ':00';
    $usuario = new usuarioModel();
    $userID = $usuario->getID();

    $queryBuilder
      ->update('agendamento_sala')
      ->set('dt_inicio', ':dataInicio')
      ->set('dt_fim', ':dataFim')
      ->set('cod_usu_update', ':usuario')
      ->set('cod_sala_reuniao', ':sala')
      ->where('id = :id')
      ->setParameter('dataInicio', $data_inicio_hora)
      ->setParameter('dataFim', $data_fim_hora)
      ->setParameter('usuario', $userID)
      ->setParameter('sala', $sala)
      ->setParameter('id', $cod_agendamento)
      ->execute();
    try {

      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function delete($id)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $usuario = new usuarioModel();
    $userID = $usuario->getID();

    try {
      $queryBuilder
        ->update('agendamento_sala')
        ->set('deletado', ':deletado')
        ->set('cod_usu_deletado', ':cod_usu')
        ->where('id = :id')
        ->setParameter('deletado', 'S')
        ->setParameter('cod_usu', $userID)
        ->setParameter('id', $id)
        ->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
