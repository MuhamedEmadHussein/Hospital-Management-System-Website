<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $patient_id;
    public $invoice_id;

    /**
     * Create a new event instance.
     */
    public function __construct($data)
    {
        //
        $patient = Patient::findOrFail($data['patient_id']);
        
        $this->patient_id = $patient->name;
        $this->invoice_id = $data['invoice_id'];
    }
    
    public function broadcastOn()
    {
        // return [
        //     new PrivateChannel('channel-name'),
        // ];
        return ['my-channel'];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
