<div class="menu-container">

  <section class="menu-options">

    <?php if (!empty($_SESSION['user'])) : ?>
      <a href="<?= BASE_URL ?>usuario/perfil" data-module="0" class="menu-item">
        <img src="<?= BASE_URL ?>assets/imgs/user.png" alt="user" />
        <label> PERFIL </label>
      </a>
    <?php endif; ?>

    <a data-url="<?= BASE_URL ?>ramais-contatos" class="menu-item" data-module="Ramais e Contatos">
      <img src="<?= BASE_URL ?>assets/imgs/fone.png" alt="user" />
      <label> RAMAL </label>
    </a>

    <a data-url="<?= BASE_URL ?>politicas" class="menu-item" data-module="Politicas">
      <img src="<?= BASE_URL ?>assets/imgs/politicas.png" alt="user" />
      <label> POLÍTICAS E NORMAS </label>
    </a>

    <a data-url="<?= BASE_URL ?>lgpd" class="menu-item" data-module='LGPD'>
      <img src="<?= BASE_URL ?>assets/imgs/security.png" alt="user" />
      <label> LGPD </label>
    </a>

    <a data-url="<?= BASE_URL ?>achados-perdidos" class="menu-item" data-module='Achados Perdidos'>
      <img src="<?= BASE_URL ?>assets/imgs/procurado.png" alt="user" style="width: 40px; height: 40px;" />
      <label> ACHADOS E PERDIDOS </label>
    </a>

    <a data-url="<?= BASE_URL ?>noticias" class="menu-item" data-module='noticias'>
      <img src="<?= BASE_URL ?>assets/imgs/news.png" alt="user" />
      <label> NOTÍCIAS</label>
    </a>

    <a href="http://10.20.84.37/amcel-procedimentos" data-module="0" target="_blank" data-module='Admin' class="menu-item">
      <img src="<?= BASE_URL ?>assets/imgs/book.png" alt="user" />
      <label> PROCEDIMENTO DEPARTAMENTAL </label>
    </a>

    <a data-url="<?php BASE_URL; ?>admin/home" class="menu-item" data-module='Admin'>
      <img src="<?= BASE_URL ?>assets/imgs/admin.png" alt="user" />
      <label> ADMIN </label>
    </a>

    <a data-url="<?php BASE_URL; ?>agendamento-salas" class="menu-item" data-module='Salas Agendamento'>
      <img src="<?= BASE_URL ?>assets/imgs/salas.png" alt="user" />
      <label> AGENDAMENTO SALAS </label>
    </a>

    <a data-url="<?php BASE_URL; ?>base-conhecimento" class="menu-item" data-module='Base Conhecimento'>
      <img src="<?= BASE_URL ?>assets/imgs/base.png" alt="user" />
      <label> BASE CONHECIMENTO </label>
    </a>

    <a data-url="<?php BASE_URL; ?>videos" data-module="Videos" class="menu-item">
      <img src="<?= BASE_URL ?>assets/imgs/videos.png" alt="user" />
      <label> VIDEOS EDUCATIVOS </label>
    </a>

  </section>

</div>

<script src="<?= BASE_URL ?>assets/js/plugins/axios/axios.js"></script>

<script>
  const menu_itens = document.querySelectorAll('.menu-item')

  menu_itens.forEach((menu_item) => {
    menu_item.addEventListener('click', (e) => {
      const {
        url,
        module
      } = e.currentTarget.dataset

      const parameters = new URLSearchParams();
      parameters.append('module', module)

      if (module !== '0') {
        axios({
          method: "POST",
          url: "http://<?= $_ENV['HOST'] ?>/intra-amcel-web/home/permissao",
          data: parameters
        }).then((response) => {
          console.log(response.data.status_code)
          if (response.data.status_code === 200) {
            window.location.href = url;
          } else {
            alert('Sem permissão para acessar o modulo!')
          }
        });
      }
    })
  })

  window.onload = () => {
    <?php if (!empty($imagem_fundo_url)) : ?>
      document.body.style.backgroundImage = 'url(<?= $imagem_fundo_url; ?>)';
      document.body.style.backgroundRepeat = 'no-repeat';
      document.body.style.backgroundSize = 'cover'
    <?php endif; ?>
  }
</script>