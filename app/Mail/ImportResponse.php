<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ImportResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $errors;
    public $num;
    public function __construct($msg,$errors,$num = null)
    {
        $this->msg = $msg;
        $this->errors = $errors;
        $this->num = $num;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('import report ')->from('info@'.env('APP_NAME','test').'.com',env('APP_NAME','test'))->view('mail.import_report');

    }
}
