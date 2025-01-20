<?php

namespace src\Controllers;

use src\Models\loginModel;
use src\Controllers\Controller;

class loginController extends Controller
{
  function show()
  {
    $dados = array();
    if (isset($_REQUEST['login'])) {
      $request = $_REQUEST;
      $usuario = new loginModel();
      $dados['aviso'] = $usuario->getUser($request['login'], $request['senha']);
    }
    if (isset($_COOKIE['USER_TOKEN']) && !empty($_COOKIE['USER_TOKEN'])) {
      header("Location: http://" . $_ENV['HOST'] . "/intra-amcel-web/home");
    } else {
      $this->renderClient(false, 'client\login', $dados);
    }
  }
}
