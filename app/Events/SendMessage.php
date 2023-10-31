<?php

namespace App\Events;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender;
    public $receiver;
    public $conversation;
    public $message;


    /**
     * Create a new event instance.
     */
    public function __construct(Doctor|Patient $sender, Doctor|Patient $receiver, Conversation $conversation, Message $message)
    {
        //
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->conversation = $conversation;
        $this->message = $message;
    }

    public function broadcastWith()
    {
        return [
            'sender_email'=> $this->sender->email,
            'receiver_email'=> $this->receiver->email,
            'conversation_id'=> $this->conversation->id,
            'message_id' => $this->message->id
        ];
    }

    public function broadcastOn()
    {
      
        return new PrivateChannel('chat.'.$this->receiver->id);
        
    }
}
