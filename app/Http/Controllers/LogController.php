<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller {
  protected function show() {
    $logs = \DB::table('logs')->get();

    return view('logs', ['logs' => $logs]);
  }
}
