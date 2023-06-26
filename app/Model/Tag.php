<?php 


namespace App\Model;

class Tag extends Model
{
  protected $table = 'tags';

  protected $fillable = [
    'name',
  ];

  // Check if any tag name exist
  public function tagExist(string $name):bool
  {
    return !empty(($this->where('name', $name, true))->name) ? true : false;
  }


  // Get all post related to specific tag
  public function posts()
  {
    return $this->query("
    SELECT p.* FROM posts p
    INNER JOIN post_tag pt On pt.post_id = p.id 
    WHERE pt.tag_id = ?", $this->id);
  }

}