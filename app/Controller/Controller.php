<?php 


namespace App\Controller;

class Controller{

  public function view(string $path, array $params = null)
  {
    ob_start();
    $config = $GLOBALS['config'];
    $csrf = $_SESSION['csrf'];
    $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : '';
    $request = isset($_SESSION['request']) ? $_SESSION['request'] : '';
    !is_null($params) ? extract($params) : '';
    $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
    require VIEWS . $path . '.php';
    $content = ob_get_clean();
    require VIEWS . (str_contains($_SERVER['REQUEST_URI'], 'admin') ? 'Admin/layout.php' : 'layout.php');
  }
}