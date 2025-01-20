<div class="container-baseconhecimento">
  <h4>Politica - Criar</h4>
  <hr />
  <?php if (!empty($erro)) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Atenção!</strong>
      <?= $erro; ?>
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

  <form action="" method="post" id="form-base" enctype="multipart/form-data">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <label> Titulo: </label>
          <input class="form-control" name="titulo" id="titulo" value="<?= $politica['titulo']; ?>" />
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6">
          <input type="file" name="pdf" class="form-control-file" id="pdf" />
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6">
          <label for=""> Arquivo inglês </label>
          <input type="file" name="pdf_en" class="form-control-file" id="pdf" />
        </div>
      </div>
      <br />
    </div>
    <br />
    <button id="btn-salvar-base" type="submit" class="btn btn-success">
      Salvar
    </button>
  </form>
</div>