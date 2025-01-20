<div class="login-container">
  <?php if (!empty($aviso) && isset($aviso)) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong> ATENÇÃO! </strong> <?php echo $aviso; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <form method="POST" action="login">
    <div class="form-group">
      <label for="email-field"> Login </label>
      <input class="form-control" id="email-field" name="login" placeholder="Seu usuário">
    </div>
    <div class="form-group">
      <label for="pass-field"> Senha </label>
      <input type="password" class="form-control" name="senha" id="pass-field" placeholder="Senha">
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
  </form>

</div>
