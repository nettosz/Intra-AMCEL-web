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
