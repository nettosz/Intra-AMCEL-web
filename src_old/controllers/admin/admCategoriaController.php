<?php

namespace src\Controllers\Admin;

use src\Controllers\Controller;
use src\Models\categoriasModel;

class admCategoriaController extends Controller
{
  function index($params)
  {

    $categoria = new categoriasModel();
    $dados['categorias'] = $categoria->getTodasCategorias('base_cmto_cat');

    $this->renderAjax('categoria', $dados);
  }

  function store()
  {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
    $categoria = new categoriasModel();
    try {
      $categoria->setCategoria($_POST['nome']);
      echo json_encode(array("message" => "ok"));
    } catch (\Throwable $th) {
      echo "0";
    }
  }

  function update($params)
  {
    $id = $params[0]['id'];
    $categoria = new categoriasModel();
    try {
      $categoria->updateCategoria($id, $_POST['nome']);
      echo json_encode(array("message" => "ok"));
    } catch (\Throwable $th) {
      echo "0";
    }
  }


  function delete($params)
  {
    $id = $params[0]['id'];
    $categoria = new categoriasModel();
    try {
      $categoria->deleteCategoria($id);
      echo json_encode(array("message" => "ok"));
    } catch (\Throwable $th) {
      echo "0";
    }
  }
}
