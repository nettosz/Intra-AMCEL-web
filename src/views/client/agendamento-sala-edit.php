<div class='container-fluid'>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background: #fff; padding: .75rem 0px; margin-bottom: 0px">
      <li class="breadcrumb-item"><a class="title-container" href="<?= BASE_URL ?>">Home</a></li>
      <li class="breadcrumb-item"><a class="title-container" href="<?= BASE_URL ?>agendamento-salas">Agendamentos de sala</a></li>
      <li class="breadcrumb-item active" aria-current="page"> Editar </li>
    </ol>
  </nav>
  <h4> Editar agendamento de sala</h4>
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
        <input type="date" value="<?= date('Y-m-d', strtotime($agendamento['dt_inicio'])); ?>" name="data_inicio" class="form-control" id="inputCity">
      </div>
      <div class="form-group col-md-5">
        <label for="inputCity">Data Fim</label>
        <input type="date" value="<?= date('Y-m-d', strtotime($agendamento['dt_fim'])); ?>" name="data_fim" class="form-control" id="inputCity">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="inputZip">Hora Inicio</label>
        <input type="time" value="<?= date('H:i', strtotime($agendamento['dt_inicio'])); ?>" name="hora_inicio" class="form-control" id="inputZip">
      </div>
      <div class="form-group col-md-5">
        <label for="inputZip">Hora Fim</label>
        <input type="time" value="<?= date('H:i', strtotime($agendamento['dt_fim'])); ?>" name="hora_fim" class="form-control" id="inputZip">
      </div>
    </div>

    <a class="btn btn-danger" href="<?= BASE_URL . 'agendamento-salas' ?>">Cancelar</a>
    <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
</div>

</div>
<script src="<?= BASE_URL ?>assets/js/plugins/axios/axios.js"></script>

<script>
  window.addEventListener('load', async () => {

    const response = await axios.get('<?= BASE_URL ?>salas-reuniao')
    const salas = document.querySelector('#sala')
    salas.innerHTML += response.data;

    var option = document.querySelector('option[value="<?= $agendamento['cod_sala_reuniao'] ?>"]')
    option.selected = true

  })
</script>