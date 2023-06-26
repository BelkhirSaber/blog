<?php 

namespace App\Controller\Admin\Dashboard;

use App\Model\Tag;
use App\Model\Post;
use RandomLib\Factory;
use SecurityLib\Strength;
use Database\DBconnection;
use App\Controller\Controller;
use App\Exceptions\NotFoundException;

class PostController extends Controller
{
  public function index()
  {
    $page_title = 'Posts';
    $posts = new Post(new DBconnection);
    return $this->view('Admin.Dashboard.posts', compact('posts', 'page_title'));
  }

  public function show(int $id)
  {
    $page_title = 'Post';
    if (!is_numeric($id)) { throw new NotFoundException('Page not found', 404);}
    return $this->view('Admin.Dashboard.post', compact('page_title'));
  }

  public function create()
  {
    $page_title = "New Post";
    $tags = (new Tag(new DBconnection))->all();
    return $this->view('Admin.Dashboard.new_post', compact('tags', 'page_title'));
  }

  public function save()
  {
    if (isset($_POST['publish']) || isset($_POST['draft']))
    {
      // Check if this post is already exist
      $post = new Post(new DBconnection);
      $needlePost = $post->where('page_slug', $_POST['page_slug'], true);

      if ($needlePost) {
        $_SESSION['flash'] = ['errors' => ['page_slug' => 'page slug already exists']];
        $_SESSION['request'] = $_POST;
        header('Location:/blog/admin/post/create', true, 302);
        exit;
      }

      // validation & upload image & create new post
      if (!empty($_FILES['poster']['name'])){  
        // Get File Info
        $posterName = basename($_FILES['poster']['name']);
        $posterType = pathinfo($posterName, PATHINFO_EXTENSION);

        // Allowed image type
        if (in_array($posterType, $GLOBALS['config']->get('file.image.extension')))
        {
          $poster_tmp = $_FILES['poster']['tmp_name'];
          $generator = (new Factory)->getGenerator(new Strength(Strength::MEDIUM));
          $posterName = $generator->generateInt(100, 99999999) . '_photo_' . md5($generator->generateString(5)) . '.' . $posterType;
          
          $uploaded = move_uploaded_file($poster_tmp,  IMAGES . $posterName);

          if ($uploaded) {
            $publish = isset($_POST['publish']) ? 1 : 0;
            
            // Insert new post
            $post->create([
              'page_slug' => $_POST['page_slug'],
              'title' => $_POST['title'],
              'content' => $_POST['content'],
              'image' => $posterName,
              'draft_publish' => $publish,
            ]);

            // Insert new tags & relate tag to post
            if (!empty($_POST['tags']))
            {
              $tag = new Tag(new DBconnection);
              $tags = json_decode($_POST['tags']);
              $needlePost = $post->where('page_slug', $_POST['page_slug'], true);
              $postID = $needlePost ?  $needlePost->id : '';

              foreach ($tags as $t) {
                if(!$tag->tagExist($t->value)) $tag->create(['name' => $t->value]);
  
                $tagID = ($tag->where('name', $t->value, true))->id;
                $post->addTag($postID, $tagID);
              }
  
            }
            
            $_SESSION['flash'] = [
              'toast' => [
                'type' => 'success',
                'msg' => 'Your post has been created successfully'
              ]
            ];
            header('Location: /blog/admin/posts/');
            exit;
          }
        }
      }
    }

    throw new NotFoundException('Page not found', 404);
  }
}