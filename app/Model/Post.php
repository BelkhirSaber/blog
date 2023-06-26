<?php 

namespace App\Model;

use Carbon\Carbon;
use App\Model\Model;

class Post extends Model{
  
  protected $table = 'posts';

  protected $fillable = [
    'page_slug',
    'title',
    'content',
    'image',
    'draft_publish',
  ];

  // Format date
  public function format($date, $format){
    return date_format(date_create($date), $format);
  }

  // Add tag to post
  public function addTag(int $postID, int $tagID)
  {
    $this->query(
      'INSERT INTO post_tag(post_id, tag_id)VALUES(:post_id, :tag_id)',
    ['post_id' => $postID, 'tag_id' => $tagID]);
  }

  public function tags()
  {
    return $this->query("
      SELECT t.* FROM tags t
      INNER JOIN post_tag pt ON pt.tag_id = t.id
      INNER JOIN posts p ON pt.post_id = p.id WHERE p.id = ?", $this->id);
  }

}