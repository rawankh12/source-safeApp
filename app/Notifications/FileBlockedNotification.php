<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FileBlockedNotification extends Notification
{
    use Queueable;
    private $userName;
    private $fileName;
    private $action;
    /**
     * Create a new notification instance.
     */
    public function __construct($userName, $fileName, $action)
    {
        $this->userName = $userName;
        $this->fileName = $fileName;
        $this->action = $action;
    }
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->userName} {$this->action}  {$this->fileName}", 
            'userName' => $this->userName,
            'fileName' => $this->fileName,
            'action' => $this->action,
        ];
    }
}
