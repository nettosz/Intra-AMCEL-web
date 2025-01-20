<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\agendamentoSalaModel;
use src\Models\permissaoModel;

class agendamentoSalaController extends Controller
{
  public function index()
  {
    $dados = array(
      "aviso" => '',
      "erro" => '',
      "permissao" => ''
    );
    $agendamento = new agendamentoSalaModel();
    $permissao = new permissaoModel();
    if (!empty($_POST['id'])) {
      $result = $agendamento->delete($_POST['id']);
      if ($result) $dados['success'] = 'Deletado com sucesso';
      else $dados['erro'] = 'Erro ao deletar';
    }

    $dados['permissao'] = $permissao->getPermissao('Salas Agendamento');

    $dados['agendamentos'] = $agendamento->getAgendamentos();

    $this->renderClient(true, 'client\agendamento-sala', $dados);
  }

  public function create()
  {
    $dados = array(
      "success" => '',
      "erro" => ''
    );
    $agendamento = new agendamentoSalaModel();

    $sala = filter_input(INPUT_POST, 'sala', FILTER_SANITIZE_STRIPPED);
    $dataInicio = filter_input(INPUT_POST, 'data_inicio', FILTER_SANITIZE_STRIPPED);
    $dataFim = filter_input(INPUT_POST, 'data_fim', FILTER_SANITIZE_STRIPPED);
    $horaInicio = filter_input(INPUT_POST, 'hora_inicio', FILTER_SANITIZE_STRIPPED);
    $horaFim = filter_input(INPUT_POST, 'hora_fim', FILTER_SANITIZE_STRIPPED);

    if (isset($_POST['sala'])) {
      $data_inicio = $_POST['data_inicio'] . ' ' . $_POST['hora_inicio'] . ':00';
      $result = $agendamento->isExistAgendamento($data_inicio, $_POST['sala']);

      if ($result) {
        $dados['erro'] = 'Já existe agendamento com este periodo!';
      } else {
        $result = $agendamento->add($dataInicio, $horaInicio, $dataFim, $horaFim, $sala);
        if ($result) $dados['success'] = 'Casatrado com sucesso';
        else $dados['erro'] = 'Erro ao cadastrar.';
      }
    }

    $this->renderClient(true, 'client\agendamento-sala-create', $dados);
  }

  public function edit($params)
  {
    $dados = array(
      "success" => '',
      "erro" => ''
    );

    $sala = filter_input(INPUT_POST, 'sala', FILTER_SANITIZE_STRIPPED);
    $dataInicio = filter_input(INPUT_POST, 'data_inicio', FILTER_SANITIZE_STRIPPED);
    $dataFim = filter_input(INPUT_POST, 'data_fim', FILTER_SANITIZE_STRIPPED);
    $horaInicio = filter_input(INPUT_POST, 'hora_inicio', FILTER_SANITIZE_STRIPPED);
    $horaFim = filter_input(INPUT_POST, 'hora_fim', FILTER_SANITIZE_STRIPPED);

    $agendamento = new agendamentoSalaModel();
    if (isset($_POST['sala'])) {
      $data_inicio = $_POST['data_inicio'] . ' ' . $_POST['hora_inicio'] . ':00';
      $result = $agendamento->isExistAgendamento($data_inicio, $_POST['sala'], $params[0]['id']);

      if ($result) {
        $dados['erro'] = 'Já existe agendamento com este periodo!';
      } else {
        $result = $agendamento->update($params[0]['id'], $dataInicio, $horaInicio, $dataFim, $horaFim, $sala);
        if ($result) $dados['success'] = 'alterado com sucesso';
        else $dados['erro'] = 'Erro ao alterar.';
      }
    }
    $dados['agendamento'] = $agendamento->getAgendamento($params[0]['id']);

    $this->renderClient(true, 'client\agendamento-sala-edit', $dados);
  }
}
