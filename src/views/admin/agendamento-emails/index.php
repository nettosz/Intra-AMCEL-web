<div class="container-baseconhecimento">
  <h4> Agendamento Salas Emails </h4>
  <hr />
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
  <a class="btn btn-success" href="<?= BASE_URL ?>admin/agendamento-sala-emails/create"> Adicionar </a>
  <div class="container-table">
    <table id="dataTable" class="table table-striped table-bordered" style="width: 100%;">
      <thead>
        <tr>
          <th> Id </th>
          <th> Email </th>
          <th> Ações </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($emails as $email) : ?>
          <tr>
            <td><?= $email['id']; ?></td>
            <td><?= $email['email']; ?></td>
            <td>
              <a class="btn btn-warning" style="color:white;" href="<?= BASE_URL ?>admin/agendamento-sala-emails/<?= $email['id'] ?>/edit"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
              <a data-toggle="modal" data-target="#exampleModal" data-id="<?= $email['id']; ?>" class="btn btn-danger" href="<?= BASE_URL ?>admin/agendamento-sala-emails/<?= $email['id'] ?>/delete"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
            </td>
          </tr>
        <?php endforeach; ?>
    </table>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agendamento Salas Emails - Excluir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?= BASE_URL; ?>admin/agendamento-sala-emails">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Deseja Excluir este Registro?</label>
              <input style="display:none;" type="text" class="form-control" name="id">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Confirmar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
