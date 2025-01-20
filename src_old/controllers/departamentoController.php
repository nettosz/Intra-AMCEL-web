<?php

namespace src\Controllers;

use src\Models\cargosModel;
use src\Models\departamentoModel;
use src\Models\permissaoModel;

class departamentoController extends Controller
{

  public function index()
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );
    $permissao = new permissaoModel();
    $departamentos = new departamentoModel();

    if (!empty($_POST['id'])) {
      $result = $departamentos->delete($_POST['id']);
      if ($result) $dados['success'] = 'Deletado com sucesso';
      else $dados['erro'] = 'Erro ao deletar';
    }


    $permi = $permissao->getPermissao('Departamentos');
    $dados['permissao'] = $permi;

    $dados['departamentos'] = $departamentos->getDepartamentos();
    $this->renderClient(true, 'client\departamentos\index', $dados);
  }

  public function create()
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );

    $departamentos = new departamentoModel();

    if (isset($_POST['nome'])) {
      $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);

      if (empty($nome)) {
        $dados['erro'] = 'Preencher todos os campos';
      } else {
        $result = $departamentos->add($nome);

        if ($result) $dados['success'] = 'Salvo com sucesso!';
        else $dados['erro'] = 'Erro ao salvar';
      }
    }

    $this->renderClient(true, 'client\departamentos\create', $dados);
  }

  public function edit($params)
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );

    $departamentos = new departamentoModel();
    $id = $params[0]['id'];

    if (isset($_POST['nome'])) {
      $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);

      if (empty($nome)) {
        $dados['erro'] = 'Preencher todos os campos';
      } else {
        $result = $departamentos->edit($id, $nome);

        if ($result) $dados['success'] = 'Salvo com sucesso!';
        else $dados['erro'] = 'Erro ao salvar';
      }
    }

    $dados['departamento'] = $departamentos->getDepartamento($id);

    $this->renderClient(true, 'client\departamentos\edit', $dados);
  }
}
