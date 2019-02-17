<?php

namespace App\Http\Controllers;

use App\Common;
use App\Mail\SendPictureMail;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

class UploadController extends Controller {
  /**
   * @param Request $request
   */
  protected function showSuccess(Request $request) {
    if ($request->session()->has('upload')) {
      return view('upload-success');
    } else {
      return redirect()->route('register');
    }
  }

  /**
   * @param Request $request
   */
  protected function create(Request $request) {
    $code = $request->query('code', null);

    if (!$code) {
      abort(404);
    }

    $reference_number = Common::decrypt($code);

    $user = \DB::table('users')->where('reference_number', $reference_number)->first();

    if ($user) {
      return view('upload', ['user' => $user, 'code' => $code]);
    }

    abort(404);
  }

  /**
   * @param Request $request
   */
  protected function store(Request $request) {
    $filename = time() . '.' . $request->file->getClientOriginalExtension();

    $mime = $request->file->getMimeType();

    if (substr($mime, 0, 5) != 'image') {
      return json_encode(['success' => false, 'error' => 'This is not an image.']);
    }

    $request->file->move(public_path('references'), $filename);
    $reference_number = Common::decrypt($request->code);

    $arr = [
      'reference_file_name' => $filename
    ];

    if ($request->data) {
      parse_str($request->data, $data);

      if (isset($data['nickname'])) {
        $arr['nickname'] = $data['nickname'];
      }
      if (isset($data['batch'])) {
        $arr['batch'] = $data['batch'];
      }
      if (isset($data['referrer'])) {
        $arr['referrer'] = $data['referrer'];
      }
    }

    try {
      \DB::table('users')->where('reference_number', $reference_number)->update($arr);

      $user = \DB::table('users')->where('reference_number', $reference_number)->first();

      // \Mail::to('aseret_f@yahoo.com')->send(new SendPictureMail($user->first_name . ' ' . $user->last_name, public_path('references') . '/' . $filename, $mime));
      Common::createLog("Deposit slip of {$reference_number} has been sent to aseret_f@yahoo.com");

      $request->session()->flash('upload', true);

      return json_encode(['success' => true]);
    } catch (QueryException $e) {
      return json_encode(['success' => false, 'error' => $e]);
    } catch (\Exception $e) {
      return json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
  }
}
