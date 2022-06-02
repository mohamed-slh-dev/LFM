<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     //index page (home)
    public function index()
    {   

        //check the user role
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        //if the user is admin (17) then view all date else view user's data
        if ($user_role->role_id != 17 && $user_role->role_id != 23 ) {
              $lang = Session::get('lang');
           $user_type = "emp";

           $activities =  DB::table('activities')
           ->join('users', 'users.id', '=', 'activities.create_by')
           ->select('users.name AS user_create','activities.*')
           ->orderBy('activities.id' , 'desc')
           ->where('assign_to', auth()->user()->id)
           ->orWhere('assign_to', 0)
           ->paginate(10);
         
           $main_cases = DB::table('t_cases_master')
           ->where('N_AdminPerson', auth()->user()->id )
           ->paginate(10);

           $cases = DB::table('t_cases_details')
           ->join('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 't_cases_details.N_CASE_STAGE')
           ->select('t_detailedcodes.S_Desc_A AS stage_name','t_cases_details.*')
           ->where('lawyer_1', auth()->user()->id )
           ->orWhere('lawyer_1', auth()->user()->id )
           ->orWhere('lawyer_1', auth()->user()->id )
           ->paginate(10);

           $hearings = DB::table('t_hearing')
           ->where('N_LAWYER_ID', auth()->user()->id )
           ->get();

           $tasks_count = DB::table('t_tasks')
           ->where('N_EMPLOYEE_NO', auth()->user()->id )
           ->get();

           $tasks = DB::table('t_tasks')
           ->join('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_tasks.N_CASE_ID')
           ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_tasks.N_CASE_DETAILS_ID')
           ->select('t_cases_details.N_CASE_ID AS main_case_id','t_cases_details.S_CASE_UID AS case_uid',
           't_cases_master.S_CASE_FILE_NUM AS file_id','t_tasks.*')   
           ->where('N_EMPLOYEE_NO', auth()->user()->id )
           ->where('N_Status', '!=' ,'اكتملت')
           ->where('N_TaskType', '=' , 1 )
           ->orderBy('DT_WANTED', 'asc')
           ->paginate(8);

           $leaves = DB::table('leave')
           ->where('user_id', auth()->user()->id )
           ->get();
   
   
           $short_stages = DB::table('t_hearing')
           ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
           ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
           ->select('t_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
           ->where( 't_hearing.DT_HEARING_DATE', '>=', Carbon::now())
           ->where('t_hearing.N_LAWYER_ID', auth()->user()->id )
           ->orderBy('t_hearing.DT_HEARING_DATE', 'asc')
           ->paginate(10);
          
           $decisions_noti = DB::table('t_hearing')
           ->join('t_sentence_config', 't_sentence_config.N_HEARING_TYPE', '=', 't_hearing.N_HEARINGTYPE')
           ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
           ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
           ->select('t_sentence_config.S_Desc_A','t_sentence_config.S_NEXT_Desc_A','t_sentence_config.N_Period',
           't_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
           ->where('N_LAWYER_ID', auth()->user()->id)
           ->where('t_sentence_config.S_Desc_A', 'LIKE','%' . 'حكم' . '%')
           ->where('t_hearing.N_Reviewed',null)
           ->orderBy('DT_HearingEnterDate', 'desc')
           ->paginate(10);
    
           $stages_noti = DB::table('t_hearing')
           ->join('t_sentence_config', 't_sentence_config.N_HEARING_TYPE', '=', 't_hearing.N_HEARINGTYPE')
           ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
           ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
           ->select('t_sentence_config.S_Desc_A', 't_sentence_config.S_NEXT_Desc_A',  't_sentence_config.N_Period',
           't_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
           ->where('t_hearing.N_LAWYER_ID', auth()->user()->id )
           ->where('t_hearing.N_Reviewed','=' ,null )
           ->where( 't_hearing.DT_HEARING_DATE', '!=',null)
           ->where( 't_hearing.DT_HEARING_DATE', '!=','t_hearing.DT_HearingEnterDate')
           ->where('t_sentence_config.S_Desc_A', 'NOT LIKE','%' . 'حكم' . '%')
           ->orderBy('t_hearing.DT_HearingEnterDate', 'desc')
           ->paginate(10);
   
           // dd($decision_noti);
           $today_date = \Carbon\Carbon::now();
           $view =  view('index',compact(['short_stages','decisions_noti','today_date'
           ,'stages_noti','hearings','cases','tasks',
           'main_cases','leaves','user_type','tasks_count','activities','lang']));
        }elseif ($user_role->role_id == 17 ){
            $lang = Session::get('lang');
            $user_type = "admin";

            $activities =  DB::table('activities')
            ->orderBy('activities.id' , 'desc')
            ->limit(10)
           ->get();

            $clients = DB::table('t_clients')->get();
            $files = DB::table('t_files')->get();
            $main_cases = DB::table('t_cases_master')->get();
            $cases = DB::table('t_cases_details')->get();
            $cases_not_registerd = DB::table('t_cases_details')
            ->where('N_CASE_STAGE',16561)
            ->get();
    
            $cases_startup = DB::table('t_cases_details')
            ->where('N_CASE_STAGE',16483)
            ->get();
    
            $short_stages = DB::table('t_hearing')
            ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
            ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
            ->leftJoin('t_detailedcodes', 't_detailedcodes.N_DetailedCode', '=', 't_hearing.N_CASE_DETAILS_ID')
            ->select('t_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
            ->where( 't_hearing.DT_HEARING_DATE', '>=', Carbon::now())
            ->orderBy('t_hearing.DT_HEARING_DATE', 'asc')
            ->paginate(10);
           
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
    
            $stages_noti = DB::table('t_hearing')
            ->join('t_sentence_config', 't_sentence_config.N_HEARING_TYPE', '=', 't_hearing.N_HEARINGTYPE')
            ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_hearing.N_CASE_DETAILS_ID')
            ->leftJoin('t_cases_master', 't_cases_master.N_CASE_ID', '=', 't_cases_details.N_CASE_ID')
            ->select('t_sentence_config.S_Desc_A', 't_sentence_config.S_NEXT_Desc_A',  't_sentence_config.N_Period',
            't_cases_details.N_CASE_ID', 't_cases_master.S_CASE_FILE_NUM', 't_cases_details.S_CASE_UID','t_hearing.*')
            ->where('t_sentence_config.S_Desc_A', 'NOT LIKE','%' . 'حكم' . '%')
            ->where('t_hearing.N_Reviewed','=' ,null )
            ->where( 't_hearing.DT_HEARING_DATE','!=',null)
            ->where( 't_hearing.DT_HEARING_DATE','!=','t_hearing.DT_HearingEnterDate')
            ->orderBy('t_hearing.DT_HearingEnterDate', 'desc')
            ->paginate(10);
    
            // dd($decision_noti);
            $today_date = \Carbon\Carbon::now();
            $view =  view('index',compact(['short_stages','decisions_noti','today_date'
            ,'stages_noti','files','cases','clients','main_cases','cases_not_registerd',
            'cases_startup','user_type','activities','lang']));
        }elseif($user_role->role_id == 23 ){
            $user_type = 'support';

            $users =  DB::table('users')->get();

            $tasks = DB::table('client_tasks')
            ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 'client_tasks.N_CASE_DETAILS_ID')
            ->leftJoin('t_clients AS create_by', 'create_by.N_CLIENT_ID', '=', 'client_tasks.created_by')
            ->select('create_by.S_CLIENT_AR_NAME AS createBy',
            't_cases_details.S_CASE_UID AS case_uid', 'client_tasks.*')
            ->where('client_tasks.N_EMPLOYEE_NO',20)
            ->paginate(10);

            
            $open_case =  DB::table('clients_open_case')
            ->join('t_clients', 't_clients.N_CLIENT_ID', '=', 'clients_open_case.client_id')
            ->leftJoin('t_detailedcodes AS caseStatus', 'caseStatus.N_DetailedCode', '=', 'clients_open_case.case_status')
            ->select('caseStatus.S_Desc_A AS caseStatus', 't_clients.S_CLIENT_AR_NAME AS clientName','clients_open_case.*')
            ->paginate(20);

            $view =  view('index',compact(['tasks','user_type','users','open_case']));
        }
      
      
        
      
        return $view;
    }

    //search dashboard page
    public function search_dashboard(){
        $clients = DB::table('t_clients')
        ->orderBy('S_CLIENT_AR_NAME', 'asc')
        ->get();
    
        $users =  DB::table('users')->get();
    
        //get all cases status from details code
        $case_status = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 19)
        ->orderBy('S_Desc_A', 'asc')
        ->get();
    
        //get all cases branches from details code
        $branchs = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 1)->get();
    
        //get all cases stages from details code
        $case_stage = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 7)
        ->get();
    
        
        //get all cases types from details code
        $case_type = DB::table('t_detailedcodes')
        ->orderBy('S_Desc_A', 'asc')
        ->where('N_MasterCode', '=', 5)
        ->get();
    
        //get all court from details code
        $court = DB::table('t_detailedcodes')->where('N_MasterCode', '=', 6)
        ->orderBy('S_Desc_A', 'asc')
        ->get();
        return view('search.search-dashboard',compact(['clients','users','case_status','branchs','case_stage',
        'case_type','court']));
    
    }

    //common qustions page
    public function common_question(){
        $lang = Session::get('lang');
        $questions = DB::table('questions')
        ->get();
         return view('common_question',compact(['questions','lang']));
    }

    //about firm page

    public function about(){
        $lang = Session::get('lang');
        $about = DB::table('about_info')
        ->first();
    
         return view('about',compact(['about','lang']));
    }

    //user profile page
    public function my_profile(){
        $details = DB::table('users')
        ->where('id', auth()->user()->id)
        ->first();
    
         return view('my-profile',compact(['details']));
    }

    //update user information
    public function update_profile(Request $request,$user_id){
        $data = array();
       
        
        //get all new user information from request and store it into array 
        $data['name']=$request->name;
        $data['phone']=$request->phone;
        $data['email']=$request->email;

        //upload avatar
        if($file=$request->file('avatar')){
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $filename= 'user-avater'.'_'.time().'.'.$ext;
             $file->move('assets/images/users-imgs/', $filename);
             $data['avatar'] = $filename;
          
        }
      
        //update user
          $update_client =  DB::table('users')
        ->where('id', $user_id)
        ->update($data);
      
      
            return redirect()->back()->with('success','تم تحديث بيانات المستخدم بنجاح')
            ->with('ring','play');

    }

    //update user password
    public function update_user_password(Request $request,$user_id){

        //make the password hashed 
        $data['password'] = Hash::make($request->password);

        //update the hash password
        $update_password = DB::table('users')
        ->where('id',$user_id )
        ->update($data);

      
            return  redirect()->back()->with('success','تم تحديث كلمة المرور ')
            ->with('ring','play');
    }

    //assign tasks to users
    public function assign_task(Request $request){

        $tasks = DB::table('client_tasks')
        ->where('N_TASK_ID',$request->task_id)
        ->first();

        $data = array(); 

       
        //get all new tasks information from request and store it into array
        $data['N_CASE_ID']=$tasks->N_CASE_ID;
        $data['N_CASE_DETAILS_ID']=$tasks->N_CASE_DETAILS_ID;

        $data['S_SUBJECT']=$tasks->S_SUBJECT;

        $data['DT_DATE_STARTWORK']=$tasks->DT_DATE_STARTWORK;
        $data['DT_DOINGWORK']=$tasks->DT_DOINGWORK;
        $data['DT_WANTED']=$tasks->DT_WANTED;
        $data['excute_date']=$tasks->excute_date;

        $data['N_EMPLOYEE_NO']=$request->assign_user;
        $data['S_NOTES']= $tasks->S_NOTES;
        $data['S_Comment']=$tasks->S_Comment;
        $data['N_TaskType']=$tasks->N_TaskType;
        $data['N_Status']=$tasks->N_Status;
     
        $data['created_by']=Auth::id();

        //add notification(activity)
        $activity = array(); 
        $activity['short_name']=' اضافة مهمة';
        $activity['description']=' تم اضافة مهمة دعوى جديدة('.$tasks->S_SUBJECT.')';
        $activity['create_by']=Auth::id();
        $activity['assign_to'] =$request->assign_user;
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        $activity['url']="main-case-cases/$tasks->N_CASE_ID";

        $insert_activity = DB::table('activities')->insert($activity);
        
        $insert_case_task = DB::table('t_tasks')->insert($data);

        
    
        //check if task added successfully
        
        if ($insert_case_task) {
            return redirect()->back()->with('success', 'تم اضافة مهمة جديدة بنجاح')
            ->with('ring','play');
            
        }
        
    }
}
