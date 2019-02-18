<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

  /**
   * @var array
   */
  protected $dates = ['logged_at'];

  /**
   * @var array
   */
  protected $fillable = [
    'reference_number',
    'email_address',
    'first_name',
    'middle_initial',
    'last_name',
    'strand',
    'parents_contact_number',
    'preferred_school',
    'preferred_program'
  ];

  /**
   * @return mixed
   */
  public function getNameAttribute() {
    return $this->first_name . ' ' . $this->middle_initial . ' ' . $this->last_name;
  }

  /**
   * @param $query
   * @return mixed
   */
  public function scopeLogged($query) {
    return $query->whereNotNull('logged_at');
  }
}
