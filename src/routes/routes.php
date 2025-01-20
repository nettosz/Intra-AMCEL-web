<?php

namespace src\Routes;

class Routes
{
  private $controllerPath;
  public $IsRouteExist = false;
  public $routes = [];
  private $currentRouter = '/';
  private $routeGenerateToCompare = [];
  public $routeNotFound  = '';
  private $routeToCompare;

  function __construct()
  {
    $this->currentRouter .= $_REQUEST['url'];
  }

  public function setControllerPath($path)
  {
    $this->controllerPath = $path;
  }

  public function add($endpoint, $controllerMethod)
  {
    $splitControllerMethod = explode('.', $controllerMethod);
    $controller = $splitControllerMethod[0];
    $controllerMethod = $splitControllerMethod[1];
    array_push(
      $this->routes,
      [
        "route" => $endpoint,
        "controller" => $controller,
        "method" => $controllerMethod
      ]
    );
  }

  function getArrayRoute($route)
  {
    return explode('/', $route);
  }

  function getArrayRouteCurrent()
  {
    return explode('/', $this->currentRouter);
  }

  function getRouteParams($endpoint)
  {
    preg_match_all("#\{[\w\s']+\}#i", $endpoint, $params);
    return $params;
  }

  function getRouteCurrentParams($route)
  {

    $arrRoute = $this->getArrayRoute($route);
    $arrRouteCurrent = $this->getArrayRouteCurrent();
    $params  = $this->getRouteParams($route);
    $paramsArray = [];
    $keys = $this->getKeyArrRoute($route);

    $routeParams = '';
    $routeFinal = [];

    if (!empty($keys) && $keys <> []) {
      $routeParams = array_map(function ($key) use (&$routeFinal, $arrRoute, $arrRouteCurrent) {
        if (!empty($arrRouteCurrent[$key])) {
          $routeFinal += [$key => $arrRouteCurrent[$key]];

          $routeRemoveBracket = str_replace('}', '', str_replace('{', '', $arrRoute[$key]));

          return [$routeRemoveBracket => $arrRouteCurrent[$key]];
        }
        return;
      }, $keys);
    }

    $this->routeGenerateToCompare = implode('/', array_replace($arrRoute, $routeFinal));

    return $routeParams;
  }

  function getKeyArrRoute($route)
  {
    $arrRoute = $this->getArrayRoute($route);
    $params  = $this->getRouteParams($route)[0];

    $getkeyArr = function ($param) use ($arrRoute) {
      return array_search($param, $arrRoute);
    };
    $keysArr = array_map($getkeyArr, $params);

    return $keysArr;
  }

  function isExistRoute()
  {
    if ($this->routeGenerateToCompare === $this->currentRouter) return true;
    else return false;
  }

  public function show()
  {
    foreach ($this->routes as $route) {

      $controllerAndMethod = $route['controller'] . '.' . $route['method'];
      $params  = $this->getRouteCurrentParams($route['route']);
      if ($this->isExistRoute()) {

        $isAdmin = (strpos($route['route'], 'admin') == true ? 'admin\\' . $route['controller'] : $route['controller']);
        $controller =  $this->controllerPath . $isAdmin;
        $instanceController  = new $controller;
        $method = $route['method'];
        $instanceController->$method($params);
        $this->IsRouteExist = true;
        break;
      } else {
        $this->IsRouteExist = false;
      }
    }

    if (!$this->IsRouteExist) {
      if (empty($this->routeNotFound)) echo "404";
      else include $this->routeNotFound;
    }
  }
}
