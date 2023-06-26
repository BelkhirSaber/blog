<?php 
namespace App\Lib\Visitor;

use Faker\Factory;
use Carbon\Carbon;
use App\Model\Visitor;
use Database\DBconnection;
use App\Model\VisitedPage;

class VisitorLog
{
  // private $db;
  private $user_ip_address;
  private $user_agent;
  private $referer_url;
  private $page_url;


  public function __construct()
  {
    $faker = Factory::create();
    $this->user_ip_address = $_SERVER['REMOTE_ADDR'];
    $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
    $this->referer_url = $_SERVER['HTTP_REFERER'] ?? NULL;
    $this->page_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ;
  
  }

  public function setLog()
  {
    $visitorModel = new Visitor(new DBconnection);

    // create fake visitor data
    // for ($i = 0; $i < 1000; $i++) {
    //   $visitorModel->create([
    //     'user_ip_address' => $this->user_ip_address,
    //     'user_agent' => $this->user_agent,
    //     'created_at' => Carbon::now()->subDays(rand(1, 28))
    //   ]);
    // }

    $visitor = $visitorModel->query(
      "SELECT * FROM {$visitorModel->__get('table')}
      WHERE user_ip_address = :ip
      AND created_at = :created_at",
      ['ip' => $this->user_ip_address,
      'created_at' => date_format(Carbon::now(), 'Y-m-d'),],
      true);
    $visitedPage = new VisitedPage(new DBconnection);
    // check if visitor is exists
    if (empty($visitor)) {
      $visitorModel->create([
        'user_ip_address' => $this->user_ip_address,
        'user_agent' => $this->user_agent,
      ]);
      $visitor = $visitorModel->where('user_ip_address', $this->user_ip_address, true);
    } 
    // Add visited page
    $visitedPage->create([
      'page_url' => $this->page_url,
      'referer_url' => $this->referer_url,
      'visitor_id' => $visitor->id,
    ]);
    
  }


  public function getVisitor()
  {
    
  }

  public function getVisitorLogs()
  {
    
  }
}