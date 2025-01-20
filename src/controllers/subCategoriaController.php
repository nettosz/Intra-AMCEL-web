<?php

namespace src\Controllers;
use src\Models\subCategoriasModel;

class subCategoriaController
{
  function index($params)
  {
    echo 'index';
  }

  function show($params)
  {
    echo 'show';
  }

  function create($params)
  {
    echo 'create';
  }

  function store($params)
  {
    var_dump($params);
    $categoria = new subCategoriasModel();
    
    $categoria->setSubCategoria('oloco', $params[0]['id']);
  }

  function edit($params)
  {
    echo 'edit';
  }

  function update($params)
  {
    echo 'update';
  }

  function delete($params)
  {
    echo 'delete';
  }

  function destroy($params)
  {
    echo 'destroy';
  }

}
