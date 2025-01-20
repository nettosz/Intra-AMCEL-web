<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\baseCMTOModel;

class searchBaseCMTOController extends Controller
{
  function show($param)
  {
    $dados = array();
    $base = new baseCMTOModel();
    if (isset($_GET['search'])) {
      $dados['bases'] = $base->getSearchBaseConhecimento($_GET['search']);
    }

    $this->renderAjax('bases', $dados);
  }
}
