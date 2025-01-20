<?php

use src\Models\permissaoModel;

$permissao = new permissaoModel();
$permi = $permissao->getPermissao();
?>
<nav id="menu">
  <ul>
    <li>
      <div>
        <a href='<?= BASE_URL ?>home'>
          <i class=" fa fa-home icon"></i>
          <label htmlFor=""> Início </label>
        </a>
      </div>
    </li>
    <?php if (!empty($permi[0]['tp_perfil']) && $permi[0]['tp_perfil'] !== 'V') : ?>
      <li>
        <div>
          <a href="<?= BASE_URL ?>usuario/perfil">
            <i class=" fa fa-user icon"></i>
            <label htmlFor=""> Meu Perfil </label>
          </a>
          <hr />
        </div>
      </li>
    <?php endif; ?>

    <!-- <li>
      <div>Intra Comunicação</div>
    </li>
    <li>
      <a href='/alerts'>
        <div>
          <i class=" fa fa-exclamation-triangle icon"></i>
          <label htmlFor="">Avisos</label>
        </div>
      </a>
    </li>
    <li>
      <a href='/contacts'>
        <div>
          <i class=" fa fa-phone icon"></i>
          <label htmlFor=""> Contatos e Ramais</label>
        </div>
      </a>
    </li>
    <li>
      <div>
        <a href="/news">
          <i class=" fa fa-file-text-o icon"></i>
          <label htmlFor="">Noticias</label>
        </a>
      </div>
    </li>
    <li>
      <div>
        <i class=" fa fa-question icon"></i>
        <label htmlFor="">Enquetes</label>
      </div>
    </li>
    <li>
      <div>
        <i class=" fa fa-cutlery icon"></i>
        <label htmlFor="">Cardapio da semana</label>
      </div>
    </li>
    <li>
      <div>
        <i class=" fa fa-mobile icon"></i>
        <label htmlFor="">Achados e perdidos</label>

      </div>
    </li>

    <li>
      <div>
        <i class=" fa fa-calendar icon"></i>
        <label htmlFor="">Aniversariantes</label>

      </div>
    </li>
    <li>
      <div>
        <i class=" fa fa-calendar-times-o icon"></i>
        <label htmlFor="">Reservas de sala</label>

      </div>
    </li> -->

    <li>
      <div> TI </div>
    </li>

    <?php if (!empty($permi[0]) && in_array(
      [
        'cod_perfil' => '50',
        'cod_modulo' => '1',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'V'
      ],
      $permi
    ) || in_array(
      [
        'cod_modulo' => '1',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'F'
      ],
      $permi
    )) :
    ?>
      <li>
        <div>
          <a href="<?= BASE_URL ?>base-conhecimento">
            <i class=" fa fa-globe icon"></i>
            <label> Base conhecimento</label>
          </a>
        </div>
      </li>
    <?php endif; ?>



    <?php if (!empty($permi[0]) && in_array(
      [
        'cod_perfil' => '50',
        'cod_modulo' => '7',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'V'
      ],
      $permi
    ) || in_array(
      [
        'cod_modulo' => '7',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'F'
      ],
      $permi
    )) :
    ?>
      <li>
        <a href='<?= BASE_URL ?>departamento'>
          <div>
            <i class="fa fa-sitemap icon" aria-hidden="true"></i>
            <label htmlFor=""> Departamentos </label>
          </div>
        </a>
      </li>
    <?php endif; ?>

    <?php if (!empty($permi[0]) && in_array(
      [
        'cod_perfil' => '50',
        'cod_modulo' => '6',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'V'
      ],
      $permi
    ) || in_array(
      [
        'cod_modulo' => '6',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'F'
      ],
      $permi
    )) :
    ?>

      <li>
        <a href='<?= BASE_URL ?>cargos'>
          <div>
            <i class="fa fa-sitemap icon" aria-hidden="true"></i>
            <label htmlFor=""> Cargos </label>
          </div>
        </a>
      </li>
    <?php endif; ?>

    <?php if (!empty($permi[0]) && in_array(
      [
        'cod_perfil' => '50',
        'cod_modulo' => '4',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'V'
      ],
      $permi
    ) || in_array(
      [
        'cod_modulo' => '4',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'F'
      ],
      $permi
    )) :
    ?>
      <li>
        <a href='<?= BASE_URL ?>ramais-contatos'>
          <div>
            <i class=" fa fa-phone icon"></i>
            <label htmlFor=""> Ramais e Contatos </label>
          </div>
        </a>
      </li>
    <?php endif; ?>

    <?php if (!empty($permi[0]) && in_array(
      [
        'cod_perfil' => '50',
        'cod_modulo' => '2',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'V'
      ],
      $permi
    ) || in_array(
      [
        'cod_modulo' => '2',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'F'
      ],
      $permi
    )) :
    ?>
      <li>
        <div>
          <a href="<?= BASE_URL ?>videos">
            <i class=" fa fa-play icon"></i>
            <label> Videos </label>
          </a>
        </div>
      </li>
    <?php endif; ?>
    <hr>
    <?php if (!empty($permi[0]) && $permi[0]['tp_perfil'] !== 'V') : ?>
      <li>
        <div>
          <a href="<?= BASE_URL ?>admin/home">
            <i class=" fa fa-tachometer icon"></i>
            <label> Admin </label>
          </a>
        </div>
      </li>
    <?php endif; ?>

    <?php if (!empty($permi[0]) && in_array(
      [
        'cod_perfil' => '50',
        'cod_modulo' => '3',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'V'
      ],
      $permi
    ) || in_array(
      [
        'cod_modulo' => '3',
        'cod_modulo_opcao' => '4',
        'tp_perfil' => 'F'
      ],
      $permi
    )) :
    ?>
      <li>
        <div>
          <a href="<?= BASE_URL ?>agendamento-salas">
            <i class="fa fa-bookmark icon" aria-hidden="true"></i>
            <label> Agendamento Salas </label>
          </a>
        </div>
      </li>
    <?php endif; ?>

    <!-- <li>
      <div>
        <i class=" fa fa-book icon"></i>
        <label htmlFor=""> Biblioteca </label>
      </div>
    </li>

    <li>
      <div>
        <i class=" fa fa-exclamation icon"></i>
        <label htmlFor=""> Comunicado Interno </label>
      </div>
    </li>


    <li>
      <div> Recurso humanos </div>
    </li>

    <li>
      <div>
        <a href='/holerite'>
          <i class=" fa fa-credit-card-alt icon"></i>
          <label htmlFor=""> Holerite Online </label>
        </a>
      </div>
    </li>

    <li>
      <div> TI </div>
    </li>

    <li>
      <div>
        <i class="fa fa-cogs icon"> </i>
        <label htmlFor=""> Controles TI </label>
      </div>
    </li> -->
  </ul>
</nav>
<script>
  const menu = document.querySelector('#menu')
  const btnMenuStart = document.querySelector('.btn-menu-slider')

  btnMenuStart.addEventListener('click', () => {
    console.log(menu.style.left)
    if (menu.style.left === '0px') {
      menu.style.animation = "menu-slider-hide 0.8s linear"
    } else {
      menu.style.animation = "menu-slider-show 0.8s linear"
    }
  })

  menu.addEventListener('animationend', (event) => {
    if (event.animationName === 'menu-slider-show') {
      menu.style.animation = ""
      menu.style.left = "0"
    } else {
      menu.style.animation = "menu-slider-hide 0.8s linear"
      menu.style.left = "-500px"
    }
  })
</script>
