<?php 

namespace Router;

use App\Exceptions\NotFoundException;
use App\Lib\Visitor\VisitorLog;
use App\Middleware\Middleware;

class Router{

  private $url;
  private $routes;

  public function __construct($url){
    $this->url = trim($url, '/');
  }

  public function get(string $path, string $action, string|array $middleware = null)
  {
    $this->routes['GET'][] = new Route($path, $action, $middleware);
  }

  public function post(string $path, string $action, string|array $middleware = null)
  {
    $this->routes['POST'][] = new Route($path, $action, $middleware);
  }

  public function run(){
    foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
      if($route->matches($this->url)){
        if (!str_contains($_SERVER['REQUEST_URI'], 'admin')) {
          $visitorLog = new VisitorLog();
          $visitorLog->setLog();
        }
        return $route->execute();
      }
    }
    throw new NotFoundException('Page not found', 404);
    // return header('HTTP/1.1 404 NOT FOUND');
  }
}