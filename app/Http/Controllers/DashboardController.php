<?php

namespace App\Http\Controllers;

use App\Common;
use App\Exports\DataExport;
use App\Exports\SentTicketExport;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller {
  protected function showAll() {
    $users = User::all();

    $data = [];

    foreach ($users as $row) {
      if ($row->sent == 1) {
        $row->status = 'sent';
      } else if ($row->paid == 1) {
        $row->status = 'paid';
      }

      $data[] = [
        'data' => $row,
        'code' => Common::encrypt($row->reference_number)
      ];
    }

    return view('dashboard.all', ['data' => $data, 'total' => $users->count()]);
  }

  protected function exportall() {
    Common::createLog('Export Data to Excel');
    return \Excel::download(new DataExport, date('F_d_Y_h_i_s_A') . ' Alumni Registration Report.xlsx');
  }

  /**
   * @param Request $request
   */
  protected function scanner(Request $request) {
    $code  = $request->code;
    $image = $request->image;

    if ($request->type == 'qrcode') {
      $user = User::where('reference_number', $code)->first();

      if (!$user->first()) {
        return response()->json(['success' => false, 'error' => 'Invalid QR Code.']);
      } else if ($user->isLogged) {
        return response()->json(['success' => false, 'error' => 'Already Logged In.']);
      } else {
        $image = str_replace('data:image/webp;base64,', '', $image);

        $image = str_replace(' ', '+', $image);

        $image = base64_decode($image);

        $file = public_path('loggedusers') . '/' . $code . '-qrcode.webp';

        file_put_contents($file, $image);

        $user->logged_at = \Carbon::now();
        $user->save();

        return response()->json(['success' => true, 'name' => $user->first()->first_name . ' ' . $user->first()->last_name]);
      }
    } else if ($request->type == 'picture') {
      $image = str_replace('data:image/png;base64,', '', $image);

      $image = str_replace(' ', '+', $image);

      $image = base64_decode($image);

      $file = public_path('loggedusers') . '/' . $code . '-picture.png';

      file_put_contents($file, $image);

      return response()->json(['success' => true]);
    }
  }
}
