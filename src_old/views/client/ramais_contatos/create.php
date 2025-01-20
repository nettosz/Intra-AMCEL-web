<div class='container-fluid'>
  <h4> Cadastro novo numero </h4>
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
        <label for="inputCity">Nome:</label>
        <input type="text" name="nome" class="form-control">
      </div>
      <div class="form-group col-md-5">
        <label for="inputCity">Ramal:</label>
        <input type="text" name="ramal" class="form-control">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="inputCity">Celular:</label>
        <input type="text" name="celular" class="form-control">
      </div>
    </div>

    <a class="btn btn-danger" href="<?= BASE_URL . 'ramais-contatos' ?>">Cancelar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>

</div>
