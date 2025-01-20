<div class="video-container">
  <h1 class="title-container">videos</h1>
  <hr />
  <div class="row">
    <div class="col-md-12">
      <form id="form-search-video">
        <div class="search-video">
          <label style="max-width: 450px;" for="">
            <input id="search-video" class="form-control" type="text" placeholder="pesquisar videos...">
            <i class="fa fa-search"> </i>
          </label>
        </div>
      </form>
    </div>
  </div>
  <hr>
  <div id="container-body">
    <?php foreach ($videos as $video) : ?>
      <a onclick="" href="#" id="card-video" class="card card-link-video">
        <iframe mozallowfullscreen="mozallowfullscreen" class="card-img-top" src="<?= $video['url']; ?>" frameborder="0" allowfullscreen="allowfullscreen">
        </iframe>
        <div class="card-body">
          <h5 class="card-title"><?= $video['nome_video']; ?></h5>
          <p class="card-text"><?= utf8_encode($video['descricao']) ?></p>
          <p class="card-text"><small class="text-muted">postado em <?= $video['dt_criacao'] ?></small></p>
        </div>
      </a>
    <?php endforeach; ?>

  </div>
</div>

<script src="<?= BASE_URL ?>assets/js/bundles/client_video_search.bundle.js"> </script>
