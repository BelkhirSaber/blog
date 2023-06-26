<?php 

namespace App\Controller\Admin\Dashboard;

use App\Model\Post;
use App\Model\Visitor;
use Database\DBconnection;
use App\Enums\CalendarEnum;
use App\Controller\Controller;

class DashboardController extends Controller
{
  public function index()
  {
    $page_title = 'Dashboard';
    $posts = new Post(new DBconnection);
    $visitor = new Visitor(new DBconnection);
    return $this->view('Admin.Dashboard.index', compact('posts', 'visitor', 'page_title'));
  }
}