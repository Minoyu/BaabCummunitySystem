<?php

namespace App\Mail;

use App\Model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $link,$username;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token,$username)
    {
        //
        $this->link = route('showResetPasswordPage',$token);
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('[Important] The link to reset your password')
            ->markdown('emails.reset-password')
            ->with([
                'link'=>$this->link,
                'username'=>$this->username,
            ]);
    }
}
