<?php

namespace src\Controllers;

use src\Models\usuarioModel;
use src\Controllers\Controller;

class perfilUserController extends Controller
{
  public function show()
  {
    $dados = array();

    $usuario = new usuarioModel();

    $dados['usuario'] = $usuario->getPerfil();

    $this->renderClient(true, 'client\perfil-user', $dados);
  }
}
