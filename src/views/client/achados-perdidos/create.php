<div class='container-fluid'>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: #fff; padding: .75rem 0px; margin-bottom: 0px">
            <li class="breadcrumb-item"><a class="title-container" href="<?= BASE_URL ?>">Home</a></li>
            <li class="breadcrumb-item"><a class="title-container" href="<?= BASE_URL ?>achados-perdidos">Achados e Perdidos</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Criar </li>
        </ol>
    </nav>
    <h4> Cadastro de achados e perdidos </h4>
    <hr>
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Atenção!</strong> <?= $error; ?>
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
    <form method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="nome">Nome Funcionario</label>
                <input type="text" name="nome" class="form-control" id="nome" required>
            </div>
            <div class="form-group col-md-2">
                <label for=""> Status </label>
                <select id="status" name="status" class="form-control">
                    <option value="P"> Pendente </option>
                    <option value="C"> Concluido </option>
                </select>
            </div>
        </div>

        <div class="form-row" id="recebido_info" style="display: none;">
            <div class="form-group col-md-8">
                <label for="nome_recebido">Nome recebido</label>
                <input type="text" name="nome_recebido" class="form-control" id="nome_recebido">
            </div>
            <div class="form-group col-md-2">
                <label for="data_recebido">Data recebido </label>
                <input type="date" name="data_recebido" class="form-control" id="data_recebido" value="<?= date('Y-m-d') ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="date">Data que o objeto foi encontrado</label>
                <input type="date" name="data" class="form-control" id="date" required="Preencha de data">
            </div>
            <div class="form-group col-md-5">
                <label for="local">Local que o objeto foi encontrado </label>
                <input type="text" name="local" class="form-control" id="local" required="Preencha o campo de local">
            </div>
        </div>

        <div class="form-row">
            <img class="img-fundo" src="<?= BASE_URL ?>assets/imgs/image.png" width="400" height="300" class="img-thumbnail" alt="objeto">

        </div>

        <div class="form-row">
            <div class="form-group cold-md-5">
                <input id="imagem" type="file" style="display: none" name="foto" oninvalid="imageError()" required />
                <label for="imagem" class="btn btn-primary mt-4"> <i class="fa fa-picture-o" aria-hidden="true"></i> Selecionar imagem </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

</div>


<script src="<?= BASE_URL ?>assets/js/plugins/axios/axios.js"></script>

<script>
    document.getElementById('status').addEventListener('change', (e) => {
        const status = e.target.options[e.target.selectedIndex].value;

        const recebido_info = document.getElementById('recebido_info')
        const nome = recebido_info.querySelector('#nome_recebido')
        const data = recebido_info.querySelector('#data_recebido')

        if (status === 'C') {
            recebido_info.style.display = 'flex'
            nome.setAttribute('required', true)
            data.setAttribute('required', true)
        } else {
            recebido_info.style.display = 'none'
            nome.removeAttribute('required')
            data.removeAttribute('required')
        }
    })

    const inputImage = document.querySelector('#imagem')

    inputImage.addEventListener('change', (e) => {
        const [file] = e.target.files;
        const image = document.querySelector('.img-fundo')
        image.src = URL.createObjectURL(file)
    })

    function imageError() {
        alert('preencha uma imagem');
    }
</script>