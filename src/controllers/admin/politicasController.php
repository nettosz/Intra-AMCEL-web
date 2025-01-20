<?php

namespace src\Controllers\Admin;

use src\Controllers\Controller;
use src\Models\politicasModel;

class politicasController extends Controller
{
  function index()
  {
    $dados = array();

    $politicaModel = new politicasModel();

    if (!empty($_POST['id'])) {
      $result = $politicaModel->delete($_POST['id']);
      if ($result) $dados['success'] = 'Deletado com sucesso';
      else $dados['erro'] = 'Erro ao deletar';
    }

    $dados['politicas'] = $politicaModel->getPoliticas();
    $this->renderAdmin(true, 'admin/politicas/index', $dados);
  }

  public function store()
  {
    $dados = array();

    $politicaModel = new politicasModel();

    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRIPPED);

    $pdf_pt = '';
    if (!empty($_FILES['pdf']))
      $pdf_pt = $this->moveFile($_FILES['pdf']);

    $pdf_en = '';
    if (!empty($_FILES['pdf_en']))
      $pdf_en = $this->moveFile($_FILES['pdf_en']);

    if (!empty($_FILES['pdf'])) {
      $id = $politicaModel->save($titulo, $pdf_pt, $pdf_en);
      if ($id > 0) $dados['success'] = 'Politica salva com sucesso';
      else $dados['erro'] = 'Erro ao salvar';
    }

    $this->renderAdmin(true, 'admin/politicas/create', $dados);
  }

  public function moveFile($file)
  {
    $uploaddir = '../assets/pdf/politicas/';
    try {
      if ($file['name'] !== '') {
        $fileExtension = explode(".", strtolower($file['name']));
        var_dump($fileExtension);
        $fileName = $fileExtension[0] . '-' . md5(date('Y-m-d H:i:s:u')) . '.' . $fileExtension[1];
        $uploadfile = $uploaddir .  $fileName;
        move_uploaded_file($file['tmp_name'], $uploadfile);
        return $fileName;
      } else {
        return '';
      }
    } catch (\Throwable $th) {
      return '';
    }
  }

  public function edit($params)
  {
    $dados = array();

    $politicaModel = new politicasModel();
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRIPPED);

    $pdf_pt = '';
    if (!empty($_FILES['pdf']))
      $pdf_pt = $this->moveFile($_FILES['pdf']);

    $pdf_en = '';
    if (!empty($_FILES['pdf_en']))
      $pdf_en = $this->moveFile($_FILES['pdf_en']);

    if (!empty($_POST['titulo'])) {

      $id = $politicaModel->update($titulo, $pdf_pt, $pdf_en, $params[0]['id']);
      if ($id > 0) $dados['success'] = 'Politica alterado com sucesso';
      else $dados['erro'] = 'Erro ao alterar';
    }



    $dados['politica'] = $politicaModel->getPolitica($params[0]['id']);

    $this->renderAdmin(true, 'admin/politicas/edit', $dados);
  }
}
