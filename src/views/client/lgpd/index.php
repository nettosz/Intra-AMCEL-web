<div class="container-master">
    <div class="agendamento-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: #fff; padding: .75rem 0px; margin-bottom: 0px">
                <li class="breadcrumb-item"><a class="title-container" href="<?= BASE_URL ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">LGPD</li>
            </ol>
        </nav>
        <hr />
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

        <?php if (in_array(
            [
                'cod_perfil' => '50',
                'cod_modulo' => '9',
                'cod_modulo_opcao' => '3',
                'tp_perfil' => 'V'
            ],
            $permissao
        ) || in_array(
            [
                'cod_modulo' => '9',
                'cod_modulo_opcao' => '3',
                'tp_perfil' => 'F'
            ],
            $permissao
        )) :
        ?>
            <!-- <div class="agendamento-body">
                <div class="agendamento-criar" style="display: flex; flex-direction: row; justify-content: flex-start; align-items:center;">
                    Adicionar nova LGPD
                    <a href="<?= BASE_URL . 'lgpd/criar' ?>" style="display: flex;
                     align-items:center; 
                     margin-left: 10px;
                     justify-content: center; border-radius: 50%; width:40px; height: 40px;" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <hr> -->
        <?php endif; ?>
        <div class="container-table">
            <div class="cards-procedimentos">
                <?php foreach ($lgpds as $l) : ?>
                    <section class="card-procedimento">
                        <h5> <?= $l['titulo'] ?> </h5>
                        <div class="procedimento-footer">
                            <div class="procedimento-footer-left">
                                <div class="footer-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#00A859" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <label> <strong> Aprovadores : </strong> <?= $l['aprovadores'] ?> </label>
                                </div>
                                <div class="footer-item">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.75 14.875C13.9236 14.875 14.875 13.9236 14.875 12.75C14.875 11.5764 13.9236 10.625 12.75 10.625C11.5764 10.625 10.625 11.5764 10.625 12.75C10.625 13.9236 11.5764 14.875 12.75 14.875Z" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M4.25 6.375C5.4236 6.375 6.375 5.4236 6.375 4.25C6.375 3.07639 5.4236 2.125 4.25 2.125C3.07639 2.125 2.125 3.07639 2.125 4.25C2.125 5.4236 3.07639 6.375 4.25 6.375Z" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M4.25 14.875V6.375C4.25 8.06576 4.92165 9.68726 6.11719 10.8828C7.31274 12.0784 8.93424 12.75 10.625 12.75" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <label> <strong>Versão:</strong> <?= $l['versao'] ?> </label>
                                </div>
                                <div class="footer-item">
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.2917 2.16667H2.70833C2.11002 2.16667 1.625 2.6517 1.625 3.25001V10.8333C1.625 11.4316 2.11002 11.9167 2.70833 11.9167H10.2917C10.89 11.9167 11.375 11.4316 11.375 10.8333V3.25001C11.375 2.6517 10.89 2.16667 10.2917 2.16667Z" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.66663 1.08334V3.25001" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M4.33337 1.08334V3.25001" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1.625 5.41666H11.375" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <label> <strong>Data Criação:</strong> <?= date('d/m/Y', strtotime($l['data_criacao']))  ?> </label>
                                </div>
                            </div>
                            <div class="procedimento-footer-right">
                                <a class="footer-item" href="<?= BASE_URL ?>assets/pdf/lgpd/<?= $l['pdf'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#bc3232" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    <label> PDF(PT) </label>
                                </a>

                                <?php if (!empty($l['pdf_en'])) : ?>
                                    <a class="footer-item" href="<?= BASE_URL ?>assets/pdf/lgpd/<?= $l['pdf_en'] ?>">
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

                                <?php if (in_array(
                                    [
                                        'cod_perfil' => '50',
                                        'cod_modulo' => '9',
                                        'cod_modulo_opcao' => '3',
                                        'tp_perfil' => 'V'
                                    ],
                                    $permissao
                                ) || in_array(
                                    [
                                        'cod_modulo' => '9',
                                        'cod_modulo_opcao' => '1',
                                        'tp_perfil' => 'F'
                                    ],
                                    $permissao
                                )) :
                                ?>
                                    <!-- <a class="footer-item yellow" href="<?= BASE_URL ?>lgpd/<?= $l['id'] ?>/editar">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffc107" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        <label> Editar </label>
                                    </a> -->
                                <?php endif; ?>

                                <?php if (in_array(
                                    [
                                        'cod_perfil' => '50',
                                        'cod_modulo' => '9',
                                        'cod_modulo_opcao' => '3',
                                        'tp_perfil' => 'V'
                                    ],
                                    $permissao
                                ) || in_array(
                                    [
                                        'cod_modulo' => '9',
                                        'cod_modulo_opcao' => '2',
                                        'tp_perfil' => 'F'
                                    ],
                                    $permissao
                                )) :
                                ?>

                                    <!-- <a class="footer-item orange" data-id="<?= $l['id']; ?>" data-toggle="modal" data-target="#exampleModal" href="<?= BASE_URL ?>lgpd/<?= $l['id'] ?>/editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ff9846" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        <label> Deletar </label>
                                    </a> -->

                                <?php endif; ?>


                            </div>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">LGPD - Excluir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= BASE_URL; ?>lgpd">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Deseja Excluir este Registro?</label>
                                <input style="display: none;" type="text" class="form-control" name="id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>