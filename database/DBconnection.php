<?php 

namespace Database;
use PDO;

class DBconnection{

  private $pdo;
  private $config;

  public function __construct(){
    $this->config = $GLOBALS['config'];
  }
  
  public function getPDO(): PDO{

    $dns = "mysql:host={$this->config->get('db.host')};dbname={$this->config->get('db.name')}";
    $username = $this->config->get('db.username');
    $password = $this->config->get('db.password');
    $options = $this->config->get('db.pdo.options');

    return $this->pdo ?? new PDO($dns, $username, $password, $options);
  }
}