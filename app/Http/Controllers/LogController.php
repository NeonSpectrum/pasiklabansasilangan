<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller {
  protected function show() {
    return view('logs', ['logs' => Log::all()]);
  }
}
