<?php

namespace src\Controllers;

use src\utils\jwtAuth;
use src\Controllers\Controller;
use src\Models\homeDesignModel;
use src\Models\modulosModel;
use src\Models\noticiasModel;
use src\Models\permissaoModel;
use src\Models\usuarioOnlineModel;
use src\Models\visitasModel;

class homeController extends Controller
{
  function index()
  {
    $dados = array();
    $permissao = new permissaoModel();
    $permi = $permissao->getPermissao();
    $dados['permi'] = $permi;

    if (!empty($_SESSION['user'])) {
      $user =  unserialize($_SESSION['user']);
      $dados['usuario'] = $user;
    }


    $homeDesign = new homeDesignModel();
    $data = $homeDesign->getHomeDesign();

    if (!empty($data)) {
      $dados['imagem_fundo_url'] =  BASE_URL . 'assets/imgs/home/' . $data['imagem_fundo'];
    }

    $visitas = new visitasModel();

    $dados['usuarios_online'] = $visitas->incrementCount();
    // $dados['usuarios_online'] = 10;


    $this->renderClient(true, 'client\home', $dados);
  }

  public function permissao()
  {
    $permissao = new permissaoModel();
    $modules = new modulosModel();
    $permi = $permissao->getPermissao($_POST['module']);

    $module = $modules->getModuleByName($_POST['module']);

    // echo "<pre>";
    // var_dump($permi);
    // echo "</pre>";

    if (in_array(
      [
        'cod_perfil' => '50',
        'cod_modulo' => $module['id'],
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'V'
      ],
      $permi
    ) || in_array(
      [
        'cod_modulo' => (string) $module['id'],
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'F'
      ],
      $permi
    )) {
      echo json_encode(["status_code" => 200]);
    } else {
      echo json_encode(['status_code' => 401]);
    }
  }
}
