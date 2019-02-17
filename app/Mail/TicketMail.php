<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable {
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($name, $image) {
    $this->name  = $name;
    $this->image = $image;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build() {
    return $this->from('uecsrnd@gmail.com')
      ->subject('UE-CCSS Alumni Homecoming Digital Ticket')
      ->view('ticket-mail')
      ->with(
        [
          'name' => $this->name
        ])
      ->attachData($this->image, 'ticket.jpg', [
        'mime' => 'image/jpeg'
      ]);
  }
}
