<?php 

namespace App\Controller;
use App\Exceptions\NotFoundException;
use App\Model\Post;
use App\Model\Tag;
use Database\DBconnection;

class BlogController extends Controller
{
  public function index()
  {
    $page_title = 'Home';
    $post = new Post(new DBconnection);
    $posts = $post->queryBuilder(function() use ($post) {
      return "SELECT * FROM {$post->__get('table')} ORDER BY {$post->__get('created_at')} DESC LIMIT 5";
    });
    $mostViewedPost = $post->queryBuilder(function () use ($post) {
      return "SELECT * FROM {$post->__get('table')} ORDER BY views DESC LIMIT 2";
    });
    $allPost = $post->all();
    return $this->view('blog.index', compact('posts','mostViewedPost', 'allPost', 'page_title'));
  }

  public function all()
  {
    $page_title = 'Articles';
    $post = new Post(new DBconnection);
    $posts = $post->all();
    return $this->view('blog.all', compact('posts', 'page_title'));
  }

  public function show(mixed $id)
  {
    $page_title = 'Article';
    if (!is_numeric($id)) { throw new NotFoundException('Page not found', 404);}
    $post = new Post(new DBconnection);
    $post = $post->where('id', $id, true);
    return $this ->view('blog.show', compact('post', 'page_title'));
  }

  public function about()
  {
    $page_title = 'About';
    return $this->view('blog.about', compact('page_title'));
  }

  public function contact()
  {
    $page_title = 'Contact';
    return $this->view('blog.contact', compact('page_title'));
  }

  public function tag(int $id)
  {
    $page_title = 'Tag';
    $tag = new Tag(new DBconnection);
    $tag = $tag->where('id', $id, true);
    return $this->view('blog.tag', compact('tag', 'page_title'));
  }

  public function test()
  {
    $page_title = 'Test';
    $post = new Post(new DBconnection);
    $post = $post->where('id', 25, true);
    return $this->view('blog.test', compact('post', 'page_title'));
  }

}