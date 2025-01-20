<?php

namespace src\Controllers\Admin;

use src\Models\agendamentoSalaEmailModel;
use src\Controllers\Controller;

class adminAgendamentoEmailController extends Controller
{
  public function index()
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );

    $agendamentoSalaEmail = new agendamentoSalaEmailModel();

    if (!empty($_POST['id'])) {
      $result = $agendamentoSalaEmail->delete($_POST['id']);
      if ($result) $dados['success'] = 'deletado com sucesso';
      else  $dados['erro'] = 'Erro ao deletar';
    }

    $dados['emails'] = $agendamentoSalaEmail->getAgendamentoEmails();

    $this->renderAdmin(true, 'admin\agendamento-emails\index', $dados);
  }

  public function update($params)
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );

    $agendamentoSalaEmail = new agendamentoSalaEmailModel();

    if (!empty($_POST['email'])) {

      $agendamentoSalaEmail = new agendamentoSalaEmailModel();
      $result  = $agendamentoSalaEmail->edit($_POST['email'], $params[0]['id']);

      if (is_string($result)) $dados['erro'] = $result;
      elseif (is_bool($result))
        if ($result) $dados['success'] = 'Alterado com sucesso';
        else  $dados['erro'] = 'Erro ao Alterar';
    }
    $dados['email'] =  $agendamentoSalaEmail->getAgendamentoEmail($params[0]['id']);

    $this->renderAdmin(true, 'admin\agendamento-emails\edit', $dados);
  }

  public function create()
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );

    if (!empty($_POST['email'])) {
      $agendamentoSalaEmail = new agendamentoSalaEmailModel();
      $result  = $agendamentoSalaEmail->add($_POST['email']);

      if (is_string($result)) $dados['erro'] = $result;
      elseif (is_bool($result))
        if ($result) $dados['success'] = 'Salvo com sucesso';
        else  $dados['erro'] = 'Erro ao salvar';
    }

    $this->renderAdmin(true, 'admin\agendamento-emails\create', $dados);
  }
}
