<div class="container-baseconhecimento">
  <h4> Videos </h4>
  <hr />
  <a class="btn btn-success" href="<?= BASE_URL ?>admin/videos/create"> Adicionar </a>
  <div class="container-table">
    <table id="dataTable" class="table table-striped table-bordered" style="width: 100%;">
      <thead>
        <tr>
          <th> Id </th>
          <th> Titulo </th>
          <th> Descricao </th>
          <th> URL </th>
          <th> Cód Usuário </th>
          <th> Categoria </th>
          <th> Sub Catégoria </th>
          <th> Ações </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($videos as $video) : ?>
          <tr>
            <td><?= $video['id']; ?></td>
            <td><?= $video['nome_video']; ?></td>
            <td><?= utf8_encode($video['descricao']); ?></td>
            <td><?= $video['url']; ?> </td>
            <td><?= $video['id_usuario']; ?></td>
            <td><?= $video['nome']  ?></td>
            <td><?= $video['sub_cat']; ?></td>
            <td>
              <a class="btn btn-warning" style="color:white;" href="<?= BASE_URL ?>admin/videos/<?= $video['id'] ?>/edit"> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
              <a data-toggle="modal" data-target="#exampleModal" data-id="<?= $video['id']; ?>" class="btn btn-danger" href="<?= BASE_URL ?>admin/videos/<?= $video['id'] ?>/delete"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
            </td>
          </tr>
        <?php endforeach; ?>
    </table>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Base Conhecimento - Excluir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?= BASE_URL; ?>admin/videos">
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
