<?php
$user = unserialize($_SESSION['user']);
?>
<h4> Meus dados </h4>
<a href="<?= BASE_URL . 'usuario/logout' ?>" class="btn btn-light">Sair</a>
<hr>
<div class="media">
  <img width="100px" src="<?= $user->getAvatar(); ?>" class="align-self-start mr-3" alt="...">
  <div class="media-body">
    <h5 class="mt-0"><?= $usuario['nome']; ?></h5>
    <div class="row">
      <div class="col-md-4">
        <p> <strong> Email: </strong> <?= $usuario['email']; ?></p>
      </div>
      <div class="col-md-4">
        <p> <strong> Data Nascimento: </strong> <?= date('d/m/Y', strtotime($usuario['dt_nascimento'])); ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <p> <strong> Departamento: </strong> <?= $usuario['nome_departamento']; ?></p>
      </div>
      <div class="col-md-4">
        <p> <strong> Cargo: </strong> <?= $usuario['nome_cargo']; ?></p>
      </div>
    </div>

  </div>
</div>
