<div class="container-master">
<div class="agendamento-container">
  <h1 class="title-container">Base Conhecimento</h1>
  <hr />
  <div class="row">
    <div class="col-md-12">
      <form id="form-search-video">
        <div class="search-video">
          <label style="width: 100%;" for="">
            <input id="search-base" class="form-control" type="text" placeholder="pesquisar soluções...">
            <i class="fa fa-search"> </i>
          </label>
        </div>
      </form>
    </div>
  </div>
  <hr>
  <div class="container-body container-bases">
    <?php foreach ($bases as $base) : ?>
      <div class="row">
        <div class="col-md-12">
          <div class="result-base">
            <label> <?= $base['titulo']; ?> </label>
            <p class="base-categoria"> <?= $base['nome']; ?> (<?= $base['sub_cat']; ?>) </p>
            <p class="base-desc"> <?= utf8_encode($base['desc_curta']); ?></p>
            <a class="base-link" href="<?= BASE_URL; ?>base-conhecimento/<?= $base['id'] ?>/show"> Ver mais </a>
            <p class="dt_criacao_base"> Criado em <?= $base['dt_criacao']; ?> </p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
    </div>
    </div>
<script src="<?= BASE_URL ?>assets/js/bundles/client_search_base.bundle.js"> </script>
