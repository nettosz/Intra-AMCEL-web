<?php

namespace src\Controllers\Admin;

use src\utils\jwtAuth;
use src\Controllers\Controller;

class adminHomeController extends Controller
{
  function index()
  {
    $dados = array();
    $this->renderAdmin(true, 'admin/home', $dados);
  }
}
