<div class='container-fluid'>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background: #fff; padding: .75rem 0px; margin-bottom: 0px">
      <li class="breadcrumb-item"><a class="title-container" href="<?= BASE_URL ?>">Home</a></li>
      <li class="breadcrumb-item"><a class="title-container" href="<?= BASE_URL ?>cargos">Cargos</a></li>
      <li class="breadcrumb-item active" aria-current="page">Criar</li>
    </ol>
  </nav>
  <h4> Cadastro Cargos</h4>
  <hr>
  <?php if (!empty($erro)) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Atenção!</strong> <?= $erro; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php elseif (!empty($success)) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $success; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <form method="POST">
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="inputCity">Nome Cargo:</label>
        <input type="text" name="cargo" class="form-control">
      </div>
      <div class="form-group col-md-5">
        <label for="inputCity">Departamento:</label>
        <select class="form-control" name="departamento">
          <option value="0"> Selecionar...</option>
          <?php foreach ($departamentos as $departamento) : ?>
            <option value="<?= $departamento['id'] ?>"> <?= $departamento['nome']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <a class="btn btn-danger" href="<?= BASE_URL . 'cargos' ?>">Cancelar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>

</div>