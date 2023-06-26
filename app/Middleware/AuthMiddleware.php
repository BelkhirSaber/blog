<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{

  public function __construct()
  {
    $this->process();
  }

  protected function process()
  {
    if (key_exists('auth', $_SESSION)) {
      header('Location: /blog/admin/dashboard');
      exit;
    }
  }
}
