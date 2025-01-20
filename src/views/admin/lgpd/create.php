<div class='container-fluid'>
    <h4> Cadastro LGPD </h4>
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

    <form method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-10">
                <label for="titutlo">Titulo </label>
                <input type="text" id="titulo" name="titulo" class="form-control" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="inputCity">Data Criação</label>
                <input type="date" name="data_criacao" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-5">
                <label for="versao">Versão </label>
                <input type="text" id="versao" name="versao" class="form-control" />
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-10">
                <label for="inputZip">Aprovadores</label>
                <input type="text" name="aprovadores" class="form-control" id="inputZip">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <div class="custom-file mb-3">
                    <label for="pt_pdf"> Versão PT</label>
                    <input type="file" id="pt_pdf" name="pt_pdf">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <div class="custom-file mb-3">
                    <label for="en_pdf"> Versão EN</label>
                    <input type="file" id="en_pdf" name="en_pdf">
                </div>
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