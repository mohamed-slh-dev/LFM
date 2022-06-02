<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;


class ticketController extends Controller
{

    //view all tickets from clients
    public function tickets(){
        $lang = Session::get('lang');
        $tickets =  DB::table('tickets')
      
        ->orderBy('id', 'desc')
        ->get();

        return view('clients.tickets',compact(['tickets','lang']));
    }

    //get the client tickects
    public function client_tickets(){

        //get the client id from session
        $client_id = Session::get('client_id');

        //get all client tickets
        $tickets =  DB::table('tickets')
        ->where('client_id' , $client_id)
        ->orderBy('id', 'desc')
        ->get();

        return view('client-portal.client-tickets',compact(['tickets']));
    }

    //create new ticket
    public function add_ticket(Request $request){
       
        $client_id = Session::get('client_id');
        $data = array(); 

        //upload document
        if ( $file = $request->file('doc')) {
            $file = $request->file('doc');
            $ext = $file->getClientOriginalExtension();
            $filename=  'ticket_doc_'.time().'.'.$ext;
             $file->move('assets/tickets-documents/', $filename);
    
             $data['file'] = $filename;
        }

       
        //get all new ticket information from request and store it into array
        $data['client_id']=$client_id;
        $data['subject']=$request->subject;
        $data['description']=$request->desc;
        $data['case_related']=$request->case_uid;
        $data['status']='معلق';
        $data['date']=\Carbon\Carbon::now();
    
        $insert_ticket = DB::table('tickets')->insertGetId($data);
       

        
        
        
       //add notification(activity)
       $activity = array(); 
       $activity['short_name']=' اضافة طلب دعم';
       $activity['description']=' تم اضافة طلب دعم جديد رقم ('.$insert_ticket.') ';
       $activity['date_time']=  \Carbon\Carbon::now(+'4');
       $activity['create_by']=0;
       $activity['url']="tickets";
        
       $insert_activity = DB::table('activities')->insert($activity);

       
       //check if ticket added successfully
        if ($insert_ticket) {
            return redirect()->back()->with('success', 'تم ارسال الطلب بنجاح')
            ->with('ring','play');
        }

    }

    //change the ticket status
    
    public function cancel_ticket($ticket_id){
       
        //change ticket status with id $ticket_id
        $cancel_ticket = DB::table('tickets')
        ->where('id', '=', $ticket_id)
        ->update(['status' => 'الغيت']);

              if ($cancel_ticket) {
                return redirect()->back()->with('success', 'تم الغاء الطلب بنجاح');
                
            }
    }

    public function processing_ticket($ticket_id){
       
          //change ticket status with id $ticket_id
        $cancel_ticket = DB::table('tickets')
        ->where('id', '=', $ticket_id)
        ->update(['status' => 'قيد التنفيذ']);

              if ($cancel_ticket) {
                return redirect()->back()->with('success', 'تم الغاء الطلب بنجاح');
                
            }
    }

    public function complete_ticket($ticket_id){
       
          //change ticket status with id $ticket_id
        $cancel_ticket = DB::table('tickets')
        ->where('id', '=', $ticket_id)
        ->update(['status' => 'اكتملت']);

              if ($cancel_ticket) {
                return redirect()->back()->with('success', 'تم الغاء الطلب بنجاح');
                
            }
    }


    
    //delete ticket
    public function delete_ticket($ticket_id){
       
        //delete ticket with id $ticket_id
        $delete_ticket = DB::table('tickets')
        ->where('id', '=', $ticket_id)
        ->delete();

              if ($delete_ticket) {
                return redirect()->back()->with('success', 'تم حذف الطلب بنجاح');
                
            }
    }

}
