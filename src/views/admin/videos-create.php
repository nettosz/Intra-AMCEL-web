<div class="container-baseconhecimento">
  <h4> Videos - Criar</h4>
  <hr />
  <?php if (!empty($error)) : ?>
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
  <form method="POST" enctype="multipart/form-data">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <label> Titulo: </label>
          <input class="form-control" name="titulo" id="titulo" />
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-md-6">
          <label> Tipo Vídeo: </label>
          <select id="tipo_video" name="tipo_video" class="form-control">
            <option value="link"> Link </option>
            <option value="arquivo"> Arquivo </option>
          </select>
        </div>
      </div>

      <div class="row mt-3" id="link">
        <div class="col-md-6">
          <label> URL: </label>
          <input type="text" class="form-control" name="video_url" id="vide_url" />
        </div>
      </div>


      <div class="row mt-3" id="video" style="display: none">
        <div class="col-md-6">
          <label> Arquivo: </label>
          <input type="file" class="form-control" name="file_video" id="file_video" />
        </div>
      </div>

      <br>
      <div class="row">
        <div class="col-md-3">
          <label for=""> Categoria</label>
          <select class="form-control categoria" name="categoria" id="categoria">
            <option value="0"> Selection...</option>
          </select>
          <br />
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ExemploModalCentralizado">
            Cadastrar
          </button>
        </div>
        <div class="col-md-3">
          <label for=""> Sub Categoria </label>
          <select class="form-control" name="sub-categoria" id="sub-categoria">
            <option value="0"> Selecionar...</option>
          </select>
          <br />
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-sub-categoria">
            Cadastrar
          </button>
        </div>
      </div>

      <div class="row">
        <div class="col-md-10">
          <label> Descrição: </label>
          <textarea style="height: 200px;" class="form-control" name="descricao" id="descricao"></textarea>
        </div>
      </div>

    </div>
    <br>
    <button type="submit" class="btn btn-success"> Salvar </button>
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
        <select class="form-control" name="categoria-modal" id="categoria-modal-sub">
          <option value="0"> Selecionar...</option>
        </select>
        <label for=""> Sub Categoria </label>
        <select class="form-control" name="sub-categoria" id="sub-categoria-modal">
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

<script src="<?= BASE_URL ?>assets/js/bundles/video.bundle.js"> </script>

<script>
  document.getElementById('tipo_video').addEventListener('change', (e) => {
    const tipo_video = e.target.options[e.target.selectedIndex].value;

    const video = document.querySelector('#video')
    const link = document.querySelector('#link')

    if (tipo_video === 'link') {
      link.style.display = 'flex';
      video.style.display = 'none';
    } else {
      video.style.display = 'flex';
      link.style.display = 'none'
    }
  })

  // const inputImage = document.querySelector('#imagem')

  // inputImage.addEventListener('change', (e) => {
  //   const [file] = e.target.files;
  //   const image = document.querySelector('.img-fundo')
  //   image.src = URL.createObjectURL(file)
  // })
</script>