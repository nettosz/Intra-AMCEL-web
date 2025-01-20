<?php

namespace src\Controllers;



class Controller
{
  function renderClient($inTemplate, $view, $data = array())
  {
    $template['templateValue'] = $inTemplate;
    extract($template);
    extract($data);

    include __DIR__ . '/../views/client/template/template.php';
  }

  function renderAdmin($inTemplate, $view, $data = array())
  {
    $template['templateValue'] = $inTemplate;
    extract($template);
    extract($data);
    include __DIR__ . '/../views/admin/template/template.php';
  }

  function renderTwig(string $view,  array $data = array()): void
  {
    $loader = new \Twig\Loader\FilesystemLoader(TEMPLATES_VIEWS);
    $twig = new \Twig\Environment($loader);

    echo $twig->render(
      $view . '.php',
      $data
    );
  }

  function renderAjax($view, $data = array())
  {
    extract($data);
    include __DIR__ . '/../views/ajax/' . $view . '.php';
  }

  function loadViewInTemplate($view, $data = array())
  {
    extract($data);
    include __DIR__ . "/../views/${view}.php";
  }
}
