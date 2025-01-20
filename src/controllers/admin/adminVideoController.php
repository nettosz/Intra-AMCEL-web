<?php

namespace src\Controllers\Admin;

use src\Models\videoModel;
use src\utils\jwtAuth;
use src\Models\usuarioModel;
use src\Controllers\Controller;

class adminVideoController extends Controller
{
  function index()
  {
    $dados = array();
    $video = new videoModel();
    if (isset($_POST['id']) && !empty($_POST['id'])) {
      $video->deleteVideo($_POST['id']);
    }
    $dados['videos'] = $video->getAllVideos();
    $this->renderAdmin(true, 'admin/video', $dados);
  }

  public function moveFile($file)
  {
    $uploaddir = '../assets/videos/institucionais/';
    try {
      if ($file['name'] !== '') {
        $fileExtension = explode(".", strtolower($file['name']));
        var_dump($fileExtension);
        $fileName = substr($fileExtension[0], 0, 10)  . '-' . md5(date('Y-m-d H:i:s:u')) . '.' . $fileExtension[1];
        $uploadfile = $uploaddir .  $fileName;
        move_uploaded_file($file['tmp_name'], $uploadfile);
        return 'http://' . $_ENV['HOST'] . '/intra-amcel-web' . '/assets/videos/institucionais/' . $fileName;
      } else {
        return '';
      }
    } catch (\Throwable $th) {
      return '';
    }
  }

  function create()
  {
    $dados = array();

    if (!empty($_POST['titulo'])) {

      $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRIPPED);
      $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRIPPED);
      $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRIPPED);
      $subCategoria = filter_input(INPUT_POST, 'sub-categoria', FILTER_SANITIZE_STRIPPED);
      $tipo_video = filter_input(INPUT_POST, 'tipo_video', FILTER_SANITIZE_STRIPPED);

      $video = new videoModel();

      $user = new usuarioModel();
      $userID = $user->getID();

      $link = '';

      if (!empty($_FILES['file_video']) && $tipo_video === 'arquivo')
        $link = $this->moveFile($_FILES['file_video']);
      else
        $link = filter_input(INPUT_POST, 'video_url', FILTER_SANITIZE_STRIPPED);

      try {

        $video->setVideo(
          $titulo,
          $descricao,
          $subCategoria,
          $link,
          $userID
        );

        $dados['success'] = 'Video salvo com sucesso';
      } catch (\Throwable $th) {
        $dados['error'] = "Erro ao salvar video";
      }
    }

    $this->renderAdmin(true, 'admin/videos-create', $dados);
  }

  function edit($param)
  {
    $dados = array();
    $video = new videoModel();
    $id = $param[0]['id'];

    if (!empty($_POST['titulo'])) {

      $videoUpdated = $video->getVideo($id);

      $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRIPPED);
      $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRIPPED);
      $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRIPPED);
      $subCategoria = filter_input(INPUT_POST, 'sub-categoria', FILTER_SANITIZE_STRIPPED);
      $tipo_video = filter_input(INPUT_POST, 'tipo_video', FILTER_SANITIZE_STRIPPED);

      $user = new usuarioModel();
      $userID = $user->getID();

      $link = '';

      if (!empty($_FILES['file_video']) && $tipo_video === 'arquivo')
        $link = $this->moveFile($_FILES['file_video']);
      else if ($tipo_video === 'link')
        $link = filter_input(INPUT_POST, 'video_url', FILTER_SANITIZE_STRIPPED);

      try {

        $video->updateVideo(
          $id,
          $titulo,
          $descricao,
          $subCategoria,
          $link
        );

        $dados['success'] = 'Video alterado com sucesso';
      } catch (\Throwable $th) {
        $dados['error'] = "Erro ao alterar video";
      }
    }


    $dados['video'] = $video->getVideo($id);
    $this->renderAdmin(true, 'admin/video-edit', $dados);
  }
}
