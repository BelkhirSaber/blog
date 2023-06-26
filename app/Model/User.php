<?php 

namespace App\Model;

use App\Model\Model;


class User extends Model{
  
  protected $table = 'users';

  protected $fillable = [
    'username',
    'email',
    'password',
    'first_name',
    'last_name',
    'phone'
  ];

  public function fullName(): string
  {
    return ucfirst($this->first_name . ' ' . $this->last_name);
  }

}
