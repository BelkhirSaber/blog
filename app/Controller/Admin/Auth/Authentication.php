<?php 

namespace App\Controller\Admin\Auth;
use App\Model\User;
use Database\DBconnection;

class Authentication
{
  public function __construct(){}

  public function login(string $username, string $password): bool
  {
    $user = new User(new DBconnection);
    $user =$user->where('username', $username, true);
    if (password_verify($password, $user->password)) {
      session_regenerate_id();
      $_SESSION['auth'] = $user->id;
      return true;
    }

    return false;
  }
}
