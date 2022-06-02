<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class tasksController extends Controller
{
    
    //view all tasks
    public function all_tasks(){

        //get the user role
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        //check if user is admin (role_id = 17) then view all tasks else view user task
        if ($user_role->role_id != 17 ) {
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_tasks.N_CASE_DETAILS_ID')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo','t_cases_details.S_CASE_UID AS case_uid', 't_tasks.*')
           ->orderBy('N_TASK_ID', 'desc')
            ->where('N_EMPLOYEE_NO',auth()->user()->id)
            ->paginate(8);
        }else{
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->leftJoin('t_cases_details', 't_cases_details.N_CASE_DETAILS_ID', '=', 't_tasks.N_CASE_DETAILS_ID')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo','t_cases_details.S_CASE_UID AS case_uid', 't_tasks.*')
            ->orderBy('N_TASK_ID', 'desc')
            ->paginate(8);
        }
      

        $users =  DB::table('users')->get();

        return view('tasks.all-tasks',compact(['tasks','users']));

    }

    //view adminstrartive tasks
    public function adminstrartive_tasks(){
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();


        //check if user is admin (role_id = 17) then view all tasks else view user task
        if ($user_role->role_id != 17 ) {
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
            ->where('N_TaskType', '=', 2)
            ->where('N_EMPLOYEE_NO',auth()->user()->id)
            ->paginate(8);
        }else{
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
            ->where('N_TaskType', '=', 2)
            ->paginate(8);
        }

        $users =  DB::table('users')->get();
       

        return view('tasks.adminstrative-tasks',compact(['tasks','users']));

    }

    
    //view public tasks
    public function public_tasks(){
        $users =  DB::table('users')->get();
        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();


        //check if user is admin (role_id = 17) then view all tasks else view user task
        if ($user_role->role_id != 17 ) {
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
            ->where('N_TaskType', '=', 4)
            ->where('N_EMPLOYEE_NO',auth()->user()->id)
            ->paginate(8);
        }else{
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
            ->where('N_TaskType', '=', 4)
            ->paginate(8);
        }


        return view('tasks.public-tasks',compact(['tasks','users']));

    }


    //view special tasks
    public function specific_tasks(){


        $users =  DB::table('users')->get();


        $user_role =  DB::table('users_permissions')
        ->where('user_id' , auth()->user()->id)
        ->first();

        //check if user is admin (role_id = 17) then view all tasks else view user task
        if ($user_role->role_id != 17 ) {
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
            ->where('N_TaskType', '=', 3)
            ->where('N_EMPLOYEE_NO',auth()->user()->id)
            ->paginate(8);
        }else{
            $tasks = DB::table('t_tasks')
            ->leftJoin('users AS create_by', 'create_by.id', '=', 't_tasks.created_by')
            ->leftJoin('users AS assign', 'assign.id', '=', 't_tasks.N_EMPLOYEE_NO')
            ->select('create_by.name AS createBy', 'assign.name AS assignTo', 't_tasks.*')
            ->where('N_TaskType', '=', 3)
            ->paginate(8);
        }


        return view('tasks.specific-tasks',compact(['tasks','users']));

    }


    //create new adminstrative task
    public function add_adminstrative_task(Request $request){

        $data = array(); 

       
        //get all new task information from request and store it into array
        $data['S_SUBJECT']=$request->desc;
        

        $data['DT_DATE_STARTWORK']=\Carbon\Carbon::now();
        $data['DT_DOINGWORK']=$request->doing_date;
        $data['DT_WANTED']=$request->wanted_date;
        $data['excute_date']=$request->excute_date;

        $data['N_EMPLOYEE_NO']=$request->assignTo;
        $data['S_NOTES']= $request->notes;
        $data['S_Comment']=$request->comment;
        $data['N_TaskType']="2";
        $data['N_Status']=$request->status;
        $data['created_by']=Auth::id();
     
       
        //add notification(activity)
       $activity = array(); 
       $activity['short_name']=' اضافة مهمة';
       $activity['description']=' تم اضافة مهمة ادارية جديدة('.$request->notes.')';
       $activity['create_by']=Auth::id();
       $activity['assign_to'] =$request->assignTo;
       $activity['date_time']=  \Carbon\Carbon::now(+'4');

       $insert_activity = DB::table('activities')->insert($activity);
        
        $insert_case_task = DB::table('t_tasks')->insert($data);

        //check if task added successfully
        if ($insert_case_task) {
            return redirect()->back()->with('success', 'تم اضافة مهمة جديدة بنجاح')
            ->with('ring','play');
            
        }

    }


    //create public task
    public function add_public_task(Request $request){

        $data = array(); 

     
        //get all new task information from request and store it into array
        $data['S_SUBJECT']=$request->desc;
        

        $data['DT_DATE_STARTWORK']=\Carbon\Carbon::now();
        $data['DT_DOINGWORK']=$request->doing_date;
        $data['DT_WANTED']=$request->wanted_date;
        $data['excute_date']=$request->excute_date;

        $data['N_EMPLOYEE_NO']=$request->assignTo;
        $data['S_NOTES']= $request->notes;
        $data['S_Comment']=$request->comment;
        $data['N_TaskType']='4';
        $data['N_Status']=$request->status;
        $data['created_by']=Auth::id();


  
      //add notification(activity)
       $activity = array(); 
       $activity['short_name']=' اضافة مهمة';
       $activity['description']=' تم اضافة مهمة عامة جديدة('.$request->notes.')';
       $activity['create_by']=Auth::id();
       $activity['assign_to'] =$request->assignTo;
       $activity['date_time']=  \Carbon\Carbon::now(+'4');

       $insert_activity = DB::table('activities')->insert($activity);

        $insert_case_task = DB::table('t_tasks')->insert($data);

        //check if task added successfully
        if ($insert_case_task) {
            return redirect()->back()->with('success', 'تم اضافة مهمة جديدة بنجاح')
            ->with('ring','play');
            
        }

    }

    //create new special (specific) task
    public function add_specific_task(Request $request){

        $data = array(); 

     
        //get all new task information from request and store it into array
        $data['S_SUBJECT']=$request->desc;
        

        $data['DT_DATE_STARTWORK']=\Carbon\Carbon::now();
        $data['DT_DOINGWORK']=$request->doing_date;
        $data['DT_WANTED']=$request->wanted_date;
        $data['excute_date']=$request->excute_date;

        $data['N_EMPLOYEE_NO']=$request->assignTo;
        $data['S_NOTES']= $request->notes;
        $data['S_Comment']=$request->comment;
        $data['N_TaskType']='3';
        $data['N_Status']=$request->status;
        $data['created_by']=Auth::id();
      
        
         
         //add notification(activity)
       $activity = array(); 
       $activity['short_name']=' اضافة مهمة';
       $activity['description']=' تم اضافة مهمة خاصة جديدة('.$request->notes.')';
       $activity['create_by']=Auth::id();
       $activity['assign_to'] =$request->assignTo;
       $activity['date_time']=  \Carbon\Carbon::now(+'4');

       $insert_activity = DB::table('activities')->insert($activity);
        
        $insert_case_task = DB::table('t_tasks')->insert($data);

        //check if task added successfully
        if ($insert_case_task) {
            return redirect()->back()->with('success', 'تم اضافة مهمة جديدة بنجاح')
            ->with('ring','play');
            
        }

    }


    //tasks reports
    public function tasks_reports(){
        //get all users
        $users =  DB::table('users')->get();

        //task report data is null by default
        $task_report= null;
        return view('tasks.tasks-reports',compact(['users','task_report']));
    }

    //get task report from filter data
    public function print_tasks_reports(Request $request){

        //get user id
        $user_id = $request->assignTo;

        //get the user name
        $user_name = DB::table('users')
        ->where('id', '=', $user_id)
        ->first();

        $user_name = $user_name->name;

        //get all user tasks
        $task_report = DB::table('t_tasks')
        ->join('users', 'users.id', '=', 't_tasks.created_by')
        ->select('users.name', 't_tasks.*')
        ->where('N_EMPLOYEE_NO', '=', $user_id)
        ->get();

     
        $users =  DB::table('users')->get();

        return view('tasks.tasks-reports',compact(['users','task_report','user_name']));
    }


    //update task information
    public function update_task_status(Request $request){

        //get all new task information from request
        $task_id = $request->task_id;
        $task_status = $request->task_status;
        $task_reviwe = $request->review;
        $task_follower = $request->follower;

        
        //get the task name to add to activity
        $task_name = DB::table('t_tasks')
        ->where('N_TASK_ID', $task_id)
        ->first();
    

        //add notification(activity)
        $activity = array(); 
        $activity['short_name']='تحديث حالة مهمة';
        $activity['description']='تم تحديث حالة المهمة('.$task_name->S_NOTES.')- رقم القضية ('.$task_name->N_CASE_ID.')';
        $activity['create_by']=Auth::id();
        $activity['assign_to']= $task_follower;
        $activity['date_time']=  \Carbon\Carbon::now(+'4');
        if ($task_name->N_CASE_ID) {
            $activity['url']="main-case-cases/$task_name->N_CASE_ID";   
        }
      


        $insert_activity = DB::table('activities')->insert($activity);

        //update task 
        $update_task = DB::table('t_tasks')
              ->where('N_TASK_ID', $task_id)
              ->update(
                  [
                    'N_Status' => $task_status,
                    'N_Reviewed' => $task_reviwe
                  ]
                );

                return redirect()->back()->with('success', 'تم تحديث حالة المهمة بنجاح')
                ->with('ring','play');
           
    }

    //delete task
    public function delete_task($task_id){
       
        //delete task with id $task_id
        $delete_task = DB::table('t_tasks')
        ->where('N_TASK_ID', '=', $task_id)
        ->delete();

        //check if task delete successfully
        if ($delete_task) {
            
                return redirect()->back()->with('success', 'تم حذف المهمة بنجاح');
         }
    }
}
