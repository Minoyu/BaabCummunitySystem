<?php

namespace App\Notifications;

use App\Model\CommunityTopicReply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommunityTopicReplied extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reply;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(CommunityTopicReply $reply)
    {
        //
        $this->reply = $reply;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello! '.$notifiable->name)
                    ->subject('[BaabClub]Your Topic Has Been Replied!')
                    ->line('Your Topic '.$this->reply->communityTopic->title.' has been replied')
                    ->line('Replier : '.$this->reply->user->name)
                    ->line('Content : '.strip_tags($this->reply->content))
                    ->action('VIEW & REPLY', url(route('showCommunityContent',$this->reply->communityTopic->id).'#reply-'.$this->reply->id))
                    ->line('Thank you for your participation in community!');
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
        ];
    }
}
