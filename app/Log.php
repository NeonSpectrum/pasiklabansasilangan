<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Log extends Model {
  /**
   * @var array
   */
  protected $fillable = [
    'username', 'action'
  ];
}
