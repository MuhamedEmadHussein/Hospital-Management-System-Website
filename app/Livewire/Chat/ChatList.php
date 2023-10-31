<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component
{
    protected $listeners = ['refresh'=>'$refresh'];

    public $auth_email;
    public $conversations;
    public $receiverUser;
    public $selected_conversation;
    public function mount(){
        $this->auth_email = Auth::user()->email;
    }

    public function getUsers(Conversation $conversation, $request){
        
        if($conversation->sender_email ==  $this->auth_email){
            $this->receiverUser = Doctor::firstwhere('email',$conversation->receiver_email);
        
        }else{
            $this->receiverUser = Patient::firstwhere('email',$conversation->sender_email);

        }
        if(isset($request)){
            return $this->receiverUser->$request;
        }
    }

    public function chatUserSelected(Conversation $conversation, $receiver_id){

        $this->selected_conversation = $conversation;
        
        if(auth('doctor')->check())
        {
            $this->receiverUser = Patient::find($receiver_id);
            $this->emitTo('chat.chat-box','loadConversationPatient', $this->selected_conversation,$this->receiverUser);
            $this->emitTo('chat.send-message','chatWithPatient',$this->selected_conversation,$this->receiverUser);
        }else{
            $this->receiverUser = Doctor::find($receiver_id);
            $this->emitTo('chat.chat-box','loadConversationDoctor', $this->selected_conversation,$this->receiverUser);
            $this->emitTo('chat.send-message','chatWithDoctor',$this->selected_conversation,$this->receiverUser);
        
        }

    }

    public function render()
    {
        $this->conversations = Conversation::where('sender_email',$this->auth_email)
                                            ->orwhere('receiver_email',$this->auth_email)
                                            ->orderBy('created_at','desc')->get();
                                            
        return view('livewire.chat.chat-list');
    }
}
