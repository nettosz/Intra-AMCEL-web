<div class='container-fluid'>
  <h4> Cadastro agendamento de sala</h4>
  <hr>
  <?php if (!empty($erro)) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Atenção!</strong> <?= $erro; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php elseif (!empty($success)) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $success; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <div class="agendamento-body">
    <div class="agendamento-criar">
      Sala reunião
      <a data-toggle="modal" data-target="#modal-sala-criar" data-whatever="@getbootstrap" href="#" style="border-radius: 50%; width:40px; height: 40px;" class="btn btn-success">
        <i class="fa fa-plus" aria-hidden="true"></i>
      </a>
    </div>
  </div>
  <hr>

  <form method="POST">
    <div class="form-group">
      <label for="cargo">Sala *</label>
      <select id="sala" name="sala" class="form-control">
        <option selected>Escolher...</option>
      </select>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="inputCity">Data Inicio</label>
        <input type="date" name="data_inicio" class="form-control" id="inputCity">
      </div>
      <div class="form-group col-md-5">
        <label for="inputCity">Data Fim</label>
        <input type="date" name="data_fim" class="form-control" id="inputCity">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="inputZip">Hora Inicio</label>
        <input type="time" name="hora_inicio" class="form-control" id="inputZip">
      </div>
      <div class="form-group col-md-5">
        <label for="inputZip">Hora Fim</label>
        <input type="time" name="hora_fim" class="form-control" id="inputZip">
      </div>
    </div>

    <a class="btn btn-danger" href="<?= BASE_URL . 'agendamento-salas' ?>">Cancelar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>

</div>

<div class="modal fade" id="modal-sala-criar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastar nova sala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-sala" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Sala:</label>
            <input type="text" class="form-control" name="sala-input" id="sala-input">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="<?= BASE_URL ?>assets/js/plugins/axios/axios.js"></script>

<script>
  window.addEventListener('load', () => updateSalaCombo())

  const updateSalaCombo = async () => {
    const response = await axios.get('<?= BASE_URL ?>salas-reuniao')
    const salas = document.querySelector('#sala')
    salas.innerHTML = '';
    salas.innerHTML = '<option selected>Escolher...</option>' + response.data;
  }

  let form_sala = document.querySelector('#form-sala');
  let sala = document.querySelector('#sala-input')
  form_sala.addEventListener('submit', (event) => {
    event.preventDefault();

    if (sala.value !== '') {
      let parameters = new URLSearchParams();
      parameters.append('numero', sala.value);
      axios({
        method: 'POST',
        url: '<?= BASE_URL ?>salas-reuniao/criar',
        data: parameters
      }).then(response => {
        if (response.data.sucess) {
          alert(response.data.sucess)
          updateSalaCombo();
        } else {
          alert('Erro ao salvar');
        }
      })
    } else {
      alert('Preencher o nome da sala!');
    }
  })
</script>
