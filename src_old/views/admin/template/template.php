<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/admin/main.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/header.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/admin/admin-nav.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/admin/global.css" />

  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


  <title>Hello, world!</title>
</head>

<body>
  <?php if ($templateValue) : ?>
    <?php include 'header.php'; ?>
    <div id="container-template">
      <?php
      include 'nav.php';
      ?>

      <div class="column-right">
        <?php
        $this->loadViewInTemplate($view, $data);
        ?>

      </div>
    </div>
  <?php else : ?>
    <?php include __DIR__ . "/../../${view}.php"; ?>
  <?php endif; ?>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#dataTable").DataTable();
    });
    <?php
    $isExistValorBaseConhecimento = (isset($base['descricao']) ? $base['descricao'] : '');
    ?>
    $(document).ready(function() {
      $('#summernote').summernote();
      $('#summernote').summernote('code', `<?= $isExistValorBaseConhecimento ?>` || '');
    });
  </script>

  <script>
    $('#exampleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var recipient = button.data('id')
      var modal = $(this)

      modal.find('.modal-body input').val(recipient)
    })
  </script>
</body>

</html>
