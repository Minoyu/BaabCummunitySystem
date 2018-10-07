<?php

namespace App\Notifications;

use App\Model\CommunityTopicReply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommunityReplyReplied extends Notification implements ShouldQueue
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
            ->subject('[BaabClub]Your Comment Has Been Replied!')
            ->greeting('Hello! '.$notifiable->name.', Your Comment under the Topic <i>'.$this->reply->communityTopic->title.'</i> has been replied!')
            ->line('Replier : '.$this->reply->user->name)
            ->line('Content : '.strip_tags($this->reply->content))
            ->action('VIEW & REPLY', route('showCommunityContent',$this->reply->communityTopic->id).'#reply-'.$this->reply->id)
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
            //
            'type'=>'community.reply.replied',
            'topicId'=>$this->reply->communityTopic->id,
            'topicTitle'=>$this->reply->communityTopic->title,
            'replyId'=>$this->reply->id,
            'replyContent'=>$this->reply->content,
            'replierId'=>$this->reply->user->id,
            'replierName'=>$this->reply->user->name,
        ];
    }
}
