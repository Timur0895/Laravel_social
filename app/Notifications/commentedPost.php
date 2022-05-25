<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class commentedPost extends Notification implements ShouldBroadcast
{
    use Queueable;
    protected $user;
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post)
    {
      $this->user = $user;
      $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'post_title' => $this->post->title,
            'usermail' => $this->user->email
        ];
    }

    public function toBroadcast($notifiable)
    {
      $notification = [
        "data" => [
          "user_name" => $this->user->name,
          "post_title" => $this->post->title,
          'usermail' => $this->user->email
        ]
      ];

      return new BroadcastMessage([
        'notification' => $notification
      ]);

    }
}
