<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $data=[];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data=[])
    {
        //php artisan make:mail AdminResetPassword --markdown=admin.emails.admin_reset_password
        //mark down = view file path
        //Note edit .env Mail_USERNAME and password and confi.mail file port and host
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.emails.admin_reset_password')
        ->subject('Reset Admin Data')
        ->with('data',$this->data);
    }
}
