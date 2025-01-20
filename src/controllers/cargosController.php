<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\departamentoModel;
use src\Models\cargosModel;
use src\models\permissaoModel;

class cargosController extends Controller
{
  public function index()
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );
    $permissao = new permissaoModel();
    $cargos = new cargosModel();

    if (!empty($_POST['id'])) {
      $result = $cargos->delete($_POST['id']);
      if ($result) $dados['success'] = 'Deletado com sucesso';
      else $dados['erro'] = 'Erro ao deletar';
    }

    $dados['cargos'] = $cargos->getCargos('Cargos');

    $permi = $permissao->getPermissao();
    $dados['permissao'] = $permi;

    if (!empty($_SESSION['user'])) {
      $user =  unserialize($_SESSION['user']);
      $dados['usuario'] = $user;
    }

    $this->renderClient(true, 'client\cargos\index', $dados);
  }

  public function create()
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );

    $cargos = new cargosModel();
    $departamentos = new departamentoModel();

    if (isset($_POST['cargo'])) {
      $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRIPPED);
      $departamento = filter_input(INPUT_POST, 'departamento', FILTER_SANITIZE_STRIPPED);

      if (empty($cargo) || $departamento === '0') {
        $dados['erro'] = 'Preencher todos os campos';
      } else {
        $result = $cargos->add($cargo, $departamento);
        if ($result) $dados['success'] = 'Salvo com sucesso!';
        else $dados['erro'] = 'Erro ao salvar';
      }
    }

    $dados['departamentos'] = $departamentos->getDepartamentos();

    $this->renderClient(true, 'client\cargos\create', $dados);
  }

  public function show($params)
  {
    $dados = array();
    $cargos = new cargosModel();
    $dados['cargos'] = $cargos->getCargosDepartamento($params[0]['id']);

    $this->renderAjax('cargos', $dados);
  }

  public function edit($params)
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );
    $id = $params[0]['id'];

    $cargos = new cargosModel();
    $departamentos = new departamentoModel();

    if (isset($_POST['cargo'])) {
      $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRIPPED);
      $departamento = filter_input(INPUT_POST, 'departamento', FILTER_SANITIZE_STRIPPED);

      if (empty($cargo) || $departamento === '0') {
        $dados['erro'] = 'Preencher todos os campos';
      } else {
        $result = $cargos->edit($id, $cargo, $departamento);
        if ($result) $dados['success'] = 'Salvo com sucesso!';
        else $dados['erro'] = 'Erro ao salvar';
      }
    }

    $dados['cargo'] = $cargos->getCargo($id);
    $dados['departamentos'] = $departamentos->getDepartamentos();

    $this->renderClient(true, 'client\cargos\edit', $dados);
  }
}
