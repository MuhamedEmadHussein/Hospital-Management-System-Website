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
    public $receiver;
    public $receiverUser;
    public $selected_conversation;
    public $messages;
    public $auth_email;
    public $auth_id;
    
    public function mount(){
        $this->auth_email = Auth::user()->email;
    }
    public function getListeners()
    {
        if(Auth::guard('patient')->check()){
            $this->auth_id = Auth::guard('patient')->user()->id;

        }else{
            $this->auth_id = Auth::guard('doctor')->user()->id;
          
        }
        
        return [
            "echo-private:chat.{$this->auth_id},SendMessage" => 'broadcastMessage','loadConversationDoctor','loadConversationPatient','pushMessage',
        ];
    }
    public function broadcastMessage($event){   
        $broadcastMessage = Message::find($event['message_id']);
        $broadcastMessage->read = 1;
        $this->pushMessage($broadcastMessage->id);
        
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

    public function pushMessage($message_id){
        $newMessage = Message::find($message_id);
        $this->messages->push($newMessage);
        
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
