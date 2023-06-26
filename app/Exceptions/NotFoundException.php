<?php 

namespace App\Exceptions;

class NotFoundException extends \Exception
{

  public function handleError()
  {
    if ($this->getCode() == 404) {
      http_response_code(404);
      $config = $GLOBALS['config'];
      $content = "Error 404: " . $this->getMessage();
      require VIEWS . 'errors/404.php';
    }
  }

}