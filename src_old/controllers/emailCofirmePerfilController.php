<?php

namespace src\Controllers;

use src\Controllers\Controller;

class emailCofirmePerfilController extends Controller
{
  public function store()
  {
    $loader = new \Twig\Loader\FilesystemLoader(TEMPLATES_PATH);
    $twig = new \Twig\Environment($loader);

    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRIPPED);
    $nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_STRIPPED);

    $transport = (new \Swift_SmtpTransport($_ENV['EMAIL_SMTP'], 465, 'ssl'))
      ->setUsername($_ENV['EMAIL_USERNAME'])
      ->setPassword($_ENV['EMAIL_PASSWORD']);

    $mailer = new \Swift_Mailer($transport);

    $message = (new \Swift_Message('Solicitação de Perfil'))
      ->setFrom([$_ENV['EMAIL_USERNAME']])
      ->setTo([$_ENV['EMAIL_USERNAME']])
      ->setBody('Solicitação de criação de perfil')
      ->addPart($twig->render('emails\confirme.html', ['name' => $nome, 'email' => $email]), 'text/html');

    $result = $mailer->send($message);

    echo "<script> alert('Solicitção enviada com sucesso. Aguarde um retorno do departamento de TI. \n') </script>";
    echo '<script> window.location.href="http://localhost/intra-amcel-web" </script>';
  }
}
