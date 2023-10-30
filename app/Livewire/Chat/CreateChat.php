<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateChat extends Component
{
    public $auth_email;
    public $users;

    public function mount(){
        $this->auth_email = Auth::user()->email;
    }
    public function createConversation($receiver_email){
        
        $check_conversation = Conversation::where('sender_email',$this->auth_email)
                                            ->where('receiver_email',$receiver_email)
                                            ->orwhere('sender_email',$receiver_email)
                                            ->where('receiver_email',$this->auth_email)->get();
        if($check_conversation->isEmpty()){

            DB::beginTransaction();
            try{
    
                $create_conversation = Conversation::create([
                            'sender_email' =>  $this->auth_email,
                            'receiver_email' => $receiver_email
                ]);
    
                Message::create([
                    'conversation_id' =>  $create_conversation->id,
                    'sender_email' =>  $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'body' => 'السلام عليكم'
                ]);
                
                DB::commit();
            }catch (\Exception $e) {
                DB::rollback();
            }

        }else{
            dd('Conversation Already Created');
        } 
}
    public function render()
    {
        if(Auth::guard('patient')->check()){
            $this->users = Doctor::all();

        }else{
            $this->users = Patient::all();
        }

        return view('livewire.chat.create-chat')->extends('Dashboard.layouts.master');
    }
}
