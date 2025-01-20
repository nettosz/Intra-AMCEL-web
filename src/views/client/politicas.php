<div class="container-master">
    <div class="agendamento-container">
        <h1 class="title-container">Politicas</h1>
        <hr />
        <div class="row" style="padding: 20px;">
            <?php foreach ($politicas as $p) : ?>
                <div class="card-politicas" style="display: flex; flex-direction: column; align-items:flex-start; justify-content:start; margin-top: 15px;" href="<?= BASE_URL ?>assets/pdf/politicas/<?= $p['nome_arquivo'] ?>">
                    <h5> <?= $p['titulo']; ?> </h5>
                    <div>
                        <a class="footer-item" target="_blank" href="<?= BASE_URL ?>assets/pdf/politicas/<?= $p['nome_arquivo'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#bc3232" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <label> PDF(PT) </label>
                        </a>

                        <?php if (!empty($p['nome_arquivo_en'])) : ?>
                            <a class="footer-item" target="_blank" href="<?= BASE_URL ?>assets/pdf/politicas/<?= $p['nome_arquivo_en'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#bc3232" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <label> PDF(EN) </label>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>