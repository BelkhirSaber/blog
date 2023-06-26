<?php

namespace App\Middleware;

use RandomLib\Factory;
use SecurityLib\Strength;


class CsrfMiddleware extends Middleware
{

  public function __construct()
  {
    $this->process();
  }

  protected function process()
  {
    if(!isset($_SESSION['csrf'])) {
      $factory = new Factory;
      $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));
      $_SESSION['csrf'] = ['key' => 'csrf_token', 'value' => hash('sha512', $generator->generateString(256))];
    }

    if (in_array($_SERVER['REQUEST_METHOD'], ['POST', 'PUT', 'DELETE'])) {
      $csrf_token = $_POST[$_SESSION['csrf']['key']];

      if (!hash_equals($_SESSION['csrf']['value'], $csrf_token)) {
        $_SESSION['flash'] = ['errors' => [
          'csrf' => 'csrf token error'
        ]];
        header('Location: /blog/admin', true, 302);
        exit;
      }
    }
  }
}
