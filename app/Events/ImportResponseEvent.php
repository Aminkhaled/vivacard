<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImportResponseEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $errors;
    public $admins_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$errors,$admins_id)
    {
        $this->message = $message;
        $this->errors = $errors;
        $this->admins_id = $admins_id ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('new-order');
        return ['import-response-event'];
    }
    public function broadcastAs()
    {
        return 'import-response-event';
    }
}
