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
    protected $listeners = ['chatWithPatient','chatWithDoctor','dispatchSendMessageEvent'];
    public $body;
    public $receiverUser;
    public $selected_conversation;
    public $auth_email;
    public $sender;
    public $created_message;
    
    public function mount(){
        if(Auth::guard('patient')->check()){
            $this->auth_email = Auth::guard('patient')->user()->email;
            $this->sender = Auth::guard('patient')->user();
        
        }else{
            $this->auth_email = Auth::guard('doctor')->user()->email;
            $this->sender = Auth::guard('doctor')->user();
        
        }
       
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

        $this->created_message = Message::create([
            'conversation_id' =>  $this->selected_conversation->id,
            'sender_email' =>  $this->auth_email,
            'receiver_email' => $this->receiverUser->email,
            'body' => $this->body
        ]);

        $this->selected_conversation->last_time_message = $this->created_message->created_at;
        $this->selected_conversation->save(); 
        $this->reset('body');
        $this->emitTo('chat.chat-box','pushMessage', $this->created_message->id);
        $this->emitTo('chat.chat-list','refresh');
        $this->emitSelf('dispatchSendMessageEvent');
    }
    
    public function dispatchSendMessageEvent(){
        
        Broadcast(new \App\Events\SendMessage(
            $this->sender,
            $this->receiverUser,
            $this->selected_conversation,
            $this->created_message
        ));
    }


    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
