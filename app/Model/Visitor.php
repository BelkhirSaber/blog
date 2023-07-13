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
    $i = 0; $j = 0; $counter = 28; $data = [];
    $visitorLast28Day = $this->query(
    "SELECT created_at, COUNT(id) As DailyVisitor
    FROM {$this->table}
    WHERE created_at >= ? GROUP BY created_at", Carbon::now()->subDays(28));

    while ($counter > 0) {

      if ($visitorLast28Day[$i] -> created_at == Carbon::now()->subDays($counter)->format('Y-m-d')) {
        $data[$j++] = $visitorLast28Day[$i++]->DailyVisitor;
      } else {  
        $data[$j++] = 0;
      }

      $counter--;
    }

    return json_encode($data);
  }
}
