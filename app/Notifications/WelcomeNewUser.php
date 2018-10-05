<?php

namespace App\Notifications;

use App\Mail\SendWelcomeEmail;
use App\Model\CommunityTopicReply;
use App\Model\NewsReply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNewUser extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SendWelcomeEmail
     */
    public function toMail($notifiable)
    {
        return (new SendWelcomeEmail($notifiable->name))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'type'=>'user.new.welcome',
            'userName'=>$notifiable->name,
            'welcomeTopicLink'=>'/community/topic/31',
        ];
    }
}
