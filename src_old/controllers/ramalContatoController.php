<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\departamentoModel;
use src\Models\permissaoModel;
use src\Models\ramalModel;

class ramalContatoController extends Controller
{
  public function index()
  {
    $dados = array();

    $permissao = new permissaoModel();
    $ramais = new ramalModel();

    if (!empty($_POST['id'])) {
      $result = $ramais->delete($_POST['id']);
      if ($result) $dados['success'] = 'Deletado com sucesso';
      else $dados['erro'] = 'Erro ao deletar';
    }

    $ramais = new ramalModel();
    $dados['ramais'] = $ramais->getRamaisNumeros();

    $permi = $permissao->getPermissao('Ramais e Contatos');
    $dados['permissao'] = $permi;

    $this->renderClient(true, 'client\ramais_contatos\index', $dados);
  }
  public function edit($params)
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );

    $ramais = new ramalModel();


    if (isset($_POST['nome'])) {
      $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);
      $ramal = filter_input(INPUT_POST, 'ramal', FILTER_SANITIZE_STRIPPED);
      $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRIPPED);

      if (empty($nome)) {
        $dados['erro'] = 'Preencher todos os campos';
      } else {

        $result = $ramais->edit($nome, $ramal, $celular, $params[0]['id']);

        if ($result) $dados['success'] = 'Salvo com sucesso!';
        else $dados['erro'] = 'Erro ao salvar';
      }
    }

    $dados['ramal'] = $ramais->getRamalNumero($params[0]['id']);

    $this->renderClient(true, 'client\ramais_contatos\edit', $dados);
  }
  public function create()
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );

    $ramais = new ramalModel();

    if (isset($_POST['nome'])) {
      $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);
      $ramal = filter_input(INPUT_POST, 'ramal', FILTER_SANITIZE_STRIPPED);
      $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRIPPED);

      if (empty($nome)) {
        $dados['erro'] = 'Preencher todos os campos';
      } else {

        $result = $ramais->add($nome, $ramal, $celular);

        if ($result) $dados['success'] = 'Salvo com sucesso!';
        else $dados['erro'] = 'Erro ao salvar';
      }
    }

    $this->renderClient(true, 'client\ramais_contatos\create', $dados);
  }
}
