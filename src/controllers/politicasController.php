<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\politicasModel;

class politicasController extends Controller
{
  public function __construct()
  {
    if (empty($_SESSION['user'])) {
      header('Location:' . BASE_URL);
    }
  }

  public function index()
  {
    $dados = array();
    $politicaModel = new politicasModel();
    $dados['politicas'] = $politicaModel->getPoliticas();
    $this->renderClient(true, 'client\politicas', $dados);
  }
}
