<?php
if (!empty($_SESSION['user'])) {
  $user =  unserialize($_SESSION['user']);
}
?>
<header>
  <div class="header-items">
    <div class="btn-menu-slider" onclick="">
      <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="header-logo">
      <img class="header-logo-img" src="<?= BASE_URL ?>assets/imgs/logo.png" alt="imagem" />
    </div>

    <h4 style="color: #fff">  INTRAMCEL</h4>


    <div class="header-user-settings">
      <ul>
        <?php if (isset($_SESSION['user'])) : ?>
          <li class="header-user-item">
            <div class="header-user-logo" style="background:green;">
              <img style="width: 45px; border-radius: inherit;" src="<?= $user->getAvatar() ?>" />
            </div>
          </li>
          <li>
            <div>
              <a href="<?= BASE_URL . 'usuario/perfil'; ?>" style="color:white; position: relative;">
                <?= $user->getName(); ?>
              </a>
            </div>
          </li>
        <?php else : ?>
          <li>
          <div><a style="color: #fff !important; border-radius: 5px; border: 2px solid #fff; padding: 10px; font-size: 8px;" href="<?= BASE_URL ?>auth"> FAZER LOGIN </a> </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>
    <!-- <div class="header-info">
      <ul>
        <li>
          <div>
            <i class="fa fa-comment" aria-hidden="true"></i>
          </div>
        </li>
        <li>
          <div>
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
          </div>
        </li>
        <li>
          <div>
            <i class="fa fa-calendar" aria-hidden="true"></i>
          </div>
        </li>
        <li>
          <div>
            <i class="fa fa-bell" aria-hidden="true"></i>
          </div>
        </li>
      </ul>
    </div> -->
  </div>
</header>
