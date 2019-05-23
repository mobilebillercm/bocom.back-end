<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    private $de, $template, $user, $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from, $template, $user, $url)
    {
        $this->de = $from;
        $this->template = $template;
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->de)->view($this->template)->with(['user'=>$this->user,'url'=>$this->url]);
        //return $this->view($this->notificationtemplate)->with(['eventName'=>$this->eventName]);
    }
}
