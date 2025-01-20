<?php

namespace src\Routes;

use src\Controllers\homeController;

class Routes1
{
  public function getController()
  {

    $routes = [
      "/" => 'home',
      'home' => 'homeController.index',
      "home/edit/param" => 'homeController.edit',
      "base-conhecimento" => "baseConhecimento"
    ];

    return $routes;
  }

  function getCurrentRouter()
  {
    $currentURL = $_REQUEST['url'];
    if (array_key_exists($currentURL, $this->getController())) {
      return $_REQUEST['url'];
    }
    return explode('/', rtrim($_REQUEST['url']), FILTER_SANITIZE_URL);
  }

  function isExistsInArrayRoutes()
  {
    $router = $this->getCurrentRouter();
    if (!$router) {
      return 'home';
    }

    if (!is_array($router)) {

      return $this->getExistController($router);
    } else if (is_array($router)) {
      return $this->getExistController($router[0]);
    }

    return [];
  }

  function getExistController($router)
  {
    if (array_key_exists($router, $this->getController())) {
      return $this->getController()[$router];
    }
  }

  function routerPath()
  {
    $routerPath = $this->isExistsInArrayRoutes();
    if ($routerPath <> []) {
      $splitRouterPath = explode('.', $routerPath);
      $controllerPath = 'src\\controllers\\' . $splitRouterPath[0];
      $controllerMethod = $splitRouterPath[1];
      $instanceController  = new $controllerPath;

      $instanceController->$controllerMethod($this->getParameter());
    }
  }

  function getParameter()
  {
    $splitedURL = explode('/', $this->getCurrentRouter());
    $params  = $splitedURL[count($splitedURL) - 1];

    return $params;
  }
}
