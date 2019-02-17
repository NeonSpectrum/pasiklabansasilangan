<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StepMail extends Mailable {
  use Queueable, SerializesModels;

  /**
   * @var mixed
   */
  public $data;

  /**
   * Create a new message instance.
   *
   * @return void
   */

  public function __construct($data) {
    $this->data = $data;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build() {
    return $this->from('uecsrnd@gmail.com')
      ->subject('UE-CCSS Alumni Homecoming Payment Instructions')
      ->view('step-mail')
      ->with(
        [
          'data' => $this->data
        ]);
  }
}
