<div class="agendamento-container">
  <h1 class="title-container"> Ramais </h1>
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
      'cod_modulo' => '4',
      'cod_modulo_opcao' => '3',
      'tp_perfil' => 'V'
    ],
    $permissao
  ) || in_array(
    [
      'cod_modulo' => '4',
      'cod_modulo_opcao' => '3',
      'tp_perfil' => 'F'
    ],
    $permissao
  )) :
  ?>

    <div class="agendamento-body">
      <div class="agendamento-criar">
        Adicionar novo numero
        <a href="<?= BASE_URL . 'ramais-contatos/criar' ?>" style="border-radius: 50%; width:40px; height: 40px;" class="btn btn-success">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <hr>
  <?php endif; ?>

  <div class="row">
    <div class="col-md-12">
      <div class="link-pdf">
        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
        <a href="<?= BASE_URL; ?>pdf/ramal" target="_blank">
          Gerar PDF
        </a>
      </div>
    </div>
  </div>

  <div class="container-table">
    <table id="dataTable" class="table table-striped table-bordered" style="width: 100%;">
      <thead>
        <tr>
          <th> Id </th>
          <th> Nome</th>
          <th> Ramal </th>
          <th> Celular </th>
          <th> Ações </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($ramais as $ramal) : ?>
          <tr>
            <td><?= $ramal['id']; ?></td>
            <td><?= $ramal['nome']; ?></td>
            <td><?= $ramal['ramal']; ?></td>
            <td><?= $ramal['celular']; ?></td>
            <td>
              <?php if (in_array(
                [
                  'cod_perfil' => '50',
                  'cod_modulo' => '4',
                  'cod_modulo_opcao' => '1',
                  'tp_perfil' => 'V'
                ],
                $permissao
              ) || in_array(
                [
                  'cod_modulo' => '4',
                  'cod_modulo_opcao' => '1',
                  'tp_perfil' => 'F'
                ],
                $permissao
              )) :
              ?>
                <a class="btn btn-warning" style="color:white;" href="<?= BASE_URL ?>ramais-contatos/<?= $ramal['id'] ?>/edit">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
              <?php endif; ?>
              <?php if (in_array(
                [
                  'cod_perfil' => '50',
                  'cod_modulo' => '4',
                  'cod_modulo_opcao' => '2',
                  'tp_perfil' => 'V'
                ],
                $permissao
              ) || in_array(
                [
                  'cod_modulo' => '4',
                  'cod_modulo_opcao' => '2',
                  'tp_perfil' => 'F'
                ],
                $permissao
              )) :
              ?>
                <a data-toggle="modal" data-target="#exampleModal" data-id="<?= $ramal['id']; ?>" class="btn btn-danger" href="<?= BASE_URL ?>ramais-contatos/<?= $ramal['id'] ?>/delete"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
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
          <form method="post" action="<?= BASE_URL; ?>ramais-contatos">
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
