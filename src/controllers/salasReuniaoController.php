<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\SalaReuniao;

class salasReuniaoController extends Controller
{
  public function index()
  {
    $dados = array(
      "success" => '',
      "error" => ''
    );

    $salaReuniao = new SalaReuniao();

    $dados['salas'] = $salaReuniao->getSalas();

    $this->renderAjax('salas', $dados);
  }

  public function store()
  {
    $dados = array(
      "success" => 'Salvo com sucesso',
      'error' => "erro ao Salvar"
    );

    $salaReuniao = new SalaReuniao();
    $result = $salaReuniao->add($_POST['numero']);

    if ($result) echo json_encode(["sucess" => $dados['success']]);
    else echo json_encode(["error" => $dados['error']]);
  }

  public function update($params)
  {
    $dados = array(
      "success" => 'Alterado com sucesso',
      'error' => "erro ao alterar"
    );

    $salaReuniao = new SalaReuniao();
    $result = $salaReuniao->edit($params[0]['id']);

    if ($result) echo json_encode($dados['success']);
    else echo json_encode($dados['error']);
  }

  public function destroy($params)
  {
    $dados = array(
      "success"  => 'Deletado com sucesso!',
      'error' => 'Erro ao deletar!'
    );

    $salaReuniao = new SalaReuniao();
    $result = $salaReuniao->delete($params[0]['id']);
    if ($result) echo json_encode($dados['success']);
    else echo json_encode($dados['error']);
  }
}
