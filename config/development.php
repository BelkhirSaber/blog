<?php
return [
  'app' => [
    'url' => 'http://localhost/',
    'hash' => [
      'algo' => PASSWORD_BCRYPT,
      'cost' => 10,
    ],
  ],

  'db' => [
    'driver' => 'mysql',
    'host' => 'localhost',
    'name' => 'blog',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_general_ci',
    'prefix' => '',
    'pdo' => [
      'options' => [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
      ]
    ]
  ],

  'auth' => [
    'session' => 'user_id',
    'remember' => 'user_r'
  ],

  'mail' => [

  ],
  
  'file' => [
    'image' => [
      'extension' => ['jpg', 'jpeg', 'png'],
    ]
  ]





];
