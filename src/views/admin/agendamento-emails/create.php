<div class='container-fluid'>
  <h4> Cadastro agendamento de sala Email</h4>
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
    <div class="form-group">
      <label for="email">Email *</label>
      <input type="text" id="email" name="email" class="form-control" />
    </div>
    <a class="btn btn-danger" href="<?= BASE_URL . 'admin\agendamento-sala-emails' ?>">Cancelar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>

</div>
