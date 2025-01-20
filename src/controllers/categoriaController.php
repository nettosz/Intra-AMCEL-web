<?php

namespace src\Controllers;
use src\Models\categoriasModel;

class categoriaController
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
    $categoria = new categoriasModel();
    $categoria->setCategoria('teste');
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
