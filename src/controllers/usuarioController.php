<?php

namespace src\Controllers;

use src\Models\departamentoModel;
use src\Controllers\Controller;
use src\Models\usuarioModel;

class usuarioController extends Controller
{
  public function edit()
  {
    $dados = array();

    $departamento = new departamentoModel();
    $dados['departamentos'] = $departamento->getDepartamentos();

    $this->renderClient(false, 'client\cadastro-usuario', $dados);
  }

  public function  update()
  {
    $dados = array();

    $usuario = new usuarioModel();

    $codCargo = filter_input(INPUT_POST, 'cod_cargo', FILTER_SANITIZE_STRIPPED);
    $dataNascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRIPPED);
    $ramal = filter_input(INPUT_POST, 'ramal', FILTER_SANITIZE_STRIPPED);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRIPPED);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);

    $result  = $usuario->updateUsuarioByCadastro($nome, $dataNascimento, $codCargo, $ramal, $email);

    if (is_string($result)) {
      echo json_encode(["success" => $result]);
    } else {
      echo json_encode(["error" => 'erro ao salvar']);
    }
  }
}
