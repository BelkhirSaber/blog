<?php 

namespace Router;

class Route{

  private $path;
  private $action;
  private $matches;
  private $middleware;



  public function __construct($path, $action, $middleware){
    $this->path = trim($path, '/');
    $this->action = $action;
    $this->middleware = $middleware;
  }

  public function matches(string $url){
    $path = preg_replace('#:([\w])+#', '([^/]+)', $this->path);
    $pathToMatch = "#^$path$#";
    if(preg_match($pathToMatch, $url, $matches)){
      $this->matches = $matches;
      return true;
    }else{
      return false;
    }
  }

  public function execute(){
    $params = explode('@', $this->action);
    $controller = new $params[0];
    $method = $params[1];
    if (!empty($this->middleware)) {
      if (is_array($this->middleware)) {
        foreach($this->middleware as $className) new $className;
      } else {
        new $this->middleware;
      }
    }
    return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
  }

}