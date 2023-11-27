<?php

namespace App\Http\Controllers\Api\V001\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyCode extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code     = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email =  env('MAIL_FROM_ADDRESS') ;
        return $this->subject('Verify your email ')->from($address = $email, $name = env('APP_NAME'))->view('mail.verifyCode');

    }
}
