<div class='container-fluid'>
  <h4> Editar Cargo</h4>
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
        <input type="text" name="cargo" value="<?= $cargo['nome']; ?>" class="form-control">
      </div>
      <div class="form-group col-md-5">
        <label for="inputCity">Departamento:</label>
        <select class="form-control" name="departamento">
          <option value="0"> Selecionar...</option>
          <?php foreach ($departamentos as $departamento) : ?>
            <option value="<?= $departamento['id'] ?>" <?= in_array($cargo['cod_departamento'], $departamento) ? 'selected' : '' ?>>
              <?= $departamento['nome']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <a class="btn btn-danger" href="<?= BASE_URL . 'cargos' ?>">Cancelar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>

</div>
