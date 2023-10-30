<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SendMessage extends Component
{
    protected $listeners = ['chatWithPatient','chatWithDoctor'];
    public $body;
    public $receiverUser;
    public $selected_conversation;
    public $auth_email;
    
    public function mount(){
        $this->auth_email = Auth::user()->email;
    }
    public function chatWithDoctor(Conversation $conversation,Doctor $receiver){
       
        $this->selected_conversation = $conversation;
        $this->receiverUser = $receiver;
    }

    public function chatWithPatient(Conversation $conversation,Patient $receiver){
        $this->selected_conversation = $conversation;
        $this->receiverUser = $receiver;
    }
    public function sendMessage(){
        
        if($this->body == null){
            return null;
        }

        $created_message = Message::create([
            'conversation_id' =>  $this->selected_conversation->id,
            'sender_email' =>  $this->auth_email,
            'receiver_email' => $this->receiverUser->email,
            'body' => $this->body
        ]);

        $this->selected_conversation->last_time_message = $created_message->created_at;
        $this->selected_conversation->save(); 
        $this->reset('body');
        
    }
    
    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
