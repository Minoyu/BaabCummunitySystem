<?php

namespace App\Notifications;

use App\Mail\SendWelcomeEmail;
use App\Model\CommunityTopicReply;
use App\Model\NewsReply;
use App\Model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserFollowed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $userId,$userName;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $followedUser)
    {
        //
        $this->userId = $followedUser->id;
        $this->userName = $followedUser->name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SendWelcomeEmail
     */
    public function toMail($notifiable)
    {
        //
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
            'type'=>'user.followed',
            'userId'=>$this->userId,
            'userName'=>$this->userName,
        ];
    }
}
