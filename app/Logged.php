<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logged extends Model {
  /**
   * @var string
   */
  protected $table = 'logged';

  /**
   * @var array
   */
  protected $fillable = [
    'reference_number'
  ];
}
