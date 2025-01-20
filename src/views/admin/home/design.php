<div class="container-baseconhecimento">
    <h4> Home Design </h4>
    <hr />

    <?php if (!empty($error)) : ?>
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
    <div Class="image-container" style="padding: 30px;">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="colmd-12">

                    <?php if (!empty($home_design['imagem_fundo'])) : ?>
                        <img class="img-fundo" style="width: 100%; min-width: 100%;" src="<?= BASE_URL ?>assets/imgs/home/<?= $home_design['imagem_fundo'] ?>" alt="">
                    <?php else : ?>
                        <img class="img-fundo" style="width: 100%; min-width: 100%;" src="<?= BASE_URL ?>assets/imgs/sem-imagem.png" alt="">
                    <?php endif; ?>

                    <input id="imagem" type="file" style="display: none" name="fundo" />

                    <label for="imagem" class="btn btn-primary mt-4"> <i class="fa fa-picture-o" aria-hidden="true"></i> Selecionar imagem </label>

                    <?php if (!empty($home_design['imagem_fundo'])) : ?>
                        <button name="delete-image" value="oloco" id="remove-image" type="submit" class="btn btn-danger mt-3"> <i class="fa fa-times" aria-hidden="true"></i> Remover Imagem </label> </button>
                    <?php else : ?>
                        <button style="display: none" name="delete-image" value="oloco" id="remove-image" type="submit" class="btn btn-danger mt-3"> <i class="fa fa-times" aria-hidden="true"></i> Remover Imagem </label> </button>
                    <?php endif; ?>

                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-success"> Salvar </button>
            </div>
        </form>
    </div>
</div>

<script>
    const inputImage = document.querySelector('#imagem')

    inputImage.addEventListener('change', (e) => {
        const [file] = e.target.files;
        const image = document.querySelector('.img-fundo')
        image.src = URL.createObjectURL(file)

        document.querySelector('#remove-image').style.display = 'inline-block'
    })
</script>