<?php

namespace src\Controllers\Admin;

use src\Controllers\Controller;
use src\Models\cargosModel;
use src\Models\departamentoModel;
use src\Models\LGPDModel;

class adminCargosController extends Controller
{
    function index()
    {
        $dados = array();

        $cargos = new cargosModel();

        if (!empty($_POST['id'])) {
            $result = $cargos->delete($_POST['id']);
            if ($result) $dados['success'] = 'Deletado com sucesso';
            else $dados['erro'] = 'Erro ao deletar';
        }

        $dados['cargos'] = $cargos->getCargos('Cargos');

        $this->renderAdmin(true, 'admin/cargos/index', $dados);
    }

    public function create()
    {
        $dados = array(
            'erro' => '',
            'success' => ''
        );

        $cargos = new cargosModel();
        $departamentos = new departamentoModel();

        if (isset($_POST['cargo'])) {
            $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRIPPED);
            $departamento = filter_input(INPUT_POST, 'departamento', FILTER_SANITIZE_STRIPPED);

            if (empty($cargo) || $departamento === '0') {
                $dados['erro'] = 'Preencher todos os campos';
            } else {
                $result = $cargos->add($cargo, $departamento);
                if ($result) $dados['success'] = 'Salvo com sucesso!';
                else $dados['erro'] = 'Erro ao salvar';
            }
        }

        $dados['departamentos'] = $departamentos->getDepartamentos();

        $this->renderAdmin(true, 'admin\cargos\create', $dados);
    }

    public function edit($params)
    {
        $dados = array(
            'erro' => '',
            'success' => ''
        );
        $id = $params[0]['id'];

        $cargos = new cargosModel();
        $departamentos = new departamentoModel();

        if (isset($_POST['cargo'])) {
            $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRIPPED);
            $departamento = filter_input(INPUT_POST, 'departamento', FILTER_SANITIZE_STRIPPED);

            if (empty($cargo) || $departamento === '0') {
                $dados['erro'] = 'Preencher todos os campos';
            } else {
                $result = $cargos->edit($id, $cargo, $departamento);
                if ($result) $dados['success'] = 'Salvo com sucesso!';
                else $dados['erro'] = 'Erro ao salvar';
            }
        }

        $dados['cargo'] = $cargos->getCargo($id);
        $dados['departamentos'] = $departamentos->getDepartamentos();

        $this->renderAdmin(true, 'admin\cargos\edit', $dados);
    }
}
