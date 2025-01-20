<?php $user = unserialize($_SESSION['user']); ?>
<div class="container-cad-user">
  <form method="post" id="form-handle">
    <div class="form-row">
      <div class="img-user">
        <img src="<?= $user->getAvatar() ?>" alt="">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="departamento">Departamento *</label>
        <select id="departamento" name="departamento" class="form-control">
          <option value="0" selected>Escolher...</option>
          <?php foreach ($departamentos as $departamento) : ?>
            <option value="<?= $departamento['id'] ?>"> <?= $departamento['nome'] ?> </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="cargo">Cargo *</label>
        <select id="cargo" name="cargo" class="form-control">
          <option value="0" selected>Escolher...</option>
          <option>...</option>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Ramal</label>
        <input id="ramal" type="text" name="ramal" class="form-control" id="inputEmail4">
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Data Nascimento *</label>
        <input id="dataNascimento" type="date" name="dt_nascimento" class="form-control" id="inputEmail4">
      </div>
    </div>
    <button class="btn btn-primary"> Salvar </button>
  </form>
</div>
<script src="<?= BASE_URL ?>assets/js/plugins/axios/axios.js"></script>

<script>
  let departamento = document.querySelector('#departamento');
  let html = '<option>Escolher...</option>'

  let cargo = document.querySelector('#cargo');

  departamento.addEventListener('change', async (event) => {
    let optionSelected = departamento.options[departamento.selectedIndex].value;

    if (optionSelected !== 'Escolher...') {
      const response = await axios.get(`http://<?= $_ENV['HOST'] ?>/intra-amcel-web/departamento/${optionSelected}/cargos`)

      cargo.innerHTML = html + response.data
    }
  })

  let form = document.querySelector('#form-handle');
  form.addEventListener('submit', (event) => {
    event.preventDefault()
    let dataNascimento = document.querySelector('#dataNascimento')
    let ramal = document.querySelector('#ramal')

    if (departamento.options[departamento.selectedIndex].value === '0' ||
      cargo.options[cargo.selectedIndex].value === '0' ||
      dataNascimento.value === '') {
      alert('Preencha todos os Campos obrigatorios.')
    } else {
      const parameters = new URLSearchParams();
      parameters.append('cod_cargo', cargo.options[cargo.selectedIndex].value)
      parameters.append('email', `<?= $user->getEmail() ?>`)
      parameters.append('data_nascimento', dataNascimento.value)
      parameters.append('ramal', ramal.value)
      parameters.append('nome', `<?= $user->getName() ?>`)

      axios({
        method: "POST",
        url: "http://<?= $_ENV['HOST'] ?>/intra-amcel-web/usuario/update",
        data: parameters
      }).then((response) => {
        if (response.data.success) {
          alert('Salvo com sucesso!')

          window.location.href = "http://<?= $_ENV['HOST'] ?>/intra-amcel-web"
        } else alert('Erro ao salvar')
      });

    }
  })
</script>