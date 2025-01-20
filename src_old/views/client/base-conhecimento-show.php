<div class="titulo-pagina">
  <h1 class="title-container">Base Conhecimento</h1>
  <hr />
</div>
<div class='base-container-show'>
  <div class="base-titulo">
    <h3><?= $base['titulo']; ?></h3>
  </div>
  <div class="base-info">
    <p class="base-categoria"><?= $base['nome']; ?> (<?= $base['sub_cat'] ?>)</p>
    <p class="base-user-post-info">Postado por <strong> <?= $base['nome_user']; ?> </strong> em <strong> <?= $base['dt_criacao'] ?> </strong></p>
  </div>
  <div class="base-descricao">
    <?= $base['descricao']; ?>
  </div>
</div>
