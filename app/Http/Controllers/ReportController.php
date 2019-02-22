<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller {
  /**
   * @return mixed
   */
  protected function show() {
    ini_set('max_execution_time', 300);
    ini_set('memory_limit', '512M');
    $pdf = \PDF::loadView('pdf.report', ['data' => User::all()])->setPaper('a4', 'landscape');

    return $pdf->stream();
  }
}
