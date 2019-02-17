<?php

namespace App\Http\Controllers;

use App\Common;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RegisterController extends Controller {

  /**
   * @param array $data
   */
  protected function create() {
    return view('register');
  }

  /**
   * @param array $data
   */
  protected function store(Request $request) {
    // try {
    $reference_number = Common::generateReferenceNumber();

    $user = new User;

    $user->reference_number = $reference_number;
    $user->fill($request->only([
      'email_address',
      'first_name',
      'middle_initial',
      'last_name',
      'strand',
      'parents_contact_number',
      'preferred_school',
      'preferred_program',
      'email_address'
    ]));

    $user->save();

    Common::sendSteps($reference_number);
    Common::createLog("Registered user with ID: {$user->id} (" . Common::getRealIpAddr() . ')', $user->email_address);
    // } catch (QueryException $e) {
    // return json_encode(['success' => false, 'error' => $e]);
    // }

    return json_encode(['success' => true]);
  }
}
