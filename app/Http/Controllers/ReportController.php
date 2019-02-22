<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller {
  /**
   * @return mixed
   */
  protected function show() {
    $pdf = \PDF::loadView('pdf.report', ['data' => User::all()])->setPaper('a4', 'landscape');

    return $pdf->stream();
  }
}
