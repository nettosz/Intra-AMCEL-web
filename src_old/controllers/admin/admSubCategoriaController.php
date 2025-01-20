<?php

namespace src\Controllers\Admin;

use src\Models\subCategoriasModel;
use src\Controllers\Controller;

class admSubCategoriaController extends Controller
{
  function index($params)
  {
    $id_categoria = $params[0]['id_categoria'];
    $categoria = new subCategoriasModel();
    $dados['sub_categorias'] = $categoria->getTodasSubCategorias($id_categoria);

    $this->renderAjax('subcategoria', $dados);
  }


  function store($param)
  {
    $categoria = new subCategoriasModel();
    try {
      $categoria->setSubCategoria($_POST['nome'], $param[0]['id_categoria']);

      echo json_encode(array("message" => "ok"));
    } catch (\Throwable $th) {
      echo "0";
    }
  }

  function update($param)
  {
    $categoria = new subCategoriasModel();
    try {
      $categoria->updateSubCategoria(
        $param[1]['id_subcategoria'],
        $_POST['nome']
      );

      echo json_encode(array("message" => "ok"));
    } catch (\Throwable $th) {
      echo "0";
    }
  }


  function delete($params)
  {
    $id = $params[1]['id_subcategoria'];
    $categoria = new subCategoriasModel();
    try {
      $categoria->deleteSubCategoria($id);
      echo json_encode(array("message" => "ok"));
    } catch (\Throwable $th) {
      echo "0";
    }
  }
}
