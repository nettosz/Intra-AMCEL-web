<?php foreach ($cargos as $cargo) : ?>
  <option value="<?= $cargo['id'] ?>"> <?= $cargo['nome'] ?> </option>
<?php endforeach; ?>