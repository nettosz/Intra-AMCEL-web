<div class="container-baseconhecimento">
  <h4> Perfil - Criar</h4>
  <hr />
  <?php if (!empty($aviso)) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Atenção!</strong> <?= $aviso; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>
  <form action="" method="post" id="form-base">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <label> Nome Perfil: </label>
          <input class="form-control" name="nome" id="titulo" />
        </div>
        <div class="col-md-6">
          <label> Tipo Pefil: </label>
          <select class="form-control" name="tipo_perfil">
            <option value="F"> Funcionario </option>
            <option value="V"> Visitante </option>
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
                  <input class="form-check-input" type="checkbox" name="modulo[<?= $modulo['id'] ?>][<?= $modulo_opcao['id'] ?>]">
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
          <textarea style="height: 100px;" class="form-control" name="emails" id="descricao"></textarea>
          <small> Separar por "|", exemplo : email@email.com | email@email.com </small>
        </div>
      </div>
    </div>
    <br>
    <button id="btn-salvar-base" type="submit" class="btn btn-success"> Salvar </button>
  </form>
</div>
