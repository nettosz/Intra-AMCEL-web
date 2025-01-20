<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\achadosPerdidosModel;
use src\Models\agendamentoSalaModel;
use src\Models\permissaoModel;
use src\Models\usuarioModel;
use src\Models\usuarioOnlineModel;

class achadosPerdidosController extends Controller
{
    public function index()
    {
        $dados = array();
        $permissao = new permissaoModel();
        $achados_perdidos = new achadosPerdidosModel();

        if (!empty($_POST['id'])) {

            $usuario = new usuarioModel();
            $userID = $usuario->getID();
            $achados = new achadosPerdidosModel();

            $findAchado = $achados->getAchadoPerdido($_POST['id']);

            if ($findAchado['cod_usuario'] !== $userID) {
                $dados['erro'] = 'Usuário não tem permissão pra excluir';
            } else {
                $result = $achados_perdidos->delete($_POST['id']);
                if ($result) $dados['success'] = 'Deletado com sucesso';
                else $dados['erro'] = 'Erro ao deletar';
            }
        }

        $dados['achados_perdidos'] = $achados_perdidos->getAchadosPerdidos();

        $dados['permissao'] = $permissao->getPermissao('Achados Perdidos');

        $this->renderClient(true, 'client\achados-perdidos\index', $dados);
    }

    public function moveFile($file)
    {
        $uploaddir = '../assets/imgs/achados-perdidos/';
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
            "error" => ''
        );

        $achadosPerdidos = new achadosPerdidosModel();

        $usuario = new usuarioModel();
        $userID = $usuario->getID();

        $findAchado = $achadosPerdidos->getAchadoPerdido($params[0]['id']);

        if ($findAchado['cod_usuario'] !== $userID) {
            echo "<script>location.href='http://{$_ENV['HOST']}/intra-amcel-web/achados-perdidos?error=permissao'</script>";
            return;
        }

        if (!empty($_POST['nome'])) {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);
            $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRIPPED);
            $local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRIPPED);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRIPPED);
            $nome_rec = filter_input(INPUT_POST, 'nome_recebido', FILTER_SANITIZE_STRIPPED);
            $data_rec =  filter_input(INPUT_POST, 'data_recebido', FILTER_SANITIZE_STRIPPED);

            $foto_name = '';

            if (!empty($_FILES['foto']))
                $foto_name = $this->moveFile($_FILES['foto']);

            if ($status === 'P') {
                $nome_rec = '';
                $data_rec = '';
            }

            try {
                $achadosPerdidos->update(
                    $nome,
                    $local,
                    $data,
                    $status,
                    $nome_rec,
                    $data_rec,
                    $foto_name,
                    $params[0]['id']
                );

                $dados['success'] = 'Registro alterado com sucesso!';
            } catch (\Throwable $th) {
                $dados['erro'] = 'Não foi possivel salvar o registro';
            }
        }

        $dados['achado_perdido'] = $achadosPerdidos->getAchadoPerdido($params[0]['id']);

        $this->renderClient(true, 'client\achados-perdidos\edit', $dados);
    }

    public function create()
    {
        $dados = array(
            "success" => '',
            "erro" => ''
        );

        $usuario = new usuarioModel();

        $userID = $usuario->getID();

        if (!empty($_POST['nome'])) {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);
            $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRIPPED);
            $local = filter_input(INPUT_POST, 'local', FILTER_SANITIZE_STRIPPED);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRIPPED);
            $nome_rec = filter_input(INPUT_POST, 'nome_recebido', FILTER_SANITIZE_STRIPPED);
            $data_rec =  filter_input(INPUT_POST, 'data_recebido', FILTER_SANITIZE_STRIPPED);

            $achadosPerdidos = new achadosPerdidosModel();

            $foto_name = $this->moveFile($_FILES['foto']);

            try {
                $achadosPerdidos->save(
                    $nome,
                    $local,
                    $data,
                    $status,
                    $nome_rec,
                    $data_rec,
                    $foto_name,
                    $userID
                );

                $dados['success'] = 'Registro salvo com sucesso!';
            } catch (\Throwable $th) {
                $dados['error'] = 'Não foi possivel salvar o registro';
            }
        }

        $this->renderClient(true, 'client\achados-perdidos\create', $dados);
    }
}
