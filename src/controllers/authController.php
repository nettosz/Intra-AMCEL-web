<?php

namespace src\Controllers;

use src\Controllers\Controller;
use src\Models\usuarioModel;

use League\OAuth2\Client\Provider\Google;

class authController extends Controller
{
  function index()
  {
    $usuario  = new usuarioModel();

    $googleConfig = [
      'clientId'     => $_ENV['GOOGLE_CLIENT_ID'],
      'clientSecret' => $_ENV['GOOGLE_CLIENT_SECRET'],
      'redirectUri'  => $_ENV['GOOGLE_REDIRECT_URI']
    ];

    $google  = new Google($googleConfig);

    $authUrl = $google->getAuthorizationUrl();
    $error  = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRIPPED);
    $code  = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRIPPED);

    if ($code) {
      $token = $google->getAccessToken('authorization_code', [
        "code" => $code
      ]);

      $user = unserialize(serialize($google->getResourceOwner($token)));

      $userEmail  = $user->getEmail();
      if (strpos($userEmail, '@gmail.com') || strpos($userEmail, '@amcel.com.br') ) {

        $isExistEmail = $usuario->isExistUserEmail($userEmail);

        if ($isExistEmail) {
          $isCadComplete = $usuario->isCadComplete($userEmail);
          $_SESSION['user'] = serialize($google->getResourceOwner($token));

          if ($isCadComplete === true) {
            header('Location:' . BASE_URL);
          } else {
            header('Location:' . BASE_URL . 'usuario-completa-cadastro');
          }
        } else {
          $dados = array();
          $user = unserialize(serialize($google->getResourceOwner($token)));

          $dados['nome'] = $user->getName();
          $dados['email'] = $user->getEmail();

          $this->renderClient(false, 'client\email-sem-perfil', $dados);
        }
      } else {

        $dados['user_email'] = $userEmail;

        $this->renderClient(false, 'client\email-nao-permitido', $dados);
      }
    } else {
      header('Location:' . $authUrl);
    }
  }

  function destroy()
  {
    if (!empty($_SESSION['user'])) {
      unset($_SESSION['user']);
    }

    header('Location:' . BASE_URL);
  }
}
