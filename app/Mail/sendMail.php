<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        $this->phone=$phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    
    public function build(){
        $address = 'schoolmobpua@gmail.com';
        $name = 'School';
        $subject = 'Laravel Email';
        return $this->view('mailContent')->with('phone',$this->phone)->from($address, $name)->subject($subject);
    }
}
