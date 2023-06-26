<?php 

namespace App\Model;

use App\Model\Model;


class VisitedPage extends Model
{
  
  protected $table = 'visited_page';

  protected $fillable = [
    'page_url',
    'referer_url',
    'visitor_id'
  ];

}
