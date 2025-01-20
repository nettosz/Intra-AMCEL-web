<?php

namespace src\Controllers\Admin;

use src\Models\baseCMTOModel;
use src\Models\categoriasModel;
use src\Models\usuarioModel;
use src\Controllers\Controller;

class adminBaseConhecimentoController extends Controller
{
  function index()
  {
    $dados = array();
    $baseCMTOModel = new baseCMTOModel();
    if (isset($_POST['id']) && !empty($_POST['id'])) {
      $baseCMTOModel->delete($_POST['id']);
    }
    $dados['bases'] = $baseCMTOModel->getTodosBaseConhecimento();
    $this->renderAdmin(true, 'admin/base-conhecimento', $dados);
  }

  function create()
  {
    $dados = array();
    $categoria = new categoriasModel();
    $dados['categorias'] = $categoria->getTodasCategorias('base_cmto_cat');
    $this->renderAdmin(true, 'admin/base-conhecimento-create', $dados);
  }

  function store()
  {
    $dados = array();
    $base = new baseCMTOModel();
    $user = new usuarioModel();

    $userId = $user->getID();
    try {
      $base->setBaseCMTO(
        $_POST['titulo'],
        $_POST['desc_curta'],
        $_POST['descricao'],
        $userId,
        intval($_POST['sub_categoria'])
      );
      echo json_encode(['message' => 'ok']);
    } catch (\Throwable $th) {
      echo $th;
    }
  }



  function edit($param)
  {
    $dados = array(
      'erro' => '',
      'success' => ''
    );

    $base = new baseCMTOModel();
    $id = $param[0]['id'];

    if (!empty($_POST['titulo'])) {
      $user = new usuarioModel();

      $userId = $user->getID();
      $result  = $base->updateBase(
        $id,
        $_POST['titulo'],
        $_POST['desc_curta'],
        $_POST['descricao'],
        $_POST['sub_categoria']
      );
      if ($result) $dados['success'] = 'Editado com sucesso';
      else $dados['erro'] = 'Erro ao editar';
    }
    $dados['base'] = $base->getBaseConhecimento($id);


    $this->renderAdmin(true,  'admin/base-conhecimento-edit', $dados);
  }
}
