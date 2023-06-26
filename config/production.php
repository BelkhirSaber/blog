<?php
return [
  'app' => [
    'url' => 'set your domaine name',
    'hash' => [
      'algo' => PASSWORD_BCRYPT,
      'cost' => 10,
    ],
  ],

  'db' => [
    'driver' => 'mysql',
    'host' => 'localhost',
    'name' => '',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_general_ci',
    'prefix' => '',
    'pdo' => [
      'options' => []
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
