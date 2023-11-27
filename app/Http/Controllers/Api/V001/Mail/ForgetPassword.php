<?php

namespace App\Http\Controllers\Api\V001\Mail;


use App\Models\Main\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer, $newPassword)
    {
        $this->customer = $customer;
        $this->password = $newPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $email =  env('MAIL_FROM_ADDRESS') ;
        return $this->subject('Forget password ')->from($address = $email, $name = env('APP_NAME'))->view('mail.forgetPassowrd');
    }
}
