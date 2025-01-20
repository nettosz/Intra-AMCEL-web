<?php

namespace src\Controllers\Admin;

use src\Controllers\Controller;
use src\Models\homeDesignModel;

class adminHomeDesignController extends Controller
{
    function index()
    {
        $dados = array();
        $homeDesign = new homeDesignModel();

        $dados['home_design'] = $homeDesign->getHomeDesign();

        if (!empty($_FILES['fundo'])) {
            if (empty($dados['home_design'])) {
                $fundo = $this->moveFile($_FILES['fundo']);
                $result = $homeDesign->add($fundo);
                if ($result > 0) $dados['success'] = 'imagem salva com sucesso';
                else $dados['error'] = 'Erro ao salvar';
            } else {
                $fundo = $this->moveFile($_FILES['fundo']);
                $result = $homeDesign->edit($dados['home_design']['id'], $fundo);
                if ($result > 0) $dados['success'] = 'imagem alterada com sucesso';
                else $dados['error'] = 'Erro ao salvar';
            }
        }

        if (!empty($_POST['delete-image'])) {
            $homeDesign->delete($dados['home_design']['id']);
        }

        $dados['home_design'] = $homeDesign->getHomeDesign();

        $this->renderAdmin(true, 'admin/home/design', $dados);
    }


    public function moveFile($file)
    {
        $uploaddir = '../assets/imgs/home/';
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
}
