<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\baseCMTOModel;

class baseConhecimentoCotroller extends Controller
{
  function index()
  {
    $dados  = array();
    $base = new baseCMTOModel;
    $dados['bases'] = $base->getTodosBaseConhecimento();
    $this->renderClient(true, 'client\base-conhecimento', $dados);
  }

  function show($param)
  {
    $dados = array();
    $base = new baseCMTOModel();
    $id = $param[0]['id'];
    $dados['base'] = $base->getBaseConhecimento($id);
    // var_dump($dados['base']);
    $this->renderClient(true, 'client\base-conhecimento-show', $dados);
  }
}
