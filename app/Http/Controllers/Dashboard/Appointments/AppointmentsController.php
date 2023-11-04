<?php

namespace App\Http\Controllers\Dashboard\Appointments;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class AppointmentsController extends Controller
{
    //
    public function index(){
        $appointments = Appointment::where('type','غير مؤكد')->get();
        return view('Dashboard.appointments.index',compact('appointments'));
    }

    public function approvedAppointments(){
        $appointments = Appointment::where('type','مؤكد')->get();
        return view('Dashboard.appointments.approved_appointments',compact('appointments'));
    }
    public function approveAppointment(Request $request, $id){

        $appointment = Appointment::findOrFail($id);
        $appointment->update([
                'type'=> 'مؤكد',
                'appointment'=> $request->appointment,
        ]);

        Mail::to($appointment->email)->send(new AppointmentConfirmation( $appointment->name, $appointment->appointment));
        
        $receiverNumber = $appointment->phone;
        $message = "اهلا ".$appointment->name." "."تم تحديد الموعد بنجاح في :".$appointment->appointment;
        
        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);

  
        } catch (\Exception $e) {
            dd("Error: ". $e->getMessage());
        }

        session()->flash('add');
        return redirect()->back();
    }

    public function destroy($id){
        
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->delete();

            session()->flash('delete');
            return redirect()->back();

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }    
    }

} 
