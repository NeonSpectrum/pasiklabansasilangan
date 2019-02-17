<?php

namespace App\Http\Controllers;

use App\Logged;
use Illuminate\Http\Request;

class ReportController extends Controller {
  /**
   * @return mixed
   */
  protected function show() {
    $users = \DB::table('users')->where('sent', 1)->get();

    foreach ($users as $user) {
      $companions = \DB::table('companions')->where('id', $user->id)->get();

      $names = [];

      foreach ($companions as $companion) {
        $names[] = $companion->first_name . ' ' . $companion->last_name;
      }

      $user->companions = [
        'count' => $companions->count(),
        'names' => join('<br>', $names)
      ];

      $user->date_sent = \DB::table('logs')->whereRaw('action LIKE "%Ticket%' . $user->email_address . '%"')->latest()->first()->created_at;
    }

    $pdf = \PDF::loadView('pdf.report', ['data' => $users]);

    return $pdf->stream();
  }

  /**
   * @return mixed
   */
  protected function batchDisplay() {
    $data = \DB::select('SELECT * FROM (SELECT first_name, last_name, nickname, reference_number, batch FROM `users` UNION SELECT first_name, last_name, nickname, reference_number, batch FROM companions) AS U ORDER BY batch ASC');

    $finalData = [];

    foreach ($data as $row) {
      if (Logged::where('reference_number', $row->reference_number)->first()) {
        $finalData[] = $row;
      }
    }

    $pdf = \PDF::loadView('pdf.batch', ['data' => $finalData]);

    return $pdf->stream();
  }
}
