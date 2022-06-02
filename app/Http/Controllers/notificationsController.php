<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class notificationsController extends Controller
{

    //stages notifications
    public function stages_notifications(){

        $stages_noti = DB::table('t_hearing')
        ->join('t_sentence_config', 't_sentence_config.N_HEARING_TYPE', '=', 't_hearing.N_HEARINGTYPE')
        ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->select('t_sentence_config.S_Desc_A', 't_sentence_config.S_NEXT_Desc_A',  't_sentence_config.N_Period',
        't_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
        ->where('t_sentence_config.S_Desc_A', 'NOT LIKE','%' . 'حكم' . '%')
        ->orderBy('DT_HearingEnterDate', 'desc')
        ->paginate(10);

        //get today's date to print
        $today_date = \Carbon\Carbon::now();
        return view('notifications.stages-notifications',compact(['stages_noti','today_date']));
    }

    //get all decisions notifications
    public function decision_notifications(){
        $decisions_noti = DB::table('t_hearing')
        ->join('t_sentence_config', 't_sentence_config.N_HEARING_TYPE', '=', 't_hearing.N_HEARINGTYPE')
        ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
        ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
        ->select('t_sentence_config.S_Desc_A', 't_sentence_config.S_NEXT_Desc_A',  't_sentence_config.N_Period',
        't_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
        ->where('t_sentence_config.S_Desc_A', 'LIKE','%' . 'حكم' . '%')
        ->where('t_hearing.N_Reviewed',null)
        ->orderBy('DT_HearingEnterDate', 'desc')
        ->paginate(10);


        //today's date to print
        $today_date = \Carbon\Carbon::now();
        return view('notifications.decision-notifications',compact(['decisions_noti','today_date']));
    }


    //short stages notifiaction
    public function shortStages_notifications(){

    $short_stages = DB::table('t_hearing')
    ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
    ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
    ->select('t_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
    ->where( 'DT_HEARING_DATE', '<', Carbon::now())
    ->orderBy('DT_HEARING_DATE', 'desc')
    ->paginate(10);

        return view('notifications.shortStages-notifications',compact(['short_stages']));

    }

    //get all public notifications
    public function public_notifications(){
        $notis = DB::table('activities')
        ->join('users', 'users.id', '=', 'activities.create_by')
        ->select('users.name AS user_create','activities.*')
        ->where('assign_to',0)
        ->orderBy('id','desc')
        ->get();
        return view('notifications.public-notifications',compact(['notis']));
    }


    //create new public notifications
    public function add_public_notification(Request $request){

        //get all new public notification information from request and store it into array
        $activity = array(); 
        $activity['short_name']=$request->short_name;
        $activity['description']=$request->desc;
        $activity['assign_to']= 0 ;
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');

        $insert_activity = DB::table('activities')->insert($activity);

        
        //check if notification added successfully

        if ($insert_activity) {
                return redirect()->back()->with('success', 'تم اضافة تنبيه عام جديد بنجاح');

        }
    }


     //get all direct notifications
    public function direct_notifications(){
        $users = DB::table('users')->get();

        $notis = DB::table('activities')
        ->join('users as userCreate', 'userCreate.id', '=', 'activities.create_by')
        ->join('users as userAssign', 'userAssign.id', '=', 'activities.assign_to')
        ->select('userCreate.name AS user_create', 'userAssign.name AS user_assign','activities.*')
        ->where('assign_to', '>',0)
        ->orderBy('id','desc')
        ->get();
        return view('notifications.direct-notifications',compact(['notis','users']));
    }


    //create new direct notification
     public function add_direct_notification(Request $request){

        //get all new notifiaction information from request and store it into array
        $activity = array(); 
        $activity['short_name']=$request->short_name;
        $activity['description']=$request->desc;
        $activity['assign_to']= $request->assign;
        $activity['create_by']=Auth::id();
        $activity['date_time']=  \Carbon\Carbon::now(+'4');

        $insert_activity = DB::table('activities')->insert($activity);
            if ($insert_activity) {
                return redirect()->back()->with('success', 'تم اضافة تنبيه خاص  بنجاح');

        }
    }
}
