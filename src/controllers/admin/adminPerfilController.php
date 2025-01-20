<?php

namespace src\Controllers\Admin;

use modulosModel as GlobalModulosModel;
use src\Models\perfilModel;
use src\Models\modulosModel;
use src\Models\modulosOpcoesModel;
use src\Controllers\Controller;
use src\Models\perfilAcessoModel;
use src\Models\usuarioModel;

class adminPerfilController extends Controller
{
  public function index()
  {
    $dados = array();

    if (!empty($_POST['id'])) {
      $perfil = new perfilModel();
      $result  = $perfil->delete($_POST['id']);

      if (is_string($result)) $dados['aviso']['erro'] = $result;
      else $dados['aviso']['sucesso'] = 'Deletado com sucesso';
    }

    $perfil = new perfilModel();
    $dados['perfis'] = $perfil->getPerfis();

    $this->renderAdmin(true, 'admin/perfil', $dados);
  }

  public function create()
  {
    $dados = array();
    if (!empty($_POST['nome'])) {
      $perfil = new perfilModel();
      $perfilAcesso = new perfilAcessoModel();
      $usuario = new usuarioModel();

      $nomePerfil = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);
      $tpPerfil = filter_input(INPUT_POST, 'tipo_perfil', FILTER_SANITIZE_STRIPPED);
      $modulos = $_POST['modulo'];
      $emails = filter_input(INPUT_POST, 'emails', FILTER_SANITIZE_STRIPPED);

      $idPerfil = $perfil->add($nomePerfil, $tpPerfil);

      if ($idPerfil !== 0) {
        foreach ($modulos as $index => $value) {
          foreach ($value as $index_opcao => $modulo_opcao) {
            $perfilAcesso->add($idPerfil, $index, $index_opcao);
          }
        }
      }

      if (!empty($emails)) {
        $arrEmails = explode(' | ', $emails);
        foreach ($arrEmails as $email) {
          $result =  $usuario->add(trim($email), $idPerfil);
          if (is_string($result)) {
            $dados['aviso'] = $result;
          }
        }
      }
    }

    $modulos  = new modulosModel();
    $modulos_opcoes = new modulosOpcoesModel();
    $dados['modulos'] = $modulos->getModulos();
    $dados['modulos_opcoes'] = $modulos_opcoes->getModulosOpcoes();

    $this->renderAdmin(true, 'admin/perfil-create', $dados);
  }

  public function edit($params)
  {
    $dados = array();

    $perfil = new perfilModel();
    $modulos_opcoes = new modulosOpcoesModel();
    $modulos  = new modulosModel();
    $usuario = new usuarioModel();
    $perfilAcesso = new perfilAcessoModel();


    if (!empty($_POST['nome'])) {
      $nomePerfil = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRIPPED);
      $tpPerfil = filter_input(INPUT_POST, 'tipo_perfil', FILTER_SANITIZE_STRIPPED);
      $modulosUpdate = $_POST['modulo'];
      $emails = filter_input(INPUT_POST, 'emails', FILTER_SANITIZE_STRIPPED);

      $perfil->update($params[0]['id'], $nomePerfil, $tpPerfil);
      $perfilAcesso->delete($params[0]['id']);

      foreach ($modulosUpdate as $index => $value) {
        foreach ($value as $index_opcao => $modulo_opcao) {
          $perfilAcesso->add($params[0]['id'], $index, $index_opcao);
        }
      }

      $result = $usuario->updateByPerfil($emails, $params[0]['id']);

      if ($result !== 1) {
        $dados['aviso']['erro'] = $result;
      } else {
        $dados['aviso']['sucesso'] = 'Salvo com sucesso!';
      }
    }

    $dados['emails'] = $usuario->getEmailsInPerfil($params[0]['id']);
    $dados['perfil'] = $perfil->getPerfil($params[0]['id']);
    $dados['modulos'] = $modulos->getModulos();
    $dados['modulos_opcoes'] = $modulos_opcoes->getModulosOpcoes();
    $dados['perfil_acesso'] = $perfilAcesso->getPerfilAcesso($params[0]['id']);

    $this->renderAdmin(true, 'admin/perfil-edit', $dados);
  }
}
