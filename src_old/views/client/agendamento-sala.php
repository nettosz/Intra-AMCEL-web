<div class="agendamento-container">
  <h1 class="title-container">Agendamento Salas</h1>
  <hr />
  <!-- <?php var_dump($permissao); ?> -->
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

  <?php if (in_array(
    [
      'cod_perfil' => '50',
      'cod_modulo' => '3',
      'cod_modulo_opcao' => '3',
      'tp_perfil' => 'V'
    ],
    $permissao
  ) || in_array(
    [
      'cod_modulo' => '3',
      'cod_modulo_opcao' => '3',
      'tp_perfil' => 'F'
    ],
    $permissao
  )) :
  ?>
    <div class="agendamento-body">
      <div class="agendamento-criar">
        Adicionar novo agendamento
        <a href="<?= BASE_URL . 'agendamento-salas/criar' ?>" style="border-radius: 50%; width:40px; height: 40px;" class="btn btn-success">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <hr>
  <?php endif; ?>
  <div class="container-table">
    <table id="dataTable" class="table table-striped table-bordered" style="width: 100%;">
      <thead>
        <tr>
          <th> Id </th>
          <th> Sala</th>
          <th> Data Criação </th>
          <th> Data Inicio </th>
          <th> Data fim </th>
          <th> Hora inicio </th>
          <th> Hora Fim </th>
          <th> Usuário </th>
          <th> Ações </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($agendamentos as $agendamento) : ?>
          <tr>
            <td><?= $agendamento['id']; ?></td>
            <td><?= $agendamento['numero']; ?></td>
            <td><?= date('d/m/Y', strtotime($agendamento['dt_agendamento'])); ?></td>
            <td><?= date('d/m/Y', strtotime($agendamento['dt_inicio'])); ?></td>
            <td><?= date('d/m/Y', strtotime($agendamento['dt_fim'])); ?> </td>
            <td><?= date('H:i:s', strtotime($agendamento['dt_inicio'])); ?></td>
            <td><?= date('H:i:s', strtotime($agendamento['dt_fim']));  ?></td>
            <td><?= $agendamento['nome']; ?></td>
            <td>
              <?php if (in_array(
                [
                  'cod_perfil' => '50',
                  'cod_modulo' => '3',
                  'cod_modulo_opcao' => '1',
                  'tp_perfil' => 'V'
                ],
                $permissao
              ) || in_array(
                [
                  'cod_modulo' => '3',
                  'cod_modulo_opcao' => '1',
                  'tp_perfil' => 'F'
                ],
                $permissao
              )) :
              ?>
                <a class="btn btn-warning" style="color:white;" href="<?= BASE_URL ?>agendamento/<?= $agendamento['id'] ?>/edit"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
              <?php endif; ?>
              <?php if (in_array(
                [
                  'cod_perfil' => '50',
                  'cod_modulo' => '3',
                  'cod_modulo_opcao' => '2',
                  'tp_perfil' => 'V'
                ],
                $permissao
              ) || in_array(
                [
                  'cod_modulo' => '3',
                  'cod_modulo_opcao' => '2',
                  'tp_perfil' => 'F'
                ],
                $permissao
              )) :
              ?>
                <a data-toggle="modal" data-target="#exampleModal" data-id="<?= $agendamento['id']; ?>" class="btn btn-danger" href="<?= BASE_URL ?>agendamento/<?= $agendamento['id'] ?>/delete"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
    </table>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agendamento Excluir - Excluir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?= BASE_URL; ?>agendamento-salas">
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
