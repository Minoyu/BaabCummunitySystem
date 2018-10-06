<?php

namespace App\Notifications;

use App\Model\CommunityTopicReply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $subject,$sender,$content;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject,$sender,$content)
    {
        //
        $this->subject = $subject;
        $this->sender = $sender;
        $this->content = $content;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('[BaabClub]You have new message!')
            ->greeting('Hello! '.$notifiable->name.', You have received a new message')
            ->line('Subject : '.$this->subject)
            ->line('Sender : '.$this->sender)
            ->line('Content : '.strip_tags($this->content))
            ->action('VIEW & REPLY', url(route('messages')))
            ->line('<br>Thank you for your participation in community!');
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
        ];
    }
}
