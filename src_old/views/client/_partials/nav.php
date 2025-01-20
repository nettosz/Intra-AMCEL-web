<nav id="menu">
  <ul>
    <li>
      <div>
        <a href='{{BASE_URL}}home'>
          <i class=" fa fa-home icon"></i>
          <label htmlFor=""> Início </label>
        </a>
      </div>
    </li>
    {% if permissoes[0].tp_perfil != '' and permissoes[0].tp_perfil != 'V' %}
    <li>
      <div>
        <a href="{{BASE_URL}}usuario/perfil">
          <i class=" fa fa-user icon"></i>
          <label htmlFor=""> Meu Perfil </label>
        </a>
        <hr />
      </div>
    </li>
    {% endif %}


    <li>
      <div> TI </div>
    </li>
    {% if {
        'cod_perfil' : '50',
        'cod_modulo' : '1',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'V'
     } in permissoes or {
        'cod_modulo' : '1',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'F'
     } in permissoes %}
    <li>
      <div>
        <a href="{{BASE_URL}}base-conhecimento">
          <i class=" fa fa-globe icon"></i>
          <label> Base conhecimento</label>
        </a>
      </div>
    </li>
    {% endif %}


    {% if {
        'cod_perfil' : '50',
        'cod_modulo' : '7',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'V'
     } in permissoes or {
        'cod_modulo' : '7',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'F'
     } in permissoes %}
    <li>
      <a href='{{BASE_URL}}departamento'>
        <div>
          <i class="fa fa-sitemap icon" aria-hidden="true"></i>
          <label htmlFor=""> Departamentos </label>
        </div>
      </a>
    </li>
    {% endif %}

    {% if {
        'cod_perfil' : '50',
        'cod_modulo' : '6',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'V'
     } in permissoes or {
        'cod_modulo' : '6',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'F'
     } in permissoes %}

    <li>
      <a href='{{BASE_URL}}cargos'>
        <div>
          <i class="fa fa-sitemap icon" aria-hidden="true"></i>
          <label htmlFor=""> Cargos </label>
        </div>
      </a>
    </li>
    {% endif %}


    {% if {
        'cod_perfil' : '50',
        'cod_modulo' : '2',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'V'
     } in permissoes or {
        'cod_modulo' : '2',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'F'
     } in permissoes %}

    <li>
      <div>
        <a href="{{BASE_URL}}cargos">
          <i class=" fa fa-phone icon"></i>
          <label> Ramais e numeros </label>
        </a>
      </div>
    </li>

    {% endif %}


    {% if {
        'cod_perfil' : '50',
        'cod_modulo' : '2',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'V'
     } in permissoes or {
        'cod_modulo' : '2',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'F'
     } in permissoes %}

    <li>
      <div>
        <a href="{{BASE_URL}}videos">
          <i class=" fa fa-play icon"></i>
          <label> Videos </label>
        </a>
      </div>
    </li>
    {% endif %}



    <hr>
    {% if permissoes[0].tp_perfil != '' and permissoes[0].tp_perfil != 'V' %}
    <li>
      <div>
        <a href="{{BASE_URL}}admin/home">
          <i class=" fa fa-tachometer icon"></i>
          <label> Admin </label>
        </a>
      </div>
    </li>
    {% endif %}


    {% if {
        'cod_perfil' : '50',
        'cod_modulo' : '3',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'V'
     } in permissoes or {
        'cod_modulo' : '3',
        'cod_modulo_opcao' : '4',
        'tp_perfil' : 'F'
     } in permissoes %}
    <li>
      <div>
        <a href="{{BASE_URL}}agendamento-salas">
          <i class="fa fa-bookmark icon" aria-hidden="true"></i>
          <label> Agendamento Salas </label>
        </a>
      </div>
    </li>
    {% endif %}

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
