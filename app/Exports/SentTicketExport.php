<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SentTicketExport implements FromView, ShouldAutoSize {
  /**
   * @return \Illuminate\Support\Collection
   */
  public function view(): View{

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

      if ($date_sent = \DB::table('logs')->whereRaw('action LIKE "%Ticket%' . $user->email_address . '%"')->latest()->first()) {
        $user->date_sent = $date_sent->created_at;
      } else {
        $user->date_sent = null;
      }
    }

    return view('exports.sentticket', ['data' => $users]);
  }
}
