<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\agendamentoSalaModel;
use src\Models\LGPDAprovacoesModel;
use src\Models\LGPDModel;
use src\Models\permissaoModel;

class LGPDController extends Controller
{
    public function index()
    {
        $dados = array(
            "aviso" => '',
            "erro" => '',
            "permissao" => ''
        );

        $lgpd = new LGPDModel();
        $permissao = new permissaoModel();

        if (!empty($_POST['id'])) {
            $result = $lgpd->delete($_POST['id']);
            if ($result) $dados['success'] = 'Deletado com sucesso';
            else $dados['erro'] = 'Erro ao deletar';
        }

        $dados['permissao'] = $permissao->getPermissao('LGPD');

        $dados['lgpds'] = $lgpd->getLGPDs();

        $this->renderClient(true, 'client\lgpd\index', $dados);
    }

    public function create()
    {
        $dados = array(
            "success" => '',
            "erro" => ''
        );

        $lgpd = new LGPDModel();

        $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRIPPED);
        $data_criacao = filter_input(INPUT_POST, 'data_criacao', FILTER_SANITIZE_STRIPPED);
        $versao = filter_input(INPUT_POST, 'versao', FILTER_SANITIZE_STRIPPED);
        $aprovadores = filter_input(INPUT_POST, 'aprovadores', FILTER_SANITIZE_STRIPPED);


        $pdf_pt = '';
        if (!empty($_FILES['pt_pdf']))
            $pdf_pt = $this->moveFile($_FILES['pt_pdf']);

        $pdf_en = '';
        if (!empty($_FILES['en_pdf']))
            $pdf_en = $this->moveFile($_FILES['en_pdf']);

        if (!empty($_FILES['pt_pdf'])) {
            $id = $lgpd->save($titulo, $data_criacao, $versao, $aprovadores, $pdf_pt, $pdf_en);
            if ($id > 0) $dados['success'] = 'LGPD salva com sucesso';
            else $dados['erro'] = 'Erro ao salvar';
        }

        $this->renderClient(true, 'client\lgpd\create', $dados);
    }

    public function moveFile($file)
    {
        $uploaddir = '../assets/pdf/lgpd/';
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
        $dados = array(
            "success" => '',
            "erro" => ''
        );
        $lgpd = new LGPDModel();
        if (!empty($_POST['titulo'])) {

            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRIPPED);
            $data_criacao = filter_input(INPUT_POST, 'data_criacao', FILTER_SANITIZE_STRIPPED);
            $versao = filter_input(INPUT_POST, 'versao', FILTER_SANITIZE_STRIPPED);
            $aprovadores = filter_input(INPUT_POST, 'aprovadores', FILTER_SANITIZE_STRIPPED);

            $fileName = '';


            $pdf_pt = '';
            if (!empty($_FILES['pt_pdf']))
                $pdf_pt = $this->moveFile($_FILES['pt_pdf']);

            $pdf_en = '';
            if (!empty($_FILES['en_pdf']))
                $pdf_en = $this->moveFile($_FILES['en_pdf']);

            $id = $lgpd->update($titulo, $data_criacao, $versao, $aprovadores, $pdf_pt, $pdf_en, $params[0]['id']);

            if ($id > 0) $dados['success'] = 'LGPD alterada com sucesso';
            else $dados['erro'] = 'Erro ao salvar';
        }

        $dados['lgpd'] = $lgpd->getLGPD($params[0]['id']);

        $this->renderClient(true, 'client\lgpd\edit', $dados);
    }
}
