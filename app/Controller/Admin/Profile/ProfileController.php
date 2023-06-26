<?php


namespace App\Controller\Admin\Profile;

use App\Model\User;
use Database\DBconnection;
use App\Controller\Controller;
use App\Traits\UploadedFileTrait;
use App\Exceptions\NotFoundException;

class ProfileController extends Controller
{

  use UploadedFileTrait;

  public function index()
  {
    $page_title = 'Profile';
    $user =  new User(new DBconnection);
    $user = $user->where('id', $_SESSION['auth'], true);
    return $this->view('Admin.Profile.index', compact('user', 'page_title'));
  }

  public function save()
  {

    if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
      
      $first_name = htmlspecialchars(trim($_POST['first_name']));
      $last_name = htmlspecialchars(trim($_POST['last_name']));
      $phone = htmlspecialchars(trim($_POST['phone']));;
      $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
      $username = htmlspecialchars(trim($_POST['username']));

      $user = new User(new DBconnection);
      $return = $user->update([
        'id' => $_POST['id'],
        'first_name' => $first_name,
        'last_name' => $last_name,
        'phone' => $phone,
        'email' => $email,
        'username' => $username,
      ]);

      if ($return) {

        $_SESSION['flash'] = ['toast' => [
          'type' => 'success',
          'msg' => 'User information update successfully',
        ]];

      } else {

        $_SESSION['flash'] = ['toast' => [
            'type' => 'error',
            'msg' => 'Error user not update',
          ],
          'request' => $_POST
        ];
        
      }

      header('Location: /blog/admin/profile');
      exit;

    } else {

      throw new NotFoundException('Page Not Found', 404);
    }
  }


  public function saveProfileImage()
  {
    if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {

      $user = new User(new DBconnection);

      if (!empty($user->where('id', $_POST['id']))) {

        $uploaded = $this->uploaded_file($_FILES['image'], 'avatars');

        if (is_string($uploaded)) {

          $user->update([
            'id' => $_POST['id'],
            'profile_image' => $uploaded
          ]);

          $_SESSION['flash'] = ['toast' => [
            'type' => 'success',
            'msg' => 'Image changed successfully'
          ]];
          
        } else if ($uploaded === false) {

          $_SESSION['flash'] = ['toast' => [
            'type' => 'error',
            'msg' => 'Error image not saved'
          ]];
        }
      }
    }

    header('Location: /blog/admin/profile');
    exit;
  }


}