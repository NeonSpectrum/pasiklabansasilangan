<?php

namespace App\Http\Controllers;

use App\Common;
use App\Mail\TicketMail;
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
    try {
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

      Common::createLog("Registered user with ID: {$user->id} (" . Common::getRealIpAddr() . ')', $user->email_address);

      $QRCode = \QrCode::format('png')->size(200)->margin(1)->generate($user->reference_number);

      \Mail::to($user->email_address)->send(new TicketMail($user->name, $QRCode));
      \App\Common::createLog('Sent Ticket to: ' . $user->email_address);

      return json_encode(['success' => true]);
    } catch (QueryException $e) {
      return json_encode(['success' => false, 'error' => $e]);
    } catch (\Exception $e) {
      return json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    return json_encode(['success' => true]);
  }
}
