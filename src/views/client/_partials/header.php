<header>
  <div class="header-items">
    <div class="btn-menu-slider" onclick="">
      <div> <a style="color:white; border: 1px solid #fff; padding: 10px; font-size: 8px;" href="{{BASE_URL}}auth"> FAZER LOGIN </a> </div>
    </div>
    <div class="header-logo">
      <img class="header-logo-img" src="{{BASE_URL}}assets/imgs/logo.png" alt="imagem" />
    </div>

    <h4 style="color: #fff;
    font-family: emoji;
    font-size: 18px;">  INTRAMCEL</h4>

    <div class="header-user-settings">
      <ul>
        {% if usuario %}
          <li class="header-user-item">
            <div class="header-user-logo" style="background:green;">
              <img style="width: 45px; border-radius: inherit;" src="{{ usuario.getAvatar() }}" />
            </div>
          </li>
          <li>
            <div>
              <a href="{{BASE_URL}}usuario/perfil" style="color:white; position: relative;">
                {{ usuario.getName() }}
              </a>
            </div>
          </li>
        {% else %}
          <li>
            <div> <a style="color:white; border: 1px solid #fff; padding: 10px; font-size: 8px;" href="{{BASE_URL}}auth"> FAZER LOGIN </a> </div>
          </li>
        {% endif %} 
      </ul>
    </div>
  </div>
</header>
