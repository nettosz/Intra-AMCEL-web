<?php

namespace src\Controllers\Admin;

use src\Controllers\Controller;
use src\Models\noticiasModel;
use src\Models\politicasModel;

class noticiasController extends Controller
{
  function index()
  {
    $dados = array();

    $noticiasModel = new noticiasModel();

    if (!empty($_POST['id'])) {
      $result = $noticiasModel->delete($_POST['id']);
      if ($result) $dados['success'] = 'Deletado com sucesso';
      else $dados['erro'] = 'Erro ao deletar';
    }

    $dados['noticias'] = $noticiasModel->getNoticias();
    $this->renderAdmin(true, 'admin/noticias/index', $dados);
  }

  public function store()
  {
    $dados = array();

    $noticiasModel = new noticiasModel();
    $uploaddir = '../assets/imgs/noticias/';

    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRIPPED);
    $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRIPPED);
    // $slide = filter_input(INPUT_POST, 'slide', FILTER_SANITIZE_STRIPPED);

    $slide = '1';

    $fileName = '';

    if (!empty($_FILES['img'])) {
      $fileName = md5(strtotime(date('Y-m-d h:i:s')) . $_FILES['img']['name']);
      $uploadfile = $uploaddir . $fileName;

      move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile);

      $id = $noticiasModel->save($titulo, $fileName, $link, $slide);

      if ($id > 0) $dados['success'] = 'noticia salva com sucesso';
      else $dados['erro'] = 'Erro ao salvar';
    }

    $this->renderAdmin(true, 'admin/noticias/create', $dados);
  }

  public function edit($params)
  {
    $dados = array();

    $noticiasModel = new noticiasModel();

    $uploaddir = '../assets/imgs/noticias/';

    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRIPPED);
    $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRIPPED);
    // $slide = filter_input(INPUT_POST, 'slide', FILTER_SANITIZE_STRIPPED);
    $slide = '1';

    $fileName = '';

    if (!empty($_FILES['img'])) {
      $fileName = md5(strtotime(date('Y-m-d h:i:s'))) . '-' . $_FILES['img']['name'];
      $uploadfile = $uploaddir . $fileName;

      move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile);

      $id = $noticiasModel->update($titulo, $fileName, $slide, $link, $params[0]['id']);

      if ($id > 0) $dados['success'] = 'noticia alterado com sucesso';
      else $dados['erro'] = 'Erro ao alterar';
    }

    $dados['noticia'] = $noticiasModel->getNoticia($params[0]['id']);
    $this->renderAdmin(true, 'admin/noticias/edit', $dados);
  }
}
