<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $logo = 'https://cmuj.migfus.net/images/logo.svg';
    protected $email = '';
    protected $code = '';

    public function __construct($email, $code) {
      $this->email = $email;
      $this->code = $code;
    }

    public function build() {
      return $this->from(env('MAIL_FROM_ADDRESS', 'admin@fchhis.migfus.net'), 'Account Recovery')
          ->subject('Account Recovery')
          ->view('emails.recovery',['code' => $this->code, 'logo' => $this->logo]);
  }
}
