<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\videoModel;

class videoController extends Controller
{
  function index()
  {
    $dados  = array();
    $video = new videoModel();
    $dados['videos'] = $video->getAllVideos();

    $this->renderClient(true, 'client\video', $dados);
  }

  function show()
  {
    $dados = array();
    $video = new videoModel();
    $queryParam  = $_GET['search'];
    $dados['videos'] = $video->searchVideo($queryParam);

    $this->renderAjax('video', $dados);
  }
}
