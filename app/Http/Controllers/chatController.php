<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
class chatController extends Controller
{
    public function chats(){

        //view all chats that the current user is member of
        $member_chats =  DB::table('chat_members')
        ->where('user_id' , Auth::id())
        ->get();

        if ( $member_chats->count() > 0 ) {
            foreach ($member_chats as $value) {
                $chats_id [] = $value->chat_id;
             }
             $chats =  DB::table('chats')
             ->whereIn('chat_id' ,$chats_id)
             ->get();
        } else{
             $chats = null;
        }

        //view all chats
        $clients_chat =  DB::table('clients_chats')
        ->join('t_clients', 't_clients.N_CLIENT_ID','=','clients_chats.client_id')
        ->select('t_clients.S_CLIENT_AR_NAME AS clientName','clients_chats.*')
        ->get();
       
        
        return view('mails-chats.chats',compact(['chats','clients_chat']));
    }

    public function add_chat(Request $request){

        
        //get all new chat information from request and store it into array
        $data['chat_name']=$request->name;
        $data['chat_about']=$request->about;
        $data['created_by']=Auth::id();
        $data['created_date']= \Carbon\Carbon::now(+'4');

        $add_chat = DB::table('chats')->insertGetId($data);

        $add_member['user_id']=Auth::id();
        $add_member['chat_id']=$add_chat;

        $add_chat_member = DB::table('chat_members')->insert($add_member);


       $activity = array(); 
       $activity['short_name']=' اضافة  محادثة';
       $activity['description']=' تم اضافة محاثة جديدة ('.$request->name.') ';
       $activity['date_time']=  \Carbon\Carbon::now(+'4');
       $activity['create_by']=Auth::id();
       $activity['url']="chats";
        
       $insert_activity = DB::table('activities')->insert($activity);

       //check if chat added successfully
       if ($add_chat) {
        return redirect()->back()->with('success', 'تم  اضافة محادثة بنجاح')
        ->with('ring','play');
    }

}

    public function chat_messages($chat_id){

        //get chat_id from chats
        $chat =  DB::table('chats')
        ->where('chat_id' ,$chat_id)
        ->first();

        //view all messages for chat_id $chat_id
        $messages =  DB::table('chat_messages')
        ->join('users','users.id' , '=' ,'chat_messages.user_id')
        ->select('users.avatar AS avi','users.name AS userName', 'chat_messages.*')
        ->where('chat_id' ,$chat_id)
        ->get();

        //get all users
        $users = DB::table('users')
        ->orderBy('name', 'asc')
        ->get();

        //get all chat members
        $members = DB::table('chat_members')
        ->join('users','users.id','=','chat_members.user_id')
        ->select('users.name AS name','users.avatar AS avatar','chat_members.id')
        ->where('chat_id',$chat_id)
        ->orderBy('name', 'asc')
        ->get();
        
        return view('mails-chats.chat-messages',compact(['chat','chat_id','users','members','messages']));
    }

    public function add_member(Request $request){

        //get chat_id and user_id
        $data['chat_id']=$request->chat_id;
        $data['user_id']=$request->user_id;

        //add user to chat
        $add_member = DB::table('chat_members')->insert($data);
   
       $activity = array(); 
       $activity['short_name']=' اضافة عضو في محادثة ';
       $activity['description']=' تم اضافتك عضو جديد في المحادثة  ';
       $activity['date_time']=  \Carbon\Carbon::now(+'4');
       $activity['assign_to']=$request->user_id;
       $activity['create_by']=Auth::id();
       $activity['url']="chat-messages/".$request->chat_id;
        
       $insert_activity = DB::table('activities')->insert($activity);


       //check if member added successfully
        if ($add_member) {
            return redirect()->back()->with('success', 'تم  اضافة عضو بنجاح')
            ->with('ring','play');
        }

    }

    public function delete_member($cm_id){

        //delete member from chat
        $delete =  DB::table('chat_members')
        ->where('id', $cm_id)
        ->delete();
   
        //check if member delete successfully
        if ($delete) {
           return redirect()->back()->with('success','تم حذف العضو بنجاح');
   
        }
    }

    public function delete_chat($chat_id){

        //delete all chat members
        $delete_member =  DB::table('chat_members')
        ->where('chat_id', $chat_id)
        ->delete();

        //delete all chat messages
        $delete_messages =  DB::table('chat_messages')
        ->where('chat_id', $chat_id)
        ->delete();

        //delete chat 
        $delete =  DB::table('chats')
        ->where('chat_id', $chat_id)
        ->delete();
   
        //check if chat delete successfully
        if ($delete) {
           return redirect()->back()->with('success','تم حذف المحادثة بنجاح');
   
        }
    }

    public function add_message(Request $request){

        
        //get all new message information from request and store it into array
        $data['chat_id']=$request->chat_id;
        $data['message']=$request->msg;
        $data['user_id']=Auth::id();
        $data['date_time']= \Carbon\Carbon::now(+'4');

        //insert message 
        $add_message = DB::table('chat_messages')->insert($data);

        //check if messsage added successfully
        if ($add_message) {
            return redirect()->back()->with('success', 'تم  ارسال الرسالة بنجاح')
            ->with('ring','play');
        }
      
    }

    public function client_chat_messages($chat_id){

        //get chat_id from clients chat
        $chat =  DB::table('clients_chats')
        ->join('t_clients', 't_clients.N_CLIENT_ID','=','clients_chats.client_id')
        ->select('t_clients.S_CLIENT_AR_NAME AS clientName', 't_clients.client_logo AS clientLogo','clients_chats.*')
        ->where('chat_id' ,$chat_id)
        ->first();

        //get messages from chat_id
        $messages =  DB::table('client_chats_messages')
        ->where('chat_id' , $chat->chat_id)
        ->get();
        
        return view('mails-chats.client-chat-messages',compact(['chat','chat_id','messages']));
    }

    public function add_client_message(Request $request){

        
        //get all new message information from request and store it into array
        $data['chat_id']=$request->chat_id;
        $data['message']=$request->msg;
        $data['message_by']='Admin';
        $data['date_time']= \Carbon\Carbon::now(+'4');

        //insert message
        $add_message = DB::table('client_chats_messages')->insert($data);

        //check if message added successfully
        if ($add_message) {
            return redirect()->back()->with('success', 'تم  ارسال الرسالة بنجاح')
            ->with('ring','play');
        }
      
    }
}
