<?php 

namespace App\Controller\Admin\Auth;

use App\Controller\Controller;

class AuthController extends Controller
{

  public function index()
  {
    $page_title = 'Login';
    return $this->view('Admin.Auth.login', compact('page_title'));
  }

  public function login()
  {
    if (isset($_POST['username']) && isset($_POST['password'])) {
      $username = $_POST['username']; $password = $_POST['password']; 
      $auth =  new Authentication();
      if ($auth->login($username, $password)) {
        header('Location:/blog/admin/dashboard');
        return ;
      }
      $_SESSION['flash'] = ['errors' => [
        'authentication' => 'incorrect username or password'
      ]];
      header('Location:/blog/admin', true, 302);
      exit;
    }
    
  }

}