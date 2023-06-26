<?php 

namespace App\Middleware;

abstract class Middleware
{

  abstract public function __construct();
  
  abstract protected function process();
}