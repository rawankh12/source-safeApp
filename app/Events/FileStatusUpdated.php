<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $fileId;
    public $message;
    public $affectedUsers;
    /**
     * Create a new event instance.
     */
    public function __construct($fileId, $message, $affectedUsers)
    {
        $this->fileId = $fileId;
        $this->message = $message;
        $this->affectedUsers = $affectedUsers;
    }

    public function broadcastOn()
    {
        return new Channel('file-updates');
    }

    public function broadcastAs()
    {
        return 'file.status.updated';
    }


    public function broadcastWith()
    {
        return [
            'file_id' => $this->fileId,
            'message' => $this->message,
            'affected_users' => $this->affectedUsers,
        ];
    }
    
}
