<?php

namespace src\Controllers;

use src\utils\jwtAuth;
use src\Controllers\Controller;
use src\Models\permissaoModel;

class homeController extends Controller
{
  function index()
  {
    $dados = array();
    $permissao = new permissaoModel();
    $permi = $permissao->getPermissao();
    $dados['permissoes'] = $permi;
    if (!empty($_SESSION['user'])) {
      $user =  unserialize($_SESSION['user']);
      $dados['usuario'] = $user;
    }
    $this->renderTwig('client\home', $dados);
  }
}
