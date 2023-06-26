<?php

use App\Middleware\GuestMiddleware;
use Router\Router;
use App\Middleware\CsrfMiddleware;
use App\Middleware\AuthMiddleware;
use App\Exceptions\NotFoundException;

session_start();

// require autoload
require_once __DIR__ . '/vendor/autoload.php';
// require settings
require_once __DIR__ . '/config/settings.php';

define('VIEWS', __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define('ASSETS', __DIR__  . DIRECTORY_SEPARATOR  . 'assets' . DIRECTORY_SEPARATOR);
define('IMAGES', __DIR__  . DIRECTORY_SEPARATOR  . 'assets/images' . DIRECTORY_SEPARATOR);

// Middleware
new CsrfMiddleware();

// route
$router = new Router($_GET['url']);
$router->get('/', 'App\Controller\BlogController@index');
$router->get('/posts', 'App\Controller\BlogController@all');
$router->get('/posts/:id', 'App\Controller\BlogController@show');
$router->get('/about', 'App\Controller\BlogController@about');
$router->get('/contact', 'App\Controller\BlogController@contact');
$router->get('/tag/:id', 'App\Controller\BlogController@tag');
$router->get('/test', 'App\Controller\BlogController@test');

// Admin
$router->get('/admin', 'App\Controller\Admin\Auth\AuthController@index', AuthMiddleware::class);
$router->post('/admin/login', 'App\Controller\Admin\Auth\AuthController@login');
$router->get('/admin/dashboard', 'App\Controller\Admin\Dashboard\DashboardController@index', GuestMiddleware::class);
// Profile
$router->get('/admin/profile', 'App\Controller\Admin\Profile\ProfileController@index', GuestMiddleware::class);
$router->post('/admin/profile/save', 'App\Controller\Admin\Profile\ProfileController@save', GuestMiddleware::class);
$router->post('/admin/profile/image/save', 'App\Controller\Admin\Profile\ProfileController@saveProfileImage', GuestMiddleware::class);
// Post
$router->get('/admin/posts', 'App\Controller\Admin\Dashboard\PostController@index', GuestMiddleware::class);
$router->get('/admin/posts/:id', 'App\Controller\Admin\Dashboard\PostController@show', GuestMiddleware::class);
$router->get('/admin/post/create', 'App\Controller\Admin\Dashboard\PostController@create', GuestMiddleware::class);
$router->post('/admin/post/save', 'App\Controller\Admin\Dashboard\PostController@save', GuestMiddleware::class);


try {
  $router->run();
} catch(NotFoundException $e) {
  return $e->handleError();
}

unset($_SESSION['flash']);
unset($_SESSION['request']);
