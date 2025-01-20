<div class="container-baseconhecimento">
  <h4> Base conhecimento - Editar</h4>
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

  <form action="" method="post" id="form-base-edit">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <label> Titulo: </label>
          <input class="form-control" name="titulo" id="titulo" value="<?= $base['titulo']; ?>" />
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-10">
          <label> Descrição curta: </label>
          <input class="form-control" name="desc_curta" id="desc_curta" value="<?= $base['desc_curta'] ?>" />
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label for=""> Categoria</label>
          <select class="form-control categoria" name="categoria" id="categoria" data-id="<?= $base['id_cat'] ?>">
            <?php foreach ($categorias as $categoria) : ?>
              <option value="0"> Selection...</option>
              <option value="<?= $categoria['id'] ?>"> <?= $categoria['nome'] ?> </option>
            <?php endforeach; ?>
          </select>
          <br />
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ExemploModalCentralizado">
            Cadastrar
          </button>
        </div>
        <div class="col-md-3">
          <label for=""> Sub Categoria </label>
          <select class="form-control" name="sub_categoria" id="sub-categoria" data-id="<?= $base['id_subcat'] ?>">
            <option value="0"> Selecionar...</option>
          </select>
          <br />
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-sub-categoria">
            Cadastrar
          </button>
        </div>
      </div>
      <br />
      <h4> Conteudo </h4>
      <textarea id="summernote" name="editordata"></textarea>
      <input style="display:none;" type="text" name="descricao">
    </div>
    <br>
    <button id="btn-salvar-base" type="submit" class="btn btn-success"> Salvar </button>
  </form>
</div>


<!-- Modal -->
<div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Castrado - Categoria </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <select class="form-control" name="categoria-modal" id="categoria-modal">
          <option value="0"> Selecionar...</option>
        </select>
      </div>
      <div id="options-modal">
        <a id="categoria-criar" href="#salvar"> Criar </a>
        <a id="categoria-deletar" href="#Deletar"> Deletar </a>
        <a id="categoria-editar" href="#editar"> Editar </a>
      </div>

      <div class="modal-input" style="width: 50%;">
        <label for=""> Nome </label>
        <input id="inputOption" class="form-control" type="text" />
        <button id="btn-salvar-categoria" style="margin-top: 10px !important" class="btn btn-primary"> Salvar </button>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Categoria -->
<div class="modal fade" id="modal-sub-categoria" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Castrado - Sub-Categoria </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <label for=""> Categoria </label>
        <select class="form-control" name="categoria-modal" data-id="<?= $base['id_cat'] ?>" id="categoria-modal-sub">
          <option value="0"> Selecionar...</option>
        </select>
        <label for=""> Sub Categoria </label>
        <select class="form-control" name="sub-categoria" id="sub-categoria-modal" data-id="<?= $base['id_subcat']; ?>">
          <option value=" 0"> Selecionar...</option>
        </select>
      </div>
      <div id="options-modal">
        <a id="sub-categoria-criar" href="#salvar-sub"> Criar </a>
        <a id="sub-categoria-deletar" href="#Deletar-sub"> Deletar </a>
        <a id="sub-categoria-editar" href="#editar-sub"> Editar </a>
      </div>

      <div class="modal-input-sub" style="width: 50%;">
        <label for=""> Nome </label>
        <input id="inputOptionSub" class="form-control" type="text" />
        <button id="btn-salvar-sub-categoria" style="margin-top: 10px !important" class="btn btn-primary"> Salvar </button>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>

    </div>
  </div>
</div>

<script src="<?= BASE_URL ?>assets/js/bundles/base.bundle.js"></script>


<script>
  document.querySelector('#form-base-edit').addEventListener('submit', () => {
    document.querySelector('input[name="descricao"]').value = $('#summernote').summernote('code')
  })

  func.getCategoria("/admin/categoria", "#categoria");
  func.getCategoria(
    `/admin/categoria/<?= $base['id_cat'] ?>/sub?table=base_conhecimento`,
    "#sub-categoria"
  );
</script>
