<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user, $userverification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $userverification)
    {
        $this->user = $user;
        $this->userverification = $userverification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bocom.cm@gmail.com')->view('email.verify')->with(['user'=>$this->user, 'userverification'=>$this->userverification]);
        //return $this->view($this->notificationtemplate)->with(['eventName'=>$this->eventName]);
    }
}
