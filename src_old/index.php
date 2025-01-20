<?php
ob_start();
session_start();
require_once('../vendor/autoload.php');

use src\Routes\Routes;
use src\Models\permissaoModel;

$config = Dotenv\Dotenv::createImmutable(__DIR__ . '//..//');
$config->load();

define('TEMPLATES_PATH', $templates = __DIR__ . '\views\template');
define('TEMPLATES_VIEWS', $templates = __DIR__ . '\views\\');
define('BASE_URL', 'http://' . $_ENV['HOST'] . '/' . 'intra-amcel-web' . '/');


$router = new Routes();
$router->setControllerPath('src\\controllers\\');

//*** Login
$router->add('/auth', 'authController.index');
$router->add('/login', 'loginController.show');

//**** Home Routes ****

$authUrl = '123';
$router->add('/', 'homeController.index');
$router->add('/home', 'homeController.index');

//*** base Conhecimento 
$router->add('/base-conhecimento', 'baseConhecimentoCotroller.index');

//*** Routes Categorias
$router->add('/categoria/store', 'categoriaController.store');
$router->add('/categoria/{id}/update', 'categoriaController.edit');

//*** Routes Sub Categorias 
$router->add('/categoria/{id}/sub/store', 'subCategoriaController.store');
$router->add('/categoria/{id}/sub/update', 'subCategoriaController.edit');

//Client Route video
$router->add('/videos', 'videoController.index');

/** 
 * Admin Routes
 */

// Route Home

if (strpos($_SERVER['REQUEST_URI'], "admin")) {
  $permissao = new permissaoModel();
  $isAdmin = $permissao->getPermissao('Admin');
  if (in_array(
    [
      'cod_modulo' => '5',
      'cod_modulo_opcao' => '1',
      'tp_perfil' => 'F'
    ],
    $isAdmin
  ) || in_array(
    [
      'cod_modulo' => '5',
      'cod_modulo_opcao' => '2',
      'tp_perfil' => 'F'
    ],
    $isAdmin
  ) || in_array(
    [
      'cod_modulo' => '5',
      'cod_modulo_opcao' => '3',
      'tp_perfil' => 'F'
    ],
    $isAdmin
  )) {
    $router->add('/admin/home', 'adminHomeController.index');

    //Routes Base-conhecimento
    $router->add('/admin/base-conhecimento', 'adminBaseConhecimentoController.index');
    $router->add('/admin/base-conhecimento/create', 'adminBaseConhecimentoController.create');
    $router->add('/admin/base-conhecimento/store', 'adminBaseConhecimentoController.store');

    // sub categoria Routes
    $router->add('/admin/categoria/{id_categoria}/sub', 'admSubCategoriaController.index');
    $router->add(
      '/admin/categoria/{id_categoria}/sub/store',
      'admSubCategoriaController.store'
    );

    $router->add(
      '/admin/categoria/{id_categoria}/sub/{id_subcategoria}/update',
      'admSubCategoriaController.update'
    );

    $router->add(
      '/admin/categoria/{id_categoria}/sub/{id_subcategoria}/delete',
      'admSubCategoriaController.delete'
    );

    //*** Categoria Routes
    $router->add('/admin/categoria', 'admCategoriaController.index');
    $router->add('/admin/categoria/store', 'admCategoriaController.store');
    $router->add('/admin/categoria/{id}/update', 'admCategoriaController.update');
    $router->add('/admin/categoria/{id}/delete', 'admCategoriaController.delete');


    //*** Routes Videos 
    $router->add('/admin/videos', 'adminVideoController.index');
    $router->add('/admin/videos/create', 'adminVideoController.create');
    $router->add('/admin/videos/store', 'adminVideoController.store');
    $router->add('/admin/videos/{id}/edit', 'adminVideoController.edit');

    $router->add('/admin/perfil', 'adminPerfilController.index');
    $router->add('/admin/perfil/create', 'adminPerfilController.create');
    $router->add('/admin/perfil/{id}/edit', 'adminPerfilController.edit');

    $router->add('/admin/lgpd', 'adminLGPDController.index');
    $router->add('/admin/lgpd/criar', 'adminLGPDController.create');
    $router->add('/admin/lgpd/{id}/editar', 'adminLGPDController.edit');

    $router->add(
      '/admin/videos/{id_video}/update',
      'adminVideoController.update'
    );


    $router->add(
      '/admin/base-conhecimento/{id}/edit',
      'adminBaseConhecimentoController.edit'
    );

    $router->add('/admin/agendamento-sala-emails', 'adminAgendamentoEmailController.index');
    $router->add('/admin/agendamento-sala-emails/create', 'adminAgendamentoEmailController.create');
    $router->add('/admin/agendamento-sala-emails/{id}/edit', 'adminAgendamentoEmailController.update');
  } else {
    header('Location:' . BASE_URL);
  }
}

$router->add(
  '/video/search',
  'videoController.show'
);

//** Base Conhecimento  */

$router->add(
  '/base-conhecimento/search',
  'searchBaseCMTOController.show'
);

$router->add(
  '/base-conhecimento/{id}/show',
  'baseConhecimentoCotroller.show'
);

$router->add('/departamento/{id}/cargos', 'cargosController.show');
$router->add('/usuario/update', 'usuarioController.update');

$router->add('/usuario-completa-cadastro', 'usuarioController.edit');

$router->add('/usuario/perfil', 'perfilUserController.show');
$router->add('/agendamento-salas', 'agendamentoSalaController.index');
$router->add('/agendamento-salas/criar', 'agendamentoSalaController.create');
$router->add('/agendamento/{id}/edit', 'agendamentoSalaController.edit');
$router->add('/salas-reuniao', 'salasReuniaoController.index');
$router->add('/salas-reuniao/criar', 'salasReuniaoController.store');
$router->add('/solicitar-perfil', 'emailCofirmePerfilController.store');
$router->add('/usuario/logout', 'authController.destroy');


$router->add('/cargos', 'cargosController.index');
$router->add('/cargos/criar', 'cargosController.create');
$router->add('/cargos/{id}/edit', 'cargosController.edit');


$router->add('/departamento', 'departamentoController.index');
$router->add('/departamento/criar', 'departamentoController.create');
$router->add('/departamento/{id}/edit', 'departamentoController.edit');

$router->add('/ramais-contatos', 'ramalContatoController.index');
$router->add('/ramais-contatos/criar', 'ramalContatoController.create');
$router->add('/ramais-contatos/{id}/edit', 'ramalContatoController.edit');
$router->add('/pdf/ramal', 'ramalPDFController.index');

$router->routeNotFound = __DIR__ . '/views/404.php';
$router->show();



ob_end_flush();
