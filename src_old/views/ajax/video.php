<?php foreach ($videos as $video) : ?>
  <a onclick="" href="#" style="width: 310px;" class="card card-link-video">
    <iframe mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" class="card-img-top" src="<?= $video['url']; ?>" frameborder="0" allowfullscreen="allowfullscreen">
    </iframe>
    <div class="card-body">
      <h5 class="card-title"><?= $video['nome_video']; ?></h5>
      <p class="card-text"><?= utf8_encode($video['descricao']) ?></p>
      <p class="card-text"><small class="text-muted">postado em <?= $video['dt_criacao'] ?></small></p>
    </div>
  </a>
<?php endforeach; ?>
