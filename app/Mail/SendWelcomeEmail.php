<?php

namespace App\Mail;

use App\Model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $username;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username)
    {
        //
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
            ->subject('Welcome！The new member of BaabClub.')
            ->markdown('emails.welcome-new-user')
            ->with([
                'link'=>'https://baab.club/',
                'username'=>$this->username,
            ]);
    }
}
