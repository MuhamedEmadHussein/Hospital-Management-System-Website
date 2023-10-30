<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{
    protected $listeners = ['loadConversationDoctor','loadConversationPatient'];
    public $receiver;
    public $receiverUser;
    public $selected_conversation;
    public $messages;
    public $auth_email;
    
    public function mount(){
        $this->auth_email = Auth::user()->email;
    }

    public function loadConversationDoctor(Conversation $conversation,Doctor $receiver){
       
        $this->selected_conversation = $conversation;
        $this->receiverUser = $receiver;
        $this->messages = Message::where('conversation_id',$this->selected_conversation->id)->get();
    }

    public function loadConversationPatient(Conversation $conversation,Patient $receiver){
        $this->selected_conversation = $conversation;
        $this->receiverUser = $receiver;
        $this->messages = Message::where('conversation_id',$this->selected_conversation->id)->get();
    }
    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
