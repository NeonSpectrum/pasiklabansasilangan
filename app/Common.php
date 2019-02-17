<?php

namespace App;

use App\Mail\StepMail;
use App\User;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class Common {

  /**
   * @param $email
   */
  public static function sendSteps($reference_number) {
    $user = User::where('reference_number', $reference_number)->first();

    $data = new \stdClass();

    $data->user = $user;
    $data->code = Common::encrypt($user->reference_number);
    $data->date = 'Thursday, December 13, 2018';
    // $data->date       = date('l, F d, Y', strtotime('+1 weekday'));

    \Mail::to($user->email_address)->send(new StepMail($data));
    Common::createLog('Sent Steps to: ' . $user->email_address);
  }

  /**
   * @param $code
   * @return mixed
   */
  public static function decrypt($string) {
    try {
      $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
      return $encrypter->decrypt($string);
    } catch (DecryptException $e) {
      abort(404);
    }
  }
  /**
   * @param $string
   * @return mixed
   */
  public static function encrypt($string) {
    try {
      $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
      return $encrypter->encrypt($string);
    } catch (DecryptException $e) {
      abort(404);
    }
  }

  /**
   * @return mixed
   */
  public static function generateReferenceNumber() {
    do {
      $ref = Common::generateRandomString(10);
    } while (User::where('reference_number', $ref)->get()->isNotEmpty());

    return $ref;
  }

  /**
   * @return mixed
   */
  public static function generateRandomString($length = 32) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string     = '';

    for ($i = 0; $i < $length; $i++) {
      $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
  }

  /**
   * @param $action
   */
  public static function createLog($action) {
    \App\Log::create([
      'username' => Auth::user()->username ?? 'N/A',
      'action'   => $action
    ]);
  }

  /**
   * @return mixed
   */
  public static function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }
}
