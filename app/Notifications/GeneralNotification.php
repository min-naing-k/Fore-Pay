<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification implements ShouldQueue
{
  use Queueable;

  public $title, $message, $sourceable_id, $sourceable_type, $web_link;
  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($title, $message, $sourceable_id, $sourceable_type, $web_link)
  {
    $this->title = $title;
    $this->message = $message;
    $this->sourceable_id = $sourceable_id;
    $this->sourceable_type = $sourceable_type;
    $this->web_link = $web_link;
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
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toDatabase($notifiable)
  {
    return [
      'title' => $this->title,
      'message' => $this->message,
      'sourceable_id' => $this->sourceable_id,
      'sourceable_type' => $this->sourceable_type,
      'web_link' => $this->web_link,
    ];
  }
}
