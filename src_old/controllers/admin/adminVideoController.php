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

  function create()
  {
    $dados = array();
    $this->renderAdmin(true, 'admin/videos-create', $dados);
  }

  function store()
  {
    $dados = array();
    $video = new videoModel();

    $user = new usuarioModel();
    $userID = $user->getID();

    try {
      
      $video->setVideo(
        $_POST['titulo'],
        $_POST['descricao'],
        intval($_POST['sub_categoria']),
        $_POST['url_video'],
        $userID
      );

      echo json_encode(['message' => 'ok']);
    } catch (\Throwable $th) {
      echo $th;
    }
  }

  function edit($param)
  {
    $dados = array();
    $video = new videoModel();
    $id = $param[0]['id'];
 
    $dados['video'] = $video->getVideo($id);
    $this->renderAdmin(true, 'admin/video-edit', $dados);
  }

  function update($param)
  {
    $dados = array();
    $video = new videoModel();
    $id_video = $param[0]['id_video'];
    
    try {

      $video->updateVideo(
        $id_video,
        $_POST['titulo'],
        $_POST['descricao'],
        $_POST['sub_categoria'],
        $_POST['url_video']
      );
      echo json_encode(['message' => 'ok']);
    } catch (\Throwable $th) {
      echo $th;
    }
  }
}
