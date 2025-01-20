<div class="container-baseconhecimento">
  <h4> Perfil - Editar</h4>
  <hr />
  <?php if (!empty($aviso['erro'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Atenção!</strong> <?= $aviso['erro']; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

  <?php elseif (!empty($aviso['sucesso'])) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $aviso['sucesso']; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

  <?php endif; ?>


  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Atenção!</strong> Caso você retire um usuário do perfil ele ficará sem perfil,
    dessa forma não poderá logar, mesmo que ele já tenha completado o cadastro de usuário!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form action="" method="post" id="form-base">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <label> Nome Perfil: </label>
          <input class="form-control" name="nome" id="titulo" value="<?= $perfil['nome']; ?>" />
        </div>
        <div class="col-md-6">
          <label> Tipo Pefil: </label>
          <select class="form-control" name="tipo_perfil">
            <option value="F" <?= ($perfil['tp_perfil'] === 'F') ? 'selected' : ''; ?>> Funcionario </option>
            <option value="V" <?= ($perfil['tp_perfil'] === 'V') ? 'selected' : ''; ?>> Visitante </option>
          </select>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-12">
          <label for=""> Modulos </label> <br>
          <?php foreach ($modulos as $modulo) : ?>
            <h6 style="margin-top: 20px;">
              <?= utf8_encode($modulo['nome']) . '<br/>'; ?>
            </h6>
            <div class="modulos-opcoes">
              <?php foreach ($modulos_opcoes as $modulo_opcao) : ?>
                <div class="form-check" style="display: inline-block;">
                  <?php if (in_array(["cod_modulo" => "{$modulo['id']}", "cod_modulo_opcao" => "{$modulo_opcao['id']}"], $perfil_acesso)) : ?>
                    <input class="form-check-input" type="checkbox" name="modulo[<?= $modulo['id'] ?>][<?= $modulo_opcao['id'] ?>]" checked>
                  <?php else : ?>
                    <input class="form-check-input" type="checkbox" name="modulo[<?= $modulo['id'] ?>][<?= $modulo_opcao['id'] ?>]">
                  <?php endif; ?>
                  <label class="form-check-label" for="defaultCheck2">
                    <?php echo $modulo_opcao['opcao']; ?>
                  </label>
                </div>
              <?php endforeach ?>
            </div>
          <?php endforeach ?>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-10">
          <label> Emails: </label>
          <textarea style="height: 100px;" class="form-control" name="emails" id="descricao"><?= $emails; ?></textarea>
          <small> Separar por "|", exemplo : email@email.com | email@email.com </small>
        </div>
      </div>
    </div>
    <br>
    <button id="btn-salvar-base" type="submit" class="btn btn-success"> Salvar </button>
  </form>
</div>
