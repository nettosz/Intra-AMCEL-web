<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\homeDesignModel;
use src\Models\modulosModel;
use src\Models\noticiasModel;
use src\Models\permissaoModel;

class noticiasController extends Controller
{
    function index()
    {
        $dados = array();
        $permissao = new permissaoModel();
        $permi = $permissao->getPermissao();
        $dados['permi'] = $permi;

        $noticiasModel = new noticiasModel();

        $noticias = $noticiasModel->getNoticias();

        $dados['slide1'] = array_filter($noticias, function ($n) {
            return $n['slide'] === '1';
        });

        $dados['slide2'] = array_filter($noticias, function ($n) {
            return $n['slide'] === '2';
        });

        $this->renderClient(true, 'client\noticias\index', $dados);
    }
}
