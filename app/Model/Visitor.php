<?php 

namespace App\Model;

use App\Model\Model;
use Carbon\Carbon;

class Visitor extends Model
{
  
  protected $table = 'visitor_log';

  protected $fillable = [
    'user_ip_address',
    'user_agent'
  ];

  public function visitorLast28Day()
  {
    $i = 0; $data = [];
    $visitorLast28Day = $this->query(
    "SELECT created_at, COUNT(id) As DailyVisitor
    FROM {$this->table}
    WHERE created_at >= ? GROUP BY created_at", Carbon::now()->subDays(28));

    foreach ($visitorLast28Day as $visitor)
    {
      $data[$i++] = $visitor->DailyVisitor;
    }

    return json_encode($data);
  }
}
