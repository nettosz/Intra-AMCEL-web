<?php

namespace src\Controllers;

use src\models\ramalModel;
use src\Controllers\Controller;
use Dompdf\Dompdf;

class ramalPDFController extends Controller
{
  public function index()
  {
    $loader = new \Twig\Loader\FilesystemLoader(TEMPLATES_VIEWS);
    $twig = new \Twig\Environment($loader);
    $dompdf = new Dompdf();

    $ramal = new ramalModel();
    $ramais = $ramal->getRamaisNumeros();

    $dompdf->loadHtml($twig->render(
      'client\pdf\ramal.html',
      ['ramais' => $ramais]
    ));

    $dompdf->setPaper('A4');

    $dompdf->render();

    $dompdf->stream('ramais.pdf', ['Attachment' => false]);
  }
}
