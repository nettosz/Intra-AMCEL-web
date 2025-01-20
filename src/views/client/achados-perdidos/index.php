<div class="container-master">
    <div class="agendamento-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: #fff; padding: .75rem 0px; margin-bottom: 0px">
                <li class="breadcrumb-item"><a class="title-container" href="<?= BASE_URL ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Achados e Perdidos</li>
            </ol>
        </nav>
        <hr />

        <?php if ((!empty($erro)) || (!empty($_GET['error']))) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Atenção!</strong> <?= !empty($erro) ? $erro : 'Usuário não tem permissão pra excluir'; ?>
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
                'cod_modulo' => '11',
                'cod_modulo_opcao' => '3',
                'tp_perfil' => 'V'
            ],
            $permissao
        ) || in_array(
            [
                'cod_modulo' => '11',
                'cod_modulo_opcao' => '3',
                'tp_perfil' => 'F'
            ],
            $permissao
        )) :
        ?>
            <div class="agendamento-body">
                <div class="agendamento-criar">
                    Adicionar
                    <a href="<?= BASE_URL . 'achados-perdidos/criar' ?>" style="border-radius: 50%; width:40px; height: 40px;" class="btn btn-success">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <hr>
        <?php endif; ?>
        <div class="container-table">
            <?php foreach ($achados_perdidos as $ap) : ?>
                <div class="media">
                    <img style="width: 180px; height: 180px;" src="<?= BASE_URL ?>assets/imgs/achados-perdidos/<?= $ap['foto'] ?>" class="align-self-start mr-3" alt="...">
                    <div class="media-body" style="padding: 20px">
                        <h5 class="mt-0"><?= $ap['nome_achado'] ?></h5>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#00A859" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <label> <strong> Nome achado : </strong> <?= $ap['nome_achado'] ?> </label>
                        </div>
                        <div>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.75 14.875C13.9236 14.875 14.875 13.9236 14.875 12.75C14.875 11.5764 13.9236 10.625 12.75 10.625C11.5764 10.625 10.625 11.5764 10.625 12.75C10.625 13.9236 11.5764 14.875 12.75 14.875Z" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4.25 6.375C5.4236 6.375 6.375 5.4236 6.375 4.25C6.375 3.07639 5.4236 2.125 4.25 2.125C3.07639 2.125 2.125 3.07639 2.125 4.25C2.125 5.4236 3.07639 6.375 4.25 6.375Z" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4.25 14.875V6.375C4.25 8.06576 4.92165 9.68726 6.11719 10.8828C7.31274 12.0784 8.93424 12.75 10.625 12.75" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <label> <strong>Local achado:</strong> <?= $ap['local_achado'] ?> </label>
                        </div>
                        <div>
                            <svg width="15" height="15" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.2917 2.16667H2.70833C2.11002 2.16667 1.625 2.6517 1.625 3.25001V10.8333C1.625 11.4316 2.11002 11.9167 2.70833 11.9167H10.2917C10.89 11.9167 11.375 11.4316 11.375 10.8333V3.25001C11.375 2.6517 10.89 2.16667 10.2917 2.16667Z" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.66663 1.08334V3.25001" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4.33337 1.08334V3.25001" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M1.625 5.41666H11.375" stroke="#00A859" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <label> <strong>Data achado:</strong> <?= date('d/m/Y', strtotime($ap['data_achado']))  ?> </label>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#00A859" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            <label>
                                <strong>Status:</strong>
                                <?php if ($ap['status'] === 'P') : ?>
                                    <strong style="color: red;">
                                        Pendente
                                    </strong>
                                <?php else : ?>
                                    <strong style="color: green;">
                                        Concluido
                                    </strong>
                                <?php endif; ?>
                            </label>
                        </div>
                        <div>
                            <?php if (in_array(
                                [
                                    'cod_perfil' => '50',
                                    'cod_modulo' => '11',
                                    'cod_modulo_opcao' => '3',
                                    'tp_perfil' => 'V'
                                ],
                                $permissao
                            ) || in_array(
                                [
                                    'cod_modulo' => '11',
                                    'cod_modulo_opcao' => '1',
                                    'tp_perfil' => 'F'
                                ],
                                $permissao
                            )) :
                            ?>
                                <a href="<?= BASE_URL ?>achados-perdidos/<?= $ap['id'] ?>/editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 3C17.2626 2.73735 17.5744 2.52901 17.9176 2.38687C18.2608 2.24473 18.6286 2.17157 19 2.17157C19.3714 2.17157 19.7392 2.24473 20.0824 2.38687C20.4256 2.52901 20.7374 2.73735 21 3C21.2626 3.26264 21.471 3.57444 21.6131 3.9176C21.7553 4.26077 21.8284 4.62856 21.8284 5C21.8284 5.37143 21.7553 5.73923 21.6131 6.08239C21.471 6.42555 21.2626 6.73735 21 7L7.5 20.5L2 22L3.5 16.5L17 3Z" stroke="#B9B90D" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <label style="color: #B9B90D"> Editar </label>
                                </a>

                            <?php endif; ?>

                            <?php if (in_array(
                                [
                                    'cod_perfil' => '50',
                                    'cod_modulo' => '11',
                                    'cod_modulo_opcao' => '3',
                                    'tp_perfil' => 'V'
                                ],
                                $permissao
                            ) || in_array(
                                [
                                    'cod_modulo' => '11',
                                    'cod_modulo_opcao' => '2',
                                    'tp_perfil' => 'F'
                                ],
                                $permissao
                            )) :
                            ?>

                                <a href="#" data-toggle="modal" data-id="<?= $ap['id']; ?>" data-target="#exampleModal">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 6H5H21" stroke="#8C1414" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z" stroke="#8C1414" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M10 11V17" stroke="#8C1414" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14 11V17" stroke="#8C1414" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <label style="color: #8C1414"> Deletar </label>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class=" modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agendamento Excluir - Excluir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?= BASE_URL; ?>achados-perdidos">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Deseja Excluir este Registro?</label>
                                <input style="display:none;" type="text" class="form-control" name="id">
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