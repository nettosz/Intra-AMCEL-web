<?php

namespace src\Controllers\Admin;

use src\Controllers\Controller;

use src\Models\departamentoModel;

class adminDepartamentosController extends Controller
{

    public function index()
    {
        $dados = array(
            'erro' => '',
            'success' => ''
        );

        $departamentos = new departamentoModel();

        if (!empty($_POST['id'])) {
            $result = $departamentos->delete($_POST['id']);
            if ($result) $dados['success'] = 'Deletado com sucesso';
            else $dados['erro'] = 'Erro ao deletar';
        }

        $dados['departamentos'] = $departamentos->getDepartamentos();
        $this->renderAdmin(true, 'admin\departamentos\index', $dados);
    }

    public function create()
    {
        $dados = array(
            'erro' => '',
            'success' => ''
        );

        $departamentos = new departamentoModel();

        if (isset($_POST['nome'])) {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);

            if (empty($nome)) {
                $dados['erro'] = 'Preencher todos os campos';
            } else {
                $result = $departamentos->add($nome);

                if ($result) $dados['success'] = 'Salvo com sucesso!';
                else $dados['erro'] = 'Erro ao salvar';
            }
        }

        $this->renderAdmin(true, 'admin\departamentos\create', $dados);
    }

    public function edit($params)
    {
        $dados = array(
            'erro' => '',
            'success' => ''
        );

        $departamentos = new departamentoModel();
        $id = $params[0]['id'];

        if (isset($_POST['nome'])) {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);

            if (empty($nome)) {
                $dados['erro'] = 'Preencher todos os campos';
            } else {
                $result = $departamentos->edit($id, $nome);

                if ($result) $dados['success'] = 'Salvo com sucesso!';
                else $dados['erro'] = 'Erro ao salvar';
            }
        }

        $dados['departamento'] = $departamentos->getDepartamento($id);

        $this->renderAdmin(true, 'admin\departamentos\edit', $dados);
    }
}
