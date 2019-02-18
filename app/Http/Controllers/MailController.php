<?php

namespace App\Http\Controllers;

use App\Common;
use App\Mail\StepMail;
use App\Mail\TicketMail;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MailController extends Controller {
  /**
   * @return mixed
   */
  protected function display(Request $request) {
    $img = Image::make(public_path('img/ticket1.png'));

    // $img->text($mail['ref'], 20, 20, function ($font) {
    //   $font->file(public_path('font/Crimson-Roman.ttf'));
    //   $font->size(64);
    //   $font->color('#fdf6e3');
    //   $font->valign('top');
    // });

    $QRCode = \QrCode::format('png')->size(200)->margin(1)->generate($request->ref);

    $img->insert($QRCode, 'bottom-right', 20, 20);

    return $img->response('png');
  }
}
